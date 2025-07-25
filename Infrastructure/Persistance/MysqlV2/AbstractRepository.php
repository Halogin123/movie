<?php

namespace Ducnm\Infrastructure\Persistance\MysqlV2;

use Ducnm\Domain\ModelV2\BaseInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

abstract class AbstractRepository implements BaseInterface
{
    const DESC = 'DESC';
    const ASC = 'ASC';
    const DEFAULT_PAGINATE = 15;
    protected $conditionMappings = [
        'select'            => 'applySelect',
        'selectRaw'         => 'applySelectRaw',
        'with'              => 'applyWith',
        'where'             => 'applyWhere',
        'where_raw'         => 'applyWhereRaw',
        'whereDoesntHave'   => 'applyWhereDoesntHave',
        'in'                => 'applyWhereIn',
        'not_in'            => 'applyWhereNotIn',
        'like'              => 'applyWhereLike',
        'is_null'           => 'applyWhereNull',
        'is_not_null'       => 'applyWhereNotNull',
        'between'           => 'applyWhereBetween',
        'not_equal'         => 'applyWhereNotEqual',
        'operator'          => 'applyWhereOperator',
        'where_date'        => 'applyWhereDate',
        'where_has'         => 'applyWhereHas',
        'groupBy'           => 'applyGroupBy',
        'having'            => 'applyHaving'
    ];
    protected $model;
    protected $query;


    public function __construct()
    {
        $this->model = app()->make($this->getModel());
    }

    /**
     * Abstract method `getModel`:
     * - Defined as abstract, meaning any subclass that extends this class must implement it.
     * - The purpose of this method is to return a specific model instance.
     * - Commonly used in repository patterns when working with Eloquent ORM in Laravel to bind a model to the repository.
     */
    abstract public function getModel();

    /**
     * Method `newQuery`:
     * - Purpose: Create a new query instance from the current model.
     * - `newQuery()` is a built-in method in Laravel's Eloquent ORM, used to initialize a fresh query without being affected by previous query constraints.
     * - This method sets the `$query` property of the current class to a new query instance from `$this->model`.
     * - The method returns the current object (`$this`) to enable method chaining (calling methods in a sequence).
     *
     * @return $this
     */
    public function newQuery()
    {
        $this->query = $this->model->newQuery();
        return $this;
    }

    /**
     * Retrieve all records from the model.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * Find a record by its ID with optional relations.
     *
     * @param mixed $id
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function findById($id, $relations = [])
    {
        $this->newQuery();
        if (!empty($relations)) {
            $this->query->with($relations);
        }
        return $this->query->find($id);
    }

    /**
     * Create a new record with the given attributes and optionally load relations.
     *
     * @param array $attributes
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create($attributes = [], $relations = [])
    {
        $result = $this->model->create($attributes);
        if (!empty($relations)) {
            $result->load($relations);
        }
        return $result;
    }

    /**
     * Insert multiple records at once.
     *
     * @param array $attributesList
     * @return bool
     */
    public function createMany(array $attributesList = [])
    {
        return $this->model->insert($attributesList);
    }

    /**
     * Update a record by its ID and optionally load relations.
     *
     * @param mixed $id
     * @param array $attributes
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Model|bool
     */
    public function updateById($id, $attributes = [], $relations = [])
    {
        $result = $this->findById($id);
        if ($result) {
            $result->update($attributes);
            if (!empty($relations)) {
                $result->load($relations);
            }
            return $result;
        }
        return false;
    }

    /**
     * Update records based on given conditions.
     *
     * @param array $condition
     * @param array $attributes
     * @return bool|int
     */
    public function updateBy($condition = [], $attributes = [])
    {
        $this->newQuery()->setQuery($condition);
        if ($this->query->exists()) {
            return $this->query->update($attributes);
        }
        return false;
    }

    /**
     * Delete a record by its ID.
     *
     * @param mixed $id
     * @return bool
     */
    public function deleteById($id)
    {
        $result = $this->findById($id);
        if ($result) {
            $result->delete();
            return true;
        }
        return false;
    }

    /**
     * Delete multiple records based on conditions.
     *
     * @param array $where
     * @return bool|int
     */
    public function deleteMany($where)
    {
        if (!empty($where) && count($where) > 0) {
            return $this->model->where($where)->delete();
        }
        return false;
    }

    /**
     * Find multiple records and sort them based on the given criteria.
     *
     * @param array $condition
     * @param array $sort
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findManySortColumn($condition = [], $sort = [])
    {
        $this->newQuery()->setQuery($condition)->sort($sort);
        return $this->query->get();
    }

    /**
     * Find a single record and sort based on the given criteria.
     *
     * @param array $condition
     * @param array $sort
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function findOneSortColumn($condition = [], $sort = [])
    {
        $this->newQuery()->setQuery($condition)->sort($sort);
        return $this->query->first();
    }

    /**
     * Count records based on the given conditions.
     *
     * @param array $condition
     * @return int
     */
    public function count($condition = [])
    {
        $this->newQuery()->setQuery($condition);
        return $this->query->count();
    }

    /**
     * Find a single record based on conditions.
     *
     * @param array $condition
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function findOne($condition = [])
    {
        $this->newQuery()->setQuery($condition);
        return $this->query->first();
    }

    /**
     * Find a single record and lock it for update.
     *
     * This method retrieves a single record that matches the specified condition
     * and locks it for update to prevent race conditions during concurrent updates.
     *
     * @param array $condition The conditions to filter the record.
     * @return mixed The first matching record, locked for update.
     */
    public function findOneLockUpdate($condition = [])
    {
        $this->newQuery()->setQuery($condition);
        return $this->query->lockForUpdate()->first();
    }

    /**
     * Find many records based on the specified condition.
     *
     * This method retrieves all records that match the specified condition.
     *
     * @param array $condition The conditions to filter the records.
     * @return mixed The list of records that match the condition.
     */
    public function findMany($condition = [])
    {
        $this->newQuery()->setQuery($condition);
        return $this->query->get();
    }

    /**
     * Find many records and lock them for update.
     *
     * This method retrieves all records that match the specified condition
     * and locks them for update to prevent race conditions during concurrent updates.
     *
     * @param array $condition The conditions to filter the records.
     * @return mixed The list of records that match the condition, locked for update.
     */
    public function findManyLockUpdate($condition = [])
    {
        $this->newQuery()->setQuery($condition);
        return $this->query->lockForUpdate()->get();
    }

    /**
     * Paginate the results based on the specified conditions, sorting, and limit.
     *
     * This method applies the specified condition, sorting, and pagination parameters
     * to the query and returns the paginated results.
     *
     * @param array $condition The conditions to filter the records (optional).
     * @param array $sort The sorting criteria for the results (optional).
     * @param int $limit The number of records per page (default is the class constant DEFAULT_PAGINATE).
     * @return mixed The paginated results.
     */
    public function paginate($condition = [], $sort = [], $limit = self::DEFAULT_PAGINATE)
    {
        $this->newQuery()->setQuery($condition)->sort($sort);
        return $this->query->paginate($limit);
    }

    /**
     * Limit the results based on the specified conditions, sorting, skip, and limit.
     *
     * This method applies the specified condition, sorting, skip, and limit parameters
     * to the query and returns the results.
     *
     * @param array $condition The conditions to filter the records (optional).
     * @param array $sort The sorting criteria for the results (optional).
     * @param int $skip The number of records to skip (for pagination).
     * @param int $limit The maximum number of records to return (default is the class constant DEFAULT_PAGINATE).
     * @return mixed The limited set of results.
     */
    public function limit($condition = [], $sort = [], $skip = 0, $limit = self::DEFAULT_PAGINATE)
    {
        $this->newQuery()->setQuery($condition)->sort($sort);
        return $this->query->skip((int)$skip)->limit((int)$limit)->get();
    }

    /**
     * Process the records in chunks.
     *
     * This method processes the records in chunks of a specified size and applies
     * the provided callback function to each chunk. Useful for processing large datasets
     * without loading all records into memory at once.
     *
     * @param int $size The size of each chunk (default is 10).
     * @param callable $callback The callback function to process each chunk.
     * @return mixed The result of processing the chunks.
     */
    public function chunk(callable $callback, $size = 10, array $relations = [], array $conditions = [])
    {
        $query = $this->model->with($relations);
        foreach ($conditions as $column => $value) {
            $query->where($column, $value);
        }
        return $query->chunk($size, $callback);
    }

    /**
     * Find the minimum value of a column based on the specified condition.
     *
     * This method retrieves the minimum value of a specified column that matches
     * the specified condition.
     *
     * @param array $condition The conditions to filter the records (optional).
     * @param string $column The column for which to find the minimum value.
     * @return mixed The minimum value of the column.
     */
    public function min($condition = [], $column = [])
    {
        $this->newQuery()->setQuery($condition);
        return $this->query->min($column);
    }

    /**
     * Find the maximum value of a column based on the specified condition.
     *
     * This method retrieves the maximum value of a specified column that matches
     * the specified condition.
     *
     * @param array $condition The conditions to filter the records (optional).
     * @param string $column The column for which to find the maximum value.
     * @return mixed The maximum value of the column.
     */
    public function max($condition = [], $column = [])
    {
        $this->newQuery()->setQuery($condition);
        return $this->query->max($column);
    }

    /**
     * Find the sum value of a column based on the specified condition.
     *
     * This method retrieves the sum value of a specified column that matches
     * the specified condition.
     *
     * @param array $condition The conditions to filter the records (optional).
     * @param string $column The column for which to find the v value.
     * @return mixed The sum value of the column.
     */
    public function sum($condition = [], $column = [])
    {
        $this->newQuery()->setQuery($condition);
        return $this->query->sum($column);
    }

    /**
     * Begin a database transaction.
     *
     * This method starts a new database transaction. Any subsequent database operations
     * will be executed within the scope of this transaction and can be committed or rolled back later.
     *
     * @return void
     */
    public function beginTransaction()
    {
        DB::beginTransaction();
    }

    /**
     * Commit the current database transaction.
     *
     * This method commits the ongoing database transaction. All operations performed
     * since the beginning of the transaction are permanently saved to the database.
     *
     * @return void
     */
    public function commitTransaction()
    {
        DB::commit();
    }

    /**
     * Rollback the current database transaction.
     *
     * This method rolls back the ongoing database transaction, undoing all database operations
     * performed since the transaction began. This is useful in case of errors or exceptions.
     *
     * @return void
     */
    public function rollBackTransaction()
    {
        DB::rollBack();
    }

    /**
     * Truncate the model's table, with optional transaction handling.
     *
     * This method truncates the table associated with the model, removing all records.
     * If the $boolean parameter is true, the operation will be wrapped in a transaction,
     * and will either be committed or rolled back depending on whether the operation succeeds or fails.
     *
     * @param bool $boolean Whether to wrap the truncate operation in a transaction (default is false).
     * @return bool True if successful, false if an error occurs.
     */
    public function truncate($boolean = false)
    {
        if ($boolean == true) {
            $this->beginTransaction();
            try {
                $this->model->truncate();
                Log::info(get_class($this->model) . ' table truncated successfully.');
                $this->commitTransaction();
                return true;
            } catch (\Exception $e) {
                Log::error('Failed to truncate ' . get_class($this->model) . ' table: ' . $e->getMessage());
                $this->rollBackTransaction();
                return false;
            }
        }
        return false;
    }

    /**
     * Check if records exist based on the given condition.
     *
     * This method checks whether any records exist in the database that match the specified condition.
     *
     * @param array $condition The condition to filter the records.
     * @return bool True if records exist, false if no records match the condition.
     */
    public function exists($condition = [])
    {
        $this->newQuery()->setQuery($condition);
        return $this->query->exists();
    }

    /**
     * Create or update a record based on the given condition.
     *
     * This method checks if a record matching the specified condition exists. If it does,
     * the record is updated with the given attributes and returned. If it does not exist,
     * a new record is created with the provided attributes.
     *
     * @param array $condition The condition to filter the record.
     * @param array $attributes The attributes to update or create.
     * @return mixed The updated or newly created record.
     */
    public function createOrUpdate($condition = [], $attributes = [])
    {
        $this->newQuery()->setQuery($condition);
        $existRecord = $this->query->lockForUpdate()->first();
        if ($existRecord) {
            $existRecord->update($attributes);
            return $existRecord->refresh();
        } else {
            return $this->model->create($attributes);
        }
    }

    /**
     * Apply sorting to the query.
     *
     * @param array $sort
     * @return $this
     */
    protected function sort($sort = [])
    {
        if (count($sort) > 0) {
            foreach ($sort as $key => $value) {
                $this->query->orderBy($key, $value);
            }
        } else {
            $this->query->orderBy("created_at", self::DESC);
        }
        return $this;
    }

    /**
     * Apply the given condition to the query.
     *
     * @param array $condition
     * @return $this
     */
    protected function setQuery($conditions = [])
    {
        foreach ($conditions as $key => $condition) {
            if (array_key_exists($key, $this->conditionMappings)) {
                $method = $this->conditionMappings[$key];
                $this->{$method}($condition);
            } else {
                throw new \InvalidArgumentException("Invalid conditions key: $key");
            }
        }
        // foreach ($this->conditionMappings as $key => $method) {
        //     if (!empty($conditions[$key])) {
        //         $this->{$method}($conditions[$key]);
        //     }
        // }
        return $this;
    }

    /**
     * Apply a "select" condition to the query.
     *
     * @param array $columns
     * @return void
     */
    protected function applySelect($columns)
    {
        $this->query->select($columns);
    }

    /**
     * Apply a "with" condition to the query for eager loading.
     *
     * @param array $relations
     * @return void
     */
    protected function applyWith($relations)
    {
        $this->query->with($relations);
    }

    /**
     * Apply a "where" condition to the query.
     *
     * @param array $conditions
     * @return void
     */
    protected function applyWhere($conditions)
    {
        $this->query->where($conditions);
    }

    /**
     * Apply a "where in" condition to the query.
     *
     * @param array $conditions
     * @return void
     */
    protected function applyWhereIn($conditions)
    {
        array_walk($conditions, fn($values, $column) => $this->query->whereIn($column, $values));
    }

    /**
     * Apply a "where not in" condition to the query.
     *
     * @param array $conditions
     * @return void
     */
    protected function applyWhereNotIn($conditions)
    {
        array_walk($conditions, fn($values, $column) => $this->query->whereNotIn($column, $values));
    }

    /**
     * Apply a "where like" condition to the query.
     *
     * @param array $conditions
     * @return void
     */
    protected function applyWhereLike($conditions)
    {
        array_walk($conditions, fn($value, $column) => $this->query->where($column, 'LIKE', "%$value%"));
    }

    /**
     * Apply a "where null" condition to the query.
     *
     * @param array $conditions
     * @return void
     */
    protected function applyWhereNull($columns)
    {
        array_walk($columns, fn($column) => $this->query->whereNull($column));
    }

    /**
     * Apply a "where not null" condition to the query.
     *
     * @param array $conditions
     * @return void
     */
    protected function applyWhereNotNull($columns)
    {
        array_walk($columns, fn($column) => $this->query->whereNotNull($column));
    }

    /**
     * Apply a "where between" condition to the query.
     *
     * @param array $conditions
     * @return void
     */
    protected function applyWhereBetween($conditions)
    {
        foreach ($conditions as $column => $values) {
            if (is_array($values) && count($values) === 2) {
                $this->query->whereBetween($column, $values);
            }
        }
    }

    /**
     * Apply a "where date" condition to the query.
     *
     * @param array $conditions
     * @return void
     */
    protected function applyWhereDate($conditions)
    {
        array_walk($conditions, fn($value, $column) => $this->query->whereDate($column, $value));
    }

    /**
     * Apply a "where not equal" condition to the query.
     *
     * @param array $conditions
     * @return void
     */
    protected function applyWhereNotEqual($conditions)
    {
        foreach ($conditions as $condition) {
            if (is_array($condition) && count($condition) == 3) {
                $this->query->where($condition[0], $condition[1], $condition[2]);
            }
        }
    }

    /**
     * Apply a "where raw" condition to the query.
     *
     * @param array $conditions
     * @return void
     */
    protected function applyWhereRaw($conditions)
    {
        array_walk($conditions, function ($value) {
            if (is_array($value)) {
                // $value[0]: command SQL, $value[1]: array binding
                $this->query->whereRaw($value[0], $value[1]);
            } else {
                // only command SQL
                $this->query->whereRaw($value);
            }
        });
    }

    /**
     * Apply a "where has" condition to the query.
     *
     * @param array $conditions
     * @return void
     */
    protected function applyWhereHas($condition)
    {
        foreach ($condition as $relation => $whereConditions) {
            $this->query->whereHas($relation, function ($query) use ($whereConditions) {
                foreach ($whereConditions as $column => $condition) {
                    $type = $condition['type'] ?? 'where';
                    $query->{$type}($column, $condition['value']);
                }
            });
        }
    }

    /**
     * Apply a raw SELECT expression to the query.
     *
     * This method allows you to specify a raw SQL expression to be selected in the query.
     *
     * @param string $expression The raw SQL expression.
     * @return void
     */
    protected function applySelectRaw($expression)
    {
        $this->query->selectRaw($expression);
    }

    /**
     * Apply a GROUP BY condition to the query.
     *
     * This method groups the results by one or more columns. The columns can be provided
     * as a string or an array.
     *
     * @param array|string $columns The column(s) by which to group the results.
     * @return void
     */
    protected function applyGroupBy($columns)
    {
        $this->query->groupBy($columns);
    }

    /**
     * Apply a HAVING condition to the query.
     *
     * This method adds a HAVING clause to the query. The conditions must be provided as
     * an array of conditions where each condition is itself an array with 3 elements:
     * column, operator, and value.
     *
     * @param array $conditions An array of conditions, where each condition is an array
     *                          with 3 elements: [column, operator, value].
     * @return void
     */
    protected function applyHaving($conditions)
    {
        foreach ($conditions as $condition) {
            if (is_array($condition) && count($condition) == 3) {
                $this->query->having($condition['column'], $condition['operator'], $condition['value']);
            }
        }
    }

    /**
     * Get a list of data with the specified conditions, sorting, pagination, and limits.
     *
     * This method applies the given conditions and sorting to the query, and returns
     * the paginated data along with the total number of records.
     *
     * @param array $condition Conditions to apply to the query (optional).
     * @param array $sort Sorting criteria for the results (optional).
     * @param int $skip The number of records to skip (for pagination).
     * @param int $limit The maximum number of records to return (for pagination).
     * @return array An array with two elements: the paginated data and the total count of records.
     */
    public function getList($condition = [], $sort = [], $skip = 0, $limit = self::DEFAULT_PAGINATE)
    {
        $this->newQuery()->setQuery($condition)->sort($sort);
        $total = $this->query->count();
        $data = $this->query->skip((int)$skip)->limit((int)$limit)->get();
        return [$data, $total];
    }

    /**
     * Protected method `applyWhereOperator`:
     * - Purpose: Apply multiple "where" conditions with specific operators to the query.
     * - This method iterates over the provided `$conditions` array and applies each condition to the query.
     * - It uses `array_walk()` for iteration, with a callback function to process each condition.
     * - Each condition specifies:
     *   - `column`: The database column to filter on.
     *   - `operator`: The comparison operator (e.g., '=', '<', '>', etc.).
     *   - `value`: The value to compare against.
     *
     * @param array $conditions
     * @return void
     */
    protected function applyWhereOperator($conditions)
    {
        foreach ($conditions as $condition) {
            if (is_array($condition) && count($condition) == 3) {
                $this->query->where($condition['column'], $condition['operator'], $condition['value']);
            }
        }
    }

    protected function applyWhereDoesntHave($conditions)
    {
        foreach ($conditions as $relation => $whereConditions) {
            $this->query->whereDoesntHave($relation, function ($query) use ($whereConditions) {
                foreach ($whereConditions as $column => $condition) {
                    $type = $condition['type'] ?? 'where';
                    $query->{$type}($column, $condition['operator'] ?? '=', $condition['value']);
                }
            });
        }
    }
}
