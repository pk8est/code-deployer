<?php
use common\foundation\ArrayHelper; 

if(!function_exists('array_get')){
	function array_get($array, $key, $default = null){
		return ArrayHelper::getValue($array, $key, $default);
	}
}

if(!function_exists('array_has')){
	function array_has($array, $key){
		return Arrayhelper::has($array, $key);
	}
}

if(!function_exists('array_map')){
	function array_map($array, $from, $to, $group = null){
		return ArrayHelper::map($array, $from, $to, $group);
	}
}

if(!function_exists('array_list')){
	function array_list($array, $to, $group = null){
		return ArrayHelper::list($array, $to, $group);
	}
}

if(!function_exists('to_array')){
	function to_array($object, $properties = [], $recursisv = true){
		return ArrayHelper::toArray($object, $properties, $recursisv);
	}
}

if(!function_exists('array_merge')){
	function array_merge($a, $b){
		return ArrayHelper::merge($a, $b);
	}
}

if(!function_exists('array_set')){
	function array_set($array, $path, $value){
		return ArrayHelper::setValue($array, $path, $value);
	}
}

if(!function_exists('array_remove')){
	function array_remove(&$array, $key, $default = null){
		return ArrayHelper::remove($array, $key, $default);
	}
}

if(!function_exists('array_remove_value')){
	function array_remove_value(&$array, $value){
		return ArrayHelper::removeValue($array, $value);
	}
}

if(!function_exists('array_index')){
	function array_index($array, $key, $groups = []){
		return ArrayHelper::index($array, $key, $groups);
	}
}

if(!function_exists('array_column')){
	function array_column($array, $name, $keepKeys = true){
		return ArrayHelper::getColumn($array, $name, $keepKeys);
	}
}

if(!function_exists('array_pull')){
	function array_pull(&$array, $key, $default = null){
		return ArrayHelper::pull($array, $key, $default);
	}
}

if(!function_exists('array_only')){
    function array_only($array, $key){
        return ArrayHelper::only($array, $key);
    }                                                                                                                    
} 

if(!function_exists('array_collapse')){
    function array_collapse($array){
        return ArrayHelper::collapse($array);
    }                                                                                                                    
} 

if(!function_exists('array_except')){
    function array_except($array, $key){
        return ArrayHelper::except($array, $key);
    }                                                                                                                    
} 

if(!function_exists('array_shuffle')){
    function array_shuffle($array, $seed = null){
        return ArrayHelper::shuffle($array, $seed);
    }                                                                                                                    
} 

if(!function_exists('array_where')){
    function array_where($array, callable $callback){
        return ArrayHelper::pull($array, $callback);
    }                                                                                                                    
} 

if(!function_exists('array_random')){
    function array_random($array, $number = null){
        return ArrayHelper::random($array, $number);
    }
}

if(!function_exists('array_key_values')){
    function array_key_values($array, $value, $key = null){
        return ArrayHelper::getKeyValues($array, $value, $key);
    }
} 
