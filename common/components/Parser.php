<?php
namespace common\components;

use Yii;

class Parser{

	public static function parseString($script, array $tokens = []){
        $script = self::tidyScript($script);

        $values = array_values($tokens);

        $tokens = array_map(function ($token) {
            return '{{ ' . strtolower($token) . ' }}';
        }, array_keys($tokens));

        return str_replace($tokens, $values, $script);
    }

	public static function parseFile($file, array $tokens = []){
        $template = Yii::getAlias('@common') . '/resources/scripts/' . str_replace('.', '/', $file) . '.sh';

        if (file_exists($template)) {
            return self::parseString(file_get_contents($template), $tokens);
        }

        throw new \RuntimeException('Template ' . $template . ' does not exist');
    }

	private static function tidyScript($script){
        return $script;
    }

}
