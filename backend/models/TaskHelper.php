<?php

namespace backend\models;
use common\models\Task;
use yii\base\Model;
use Yii;
class TaskHelper extends Model
{

    public static function getTable(Task $task){
        $html = '';
        $answer = $task->answers;
        if ($answer){
            $html = '<table>';
            if (is_array($answer)){
                $answer = $answer[0];
            }
            $answers = json_decode($answer->name,true);
            $size = sqrt(sizeof($answers));
            for ($i = 0; $i < $size; $i++){
                $html.='<tr>';
                for ($j = 0; $j < $size; $j++){
                    $html.='<td>'.($answers[$j + ($size * $i)]['value']+1).'</td>';
                }
                $html.='</tr>';
            }
            $html.='</table>';
        }
        return $html;
    }

    public static function getTaskHtml(Task $task){
        $url = Yii::$app->params['url'];
        if (in_array($task->type, [Task::TYPE_TEST_IMG, Task::TYPE_TEST, Task::TYPE_TEST_CLOSE])){
            return $task->url ? "<img src='$url.$task->url' style='max-width: 100px;'>": '';
        }else if (in_array($task->type, [Task::TYPE_SUDOKU_IMG, Task::TYPE_SUDOKU_NUMBER])){
            return self::getTable($task);
        }else if(in_array($task->type, [Task::TYPE_ARITHMETIC_NUMBER, Task::TYPE_ARITHMETIC_SYMBOL])){
            return $task->url;
        }
    }

}