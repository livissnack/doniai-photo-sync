<?php

namespace App\Controllers;

use ManaPHP\Cli\Controller;
use App\Models\PhotoHistory;
use App\Services\AliyunOssService;

class SyncPhotoController extends Controller
{
    public function defaultCommand()
    {
        $this->logger->info(str_repeat('+', 80), 'task.sync.service.start');
        while (true) {
            try {
                if ($msg = $this->redis->brPop('task.sync.list', 60)) {
                    if (!is_numeric($msg[1])) {
                        $this->logger->error($msg, 'task.sync.invalid');
                        continue;
                    }
                    if ($task = $this->sync((int)$msg[1])) {
                        $task->update();
                    }
                }
            } catch (\Throwable $throwable) {
                $this->logger->error($throwable);
                sleep(1);
            }
        }
    }

    /**
     * @param int $ph_id
     *
     * @return PhotoHistory
     */
    public function sync($ph_id)
    {
        if (!$task = PhotoHistory::first(['ph_id' => $ph_id])) {
            $this->logger->error(['task #`:ph_id` is not exists', 'ph_id' => $ph_id]);
            return null;
        }
        if (is_null($task->image_url)) {
            $this->logger->warn('task has no sync content');
            return null;
        }

        if (is_null($task->print_image_url)) {
            $this->logger->warn('task has no sync content');
            return null;
        }
        if ($task = PhotoHistory::first(['ph_id' => $ph_id])) {
            $oss_image_url = $this->uploadImageOss($task->image_url);
            $oss_print_image_url = $this->uploadImageOss($task->print_image_url);

            $task->image_url = $oss_image_url;
            $task->print_image_url = $oss_print_image_url;
            $task->remark = '照片从服务商同步到阿里云OSS';
        }
        return $task;
    }


    public function uploadImageOss($img_url)
    {
        $target = http_download($img_url);
        $ext_name = pathinfo($target, PATHINFO_EXTENSION);

        $bucket_name = env('ali_oss_bucket_name');
        $content_type = 'image/' . $ext_name;
        $filename = $this->_uuid() . '.' . $ext_name;
        AliyunOssService::publicUpload($bucket_name, $filename, $target, ['ContentType' => $content_type]);
        unlink($target);
        $photo_url = AliyunOssService::getPublicObjectURL($bucket_name, $filename);
        return str_replace('http://', 'https://', $photo_url);
    }

    public function _uuid() {
        return date('YmdHis', time()).bin2hex(random_bytes(4));
    }
}
