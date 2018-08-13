<?php
namespace common\components;

use Yii;
use yii\base\InvalidConfigException;
use yii\db\Connection;
use yii\db\Exception;
use yii\di\Instance;
use yii\helpers\VarDumper;
use yii\log\DbTarget;

class DbTargetLog extends DbTarget{
	
	public function export(){
		if ($this->db->getTransaction()) {
            // create new database connection, if there is an open transaction
            // to ensure insert statement is not affected by a rollback
            $this->db = clone $this->db;
        }
        $tableName = $this->db->quoteTableName($this->logTable);
        $sql = "INSERT INTO $tableName ([[level]], [[uid]], [[category]], [[log_time]], [[type]], [[title]], [[prefix]], [[server_ip]] ,[[client_ip]], [[message]])
                VALUES (:level, :uid, :category, :log_time, :type, :title, :prefix, :server_ip, :client_ip, :message)";
        $command = $this->db->createCommand($sql);
        foreach ($this->messages as $message) {
			list($uid, $type, $title) = [0, '', ''];
            list($text, $level, $category, $timestamp) = $message;
            if (!is_string($text)) {
                // exceptions may not be serializable if in the call stack somewhere is a Closure
				if ($text instanceof LogMessage){
					$uid = $text->uid;
					$type = $text->type;
					$title = $text->title;
					$message = $text->message;
					$text = $message;
				}else if ($text instanceof \Throwable || $text instanceof \Exception) {
                    $text = (string) $text;
                } else {
                    $text = VarDumper::export($text);
                }
            }
            if ($command->bindValues([
					':uid' => $uid,
                    ':level' => $level,
                    ':category' => $category,
                    ':log_time' => $timestamp,
					':type' => $type,
					':title' => $title,
                    ':prefix' => $this->getMessagePrefix($message),
					':server_ip' => $_SERVER['SERVER_ADDR'],
					':client_ip' => Yii::$app->request->userIP,
                    ':message' => $text,
                ])->execute() > 0) {
                continue;
            }
            throw new LogRuntimeException('Unable to export log through database!');
        }
    }
	
}
