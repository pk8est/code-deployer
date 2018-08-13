<?php
namespace common\foundation;


class ArrayHelper extends \yii\helpers\ArrayHelper{


	public static function only($array, $keys)
	{
		return array_intersect_key($array, array_flip((array) $keys));
	}

	public static function collapse($array)
    {
        $results = [];
        foreach ($array as $values) {
            if ($values instanceof Collection) {
                $values = $values->all();
            } elseif (! is_array($values)) {
                continue;
            }
            $results = array_merge($results, $values);
        }
        return $results;
    }

	public static function except($array, $keys)
    {
        static::forget($array, $keys);
        return $array;
    }

	 public static function has($array, $keys)
    {
        if (is_null($keys)) {
            return false;
        }
        $keys = (array) $keys;
        if (! $array) {
            return false;
        }
        if ($keys === []) {
            return false;
        }
        foreach ($keys as $key) {
            $subKeyArray = $array;
            if (static::exists($array, $key)) {
                continue;
            }
            foreach (explode('.', $key) as $segment) {
                if (static::accessible($subKeyArray) && static::exists($subKeyArray, $segment)) {
                    $subKeyArray = $subKeyArray[$segment];
                } else {
                    return false;
                }
            }
        }
        return true;
    }
	
	 public static function getKeyValues($arr, $value, $key = null){
        $data = array();
        foreach ($arr as $k => $v) {
            if(is_array($v)){
				$itemValue = static::getValue($v, $value);
				if($key !== null){
					$itemKey = static::getValue($v, $key);
					if(is_string($itemKey)){
						$data[$itemKey] = $itemValue;
					}else if(is_object($itemKey) && method_exists($itemKey, '__toString')){
						$data[(string)$itemkey] = $itemValue;
					}
				}else if($itemValue !== null){
					$data[] = $itemValue;
				}
            }
        }
        return $data;
    }

	public static function pull(&$array, $key, $default = null)
    {
        $value = static::get($array, $key, $default);
        static::forget($array, $key);
        return $value;
    }

	public static function random($array, $number = null)
    {
        $requested = is_null($number) ? 1 : $number;
        $count = count($array);
        if ($requested > $count) {
            throw new InvalidArgumentException(
                "You requested {$requested} items, but there are only {$count} items available."
            );
        }
        if (is_null($number)) {
            return $array[array_rand($array)];
        }
        if ((int) $number === 0) {
            return [];
        }
        $keys = array_rand($array, $number);
        $results = [];
        foreach ((array) $keys as $key) {
            $results[] = $array[$key];
        }
        return $results;
    }

	public static function set(&$array, $key, $value)
    {
        if (is_null($key)) {
            return $array = $value;
        }
        $keys = explode('.', $key);
        while (count($keys) > 1) {
            $key = array_shift($keys);
            // If the key doesn't exist at this depth, we will just create an empty array
            // to hold the next value, allowing us to create the arrays to hold final
            // values at the correct depth. Then we'll keep digging into the array.
            if (! isset($array[$key]) || ! is_array($array[$key])) {
                $array[$key] = [];
            }
            $array = &$array[$key];
        }
        $array[array_shift($keys)] = $value;
        return $array;
    }

	public static function shuffle($array, $seed = null)
    {
        if (is_null($seed)) {
            shuffle($array);
        } else {
            srand($seed);
            usort($array, function () {
                return rand(-1, 1);
            });
        }
        return $array;
    }

	public static function where($array, callable $callback)
    {
        return array_filter($array, $callback, ARRAY_FILTER_USE_BOTH);
    }

	public static function list($array, $to, $group = null){
        $result = array();
        foreach ($array as $key=>$element) {
            $value = static::getValue($element, $to);
            if ($group !== null) {
                $result[static::getValue($element, $group)][$key] = $value;
            } else {
                $result[$key] = $value;
            }
        }

        return $result;
    }

	public static function accessible($value)
    {
        return is_array($value) || $value instanceof ArrayAccess;
    }

	public static function forget(&$array, $keys)
    {
        $original = &$array;
        $keys = (array) $keys;
        if (count($keys) === 0) {
            return;
        }
        foreach ($keys as $key) {
            // if the exact key exists in the top-level, remove it
            if (static::exists($array, $key)) {
                unset($array[$key]);
                continue;
            }
            $parts = explode('.', $key);
            // clean up before each pass
            $array = &$original;
            while (count($parts) > 1) {
                $part = array_shift($parts);
                if (isset($array[$part]) && is_array($array[$part])) {
                    $array = &$array[$part];
                } else {
                    continue 2;
                }
            }
            unset($array[array_shift($parts)]);
        }
    }

	public static function exists($array, $key)
    {
        if ($array instanceof ArrayAccess) {
            return $array->offsetExists($key);
        }
        return array_key_exists($key, $array);
    }


}


