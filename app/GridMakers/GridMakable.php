<?php

declare(strict_types=1);

namespace App\GridMakers;

use App\GridMakers\Filter\FilterableKeysDict;
use App\GridMakers\Filter\FilterQueries;

interface GridMakable
{
    /**
     * フィルタやソート機能を利用した結果の配列を返す
     *
     * @param string $order_by ソート対象の列
     * @param string $direction ascかdesc
     * @param FilterQueries $filter_queries フィルタークエリ
     * @param string $filter_mode フィルターのモード。 and か or
     * @param int $offset SQL で言う所の offset
     * @param int $limit SQL で言う所の limit
     * @return array
     */
    public function getArray(
        string $order_by,
        string $direction,
        FilterQueries $filter_queries,
        string $filter_mode,
        int $offset,
        int $limit
    ): array;

    /**
     * フィルタ適用後の全件数を取得
     *
     * @param FilterQueries $filter_queries フィルタークエリ
     * @param string $filter_mode フィルターのモード。 and か or
     * @return int
     */
    public function getCount(
        FilterQueries $filter_queries,
        string $filter_mode
    ): int;

    /**
     * 表示するキー
     *
     * @return array
     */
    public function keys(): array;

    /**
     * フィルタ可能なキー
     *
     * @return FilterableKeysDict
     */
    public function filterableKeys(): FilterableKeysDict;

    /**
     * ソート可能なキー
     *
     * @return array
     */
    public function sortableKeys(): array;
}
