<?php

namespace ManaPHP;

/**
 * Interface QueryInterface
 *
 * @package  ManaPHP
 * @template Model
 */
interface QueryInterface
{
    /**
     * @param mixed|string $db
     *
     * @return static
     */
    public function setDb($db);

    /**
     * @param \ManaPHP\Model $model
     *
     * @return static
     */
    public function setModel($model);

    /**
     * @return \ManaPHP\Model
     */
    public function getModel();

    /**
     * @param callable $strategy
     *
     * @return static
     */
    public function shard($strategy);

    /**
     * @param string $table
     * @param string $alias
     *
     * @return static
     */
    public function from($table, $alias = null);

    /**
     * @param string|array $fields =get_object_vars(new Model)
     *
     * @return static
     */
    public function select($fields);

    /**
     * Sets SELECT DISTINCT / SELECT ALL flag
     *
     * @param bool $distinct
     *
     * @return static
     */
    public function distinct($distinct = true);

    /**
     * Appends a condition to the current conditions using a AND operator
     *
     * @param array $filters =get_object_vars(new Model)
     *
     * @return static
     */
    public function where($filters);

    /**
     * @param string $field =key(get_object_vars(new Model))
     * @param mixed  $value
     *
     * @return static
     */
    public function whereEq($field, $value);

    /**
     * @param string $field =key(get_object_vars(new Model))
     * @param string $operator
     * @param mixed  $value
     *
     * @return static
     */
    public function whereCmp($field, $operator, $value);

    /**
     * @param string $field =key(get_object_vars(new Model))
     * @param int    $divisor
     * @param int    $remainder
     *
     * @return static
     */
    public function whereMod($field, $divisor, $remainder);

    /**
     * @param string $expr
     * @param array  $bind
     *
     * @return static
     */
    public function whereExpr($expr, $bind = null);

    /**
     * @param array $filters =get_object_vars(new Model)
     *
     * @return static
     */
    public function search($filters);

    /**
     * Appends a BETWEEN condition to the current conditions
     *
     * @param string           $field =key(get_object_vars(new Model))
     * @param int|float|string $min
     * @param int|float|string $max
     *
     * @return static
     */
    public function whereBetween($field, $min, $max);

    /**
     * Appends a NOT BETWEEN condition to the current conditions
     *
     * @param string           $field =key(get_object_vars(new Model))
     * @param int|float|string $min
     * @param int|float|string $max
     *
     * @return static
     */
    public function whereNotBetween($field, $min, $max);

    /**
     * @param string     $field =key(get_object_vars(new Model))
     * @param int|string $min
     * @param int|string $max
     *
     * @return static
     */
    public function whereDateBetween($field, $min, $max);

    /**
     * Appends an IN condition to the current conditions
     *
     * @param string $field =key(get_object_vars(new Model))
     * @param array  $values
     *
     * @return static
     */
    public function whereIn($field, $values);

    /**
     * Appends a NOT IN condition to the current conditions
     *
     * @param string $field =key(get_object_vars(new Model))
     * @param array  $values
     *
     * @return static
     */
    public function whereNotIn($field, $values);

    /**
     * @param string $field =key(get_object_vars(new Model))
     * @param string $value
     *
     * @return static
     */
    public function whereInset($field, $value);

    /**
     * @param string $field =key(get_object_vars(new Model))
     * @param string $value
     *
     * @return static
     */
    public function whereNotInset($field, $value);

    /**
     * @param string|array $fields =get_object_vars(new Model) ?: key(get_object_vars(new Model))
     * @param string       $value
     *
     * @return static
     */
    public function whereContains($fields, $value);

    /**
     * @param string|array $fields =get_object_vars(new Model) ?: key(get_object_vars(new Model))
     * @param string       $value
     *
     * @return static
     */
    public function whereNotContains($fields, $value);

    /**
     * @param string|array $fields =get_object_vars(new Model) ?: key(get_object_vars(new Model))
     * @param string       $value
     * @param int          $length
     *
     * @return static
     */
    public function whereStartsWith($fields, $value, $length = null);

    /**
     * @param string|array $fields =get_object_vars(new Model) ?: key(get_object_vars(new Model))
     * @param string       $value
     * @param int          $length
     *
     * @return static
     */
    public function whereNotStartsWith($fields, $value, $length = null);

    /**
     * @param string|array $fields =get_object_vars(new Model)?: key(get_object_vars(new Model))
     * @param string       $value
     *
     * @return static
     */
    public function whereEndsWith($fields, $value);

    /**
     * @param string|array $fields =get_object_vars(new Model) ?: key(get_object_vars(new Model))
     * @param string       $value
     *
     * @return static
     */
    public function whereNotEndsWith($fields, $value);

    /**
     * @param string|array $fields =get_object_vars(new Model) ?: key(get_object_vars(new Model))
     * @param string       $like
     *
     * @return static
     */
    public function whereLike($fields, $like);

    /**
     * @param string|array $fields =get_object_vars(new Model) ?: key(get_object_vars(new Model))
     * @param string       $like
     *
     * @return static
     */
    public function whereNotLike($fields, $like);

    /**
     * @param string $field =key(get_object_vars(new Model))
     * @param string $regex
     * @param string $flags
     *
     * @return static
     */
    public function whereRegex($field, $regex, $flags = '');

    /**
     * @param string $field =key(get_object_vars(new Model))
     * @param string $regex
     * @param string $flags
     *
     * @return static
     */
    public function whereNotRegex($field, $regex, $flags = '');

    /**
     * @param string $field =key(get_object_vars(new Model))
     *
     * @return static
     */
    public function whereNull($field);

    /**
     * @param string $field =key(get_object_vars(new Model))
     *
     * @return static
     */
    public function whereNotNull($field);

    /**
     * Sets a ORDER BY condition clause
     *
     * @param string|array $orderBy =get_object_vars(new Model) ?: key(get_object_vars(new Model)) ?: [$k=>SORT_ASC, $k=>SORT_DESC]
     *
     * @return static
     */
    public function orderBy($orderBy);

    /**
     * @param callable|string|array $indexBy =key(get_object_vars(new Model))
     *
     * @return static
     */
    public function indexBy($indexBy);

    /**
     * Sets a GROUP BY clause
     *
     * @param string|array $groupBy =get_object_vars(new Model) ?: key(get_object_vars(new Model))
     *
     * @return static
     */
    public function groupBy($groupBy);

    /**
     * @param array $options
     *
     * @return static
     */
    public function options($options);

    /**
     * @param string|array $with
     *
     * @return static
     */
    public function with($with);

    /**
     * Sets a LIMIT clause, optionally a offset clause
     *
     * @param int $limit
     * @param int $offset
     *
     * @return static
     */
    public function limit($limit, $offset = null);

    /**
     * @param int $size
     * @param int $page
     *
     * @return static
     */
    public function page($size = null, $page = null);

    /**
     * @param bool $forceUseMaster
     *
     * @return static
     */
    public function forceUseMaster($forceUseMaster = true);

    /**
     * @return array
     */
    public function execute();

    /**
     * @param array $expr
     *
     * @return array
     */
    public function aggregate($expr);

    /**
     * @param int $size
     * @param int $page
     *
     * @return \ManaPHP\Paginator
     */
    public function paginate($size = null, $page = null);

    /**
     * @param bool $multiple
     *
     * @return static
     */
    public function setFetchType($multiple);

    /**
     * @param bool $asArray
     *
     * @return \ManaPHP\Model[]|\ManaPHP\Model|array|null|\ManaPHP\Query\Row
     */
    public function fetch($asArray = false);

    /**
     * @return array|null
     */
    public function first();

    /**
     * @return array
     */
    public function get();

    /**
     * @return array
     */
    public function all();

    /**
     * @param string $field =key(get_object_vars(new Model))
     * @param mixed  $default
     *
     * @return mixed
     */
    public function value($field, $default = null);

    /**
     * @param string $field =key(get_object_vars(new Model))
     *
     * @return array
     */
    public function values($field);

    /**
     * @return bool
     */
    public function exists();

    /**
     * @param string $field =key(get_object_vars(new Model))
     *
     * @return int
     */
    public function count($field = '*');

    /**
     * @param string $field =key(get_object_vars(new Model))
     *
     * @return int|float|null
     */
    public function sum($field);

    /**
     * @param string $field =key(get_object_vars(new Model))
     *
     * @return int|float|null
     */
    public function max($field);

    /**
     * @param string $field =key(get_object_vars(new Model))
     *
     * @return int|float|null
     */
    public function min($field);

    /**
     * @param string $field =key(get_object_vars(new Model))
     *
     * @return float|null
     */
    public function avg($field);

    /**
     * @return int
     */
    public function delete();

    /**
     * @param array $fieldValues =get_object_vars(new Model)
     *
     * @return int
     */
    public function update($fieldValues);

    /**
     * @param callable $call
     *
     * @return static
     */
    public function when($call);

    /**
     * @param string     $field =key(get_object_vars(new Model))
     * @param string|int $date
     *
     * @return static
     */
    public function whereDate($field, $date);

    /**
     * @param string     $field =key(get_object_vars(new Model))
     * @param string|int $date
     *
     * @return static
     */
    public function whereMonth($field, $date);

    /**
     * @param string     $field
     * @param string|int $date
     *
     * @return static
     */
    public function whereYear($field, $date);

    /**
     * @param string $id
     * @param string $value
     *
     * @return static
     */
    public function where1v1($id, $value);

    /**
     * @param string $table
     * @param string $condition
     * @param string $alias
     * @param string $type
     *
     * @return static
     */
    public function join($table, $condition = null, $alias = null, $type = null);

    /**
     * @param string $table
     * @param string $condition
     * @param string $alias
     *
     * @return static
     */
    public function innerJoin($table, $condition = null, $alias = null);

    /**
     * @param string $table
     * @param string $condition
     * @param string $alias
     *
     * @return static
     */
    public function leftJoin($table, $condition = null, $alias = null);

    /**
     * @param string $table
     * @param string $condition
     * @param string $alias
     *
     * @return static
     */
    public function rightJoin($table, $condition = null, $alias = null);

    /**
     * @param string $filter
     * @param array  $bind
     *
     * @return static
     */
    public function whereRaw($filter, $bind = null);

    /**
     * @param string|array $having
     * @param array        $bind
     *
     * @return static
     */
    public function having($having, $bind = []);

    /**
     * @return string
     */
    public function getSql();
}