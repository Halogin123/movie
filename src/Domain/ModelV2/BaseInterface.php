<?php

namespace Ducnm\Domain\ModelV2;

interface BaseInterface
{
    /**
     * $condition là mảng chứa các điều kiện lọc cho truy vấn, với các key và ý nghĩa cụ thể như sau:
     *
     * - 'select' (array):
     *   Danh sách các cột cần lấy khi thực hiện truy vấn.
     *   Ví dụ: `$condition['select'] = ['id', 'name', 'email'];`
     *
     * - 'with' (array):
     *   Danh sách các mối quan hệ cần eager load để tối ưu hóa truy vấn.
     *   Ví dụ: `$condition['with'] = ['profile', 'posts'];`
     *
     * - 'where' (array):
     *   Điều kiện where cơ bản, là một mảng các cặp key-value.
     *   Ví dụ: `$condition['where'] = ['status' => 'active', 'type' => 'admin'];`
     *
     * - 'in' (array):
     *   Điều kiện whereIn, trong đó key là tên cột và value là mảng giá trị.
     *   Ví dụ: `$condition['in'] = ['id' => [1, 2, 3]];`
     *
     * - 'not_in' (array):
     *   Điều kiện whereNotIn, tương tự như whereIn nhưng lấy những giá trị không nằm trong mảng.
     *   Ví dụ: `$condition['not_in'] = ['status' => ['inactive', 'banned']];`
     *
     * - 'like' (array):
     *   Điều kiện like, dùng để tìm các bản ghi có chứa giá trị tương tự.
     *   Ví dụ: `$condition['like'] = ['name' => 'John'];`
     *
     * - 'is_null' (array):
     *   Danh sách các cột cần kiểm tra NULL.
     *   Ví dụ: `$condition['is_null'] = ['deleted_at'];`
     *
     * - 'is_not_null' (array):
     *   Danh sách các cột cần kiểm tra NOT NULL.
     *   Ví dụ: `$condition['is_not_null'] = ['updated_at'];`
     *
     * - 'between' (array):
     *   Điều kiện whereBetween, dùng để lọc giá trị trong một khoảng nhất định.
     *   Ví dụ: `$condition['between'] = ['created_at' => ['2023-01-01', '2023-12-31']];`
     *
     * - 'not_equal' (array):
     *   Điều kiện not_equal, dùng để lọc giá trị không bằng.
     *   Ví dụ: `$condition['not_equal'] = [['status', '!=', 'avtice'] , ['quantity', '>', '1']];`
     */

    /**
     * $sort dùng để sắp xếp kết quả truy vấn dựa trên các điều kiện sắp xếp.
     *
     * $sort Mảng chứa các điều kiện sắp xếp với cấu trúc:
     * - Key là tên cột cần sắp xếp.
     * - Value là thứ tự sắp xếp (`ASC` cho tăng dần, `DESC` cho giảm dần).
     *
     * Ví dụ: $sort = ['name' => 'ASC', 'created_at' => 'DESC'];
     * - Truy vấn sẽ áp dụng sắp xếp theo thứ tự các phần tử trong `$sort`, trong đó `name` tăng dần trước, rồi đến `created_at` giảm dần.
     *
     * Hành vi mặc định:
     * - Nếu `$sort` không có giá trị (mảng rỗng), truy vấn sẽ tự động sắp xếp theo cột `created_at` giảm dần (`DESC`).
     */
    public function getAll();
    public function findById(int $id, array $relations = []);
    public function create(array $attributes, array $relations = []);
    public function createMany(array $attributesList);
    public function updateById(int $id, array $attributes, array $relations = []);
    public function deleteById(int $id);
    public function findOneSortColumn(array $condition, array $sort = []);
    public function findManySortColumn(array $condition, array $sort = []);
    public function count(array $condition = []);
    public function findOne(array $condition);
    public function findOneLockUpdate(array $condition);
    public function findMany(array $condition);
    public function findManyLockUpdate(array $condition);
    public function paginate(array $condition, array $sort = [], int $limit = 10);
    public function limit(array $condition, array $sort = [], int $skip = 0, int $limit = 10);
    public function chunk(callable $callback, int $size = 10, array $relations = []);
    public function min(array $condition, string $column);
    public function max(array $condition, string $column);
    public function sum(array $condition, string $column);
    public function updateBy(array $condition, array $attributes);
    public function truncate(bool $boolean = false);
    public function exists(array $condition = []);
    public function deleteMany(array $where);
    public function createOrUpdate(array $condition = [], array $attributes = []);
    public function getList(array $condition = [], array $sort = [], int $skip = 0, int $limit = 10);
}
