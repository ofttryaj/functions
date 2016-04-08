<?php
/**
 * functions
 */

/**
 * 检测多维数组是否为空
 *
 * @param array $array 待检测的数组
 * @return bool true表示为空, false表示不为空
 */
function multiArrNull($array)
{
    $isEmpty = true;
    array_walk_recursive($array, function ($value) use (&$isEmpty) {
        if ($value) {
            $isEmpty = false;
        }
    });

    return $isEmpty;
}

/**
 * 针对多维数组去重
 *
 * @param array $array 多维数组或者一维数组
 * @return array
 */
function multiArrUnique($array)
{
    $result = array_map("unserialize", array_unique(array_map("serialize", $array)));

    foreach ($result as $key => $value)
    {
        if ( is_array($value) )
        {
            $result[$key] = multiArrUnique($value);
        }
    }

    return $result;
}