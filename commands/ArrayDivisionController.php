<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\AlgorithmResult;
use app\models\ArrayDivisionAlgorithm;
use app\models\User;
use yii\console\Controller;
use yii\console\ExitCode;

class ArrayDivisionController extends Controller
{
    /**
     * @param int $userId
     * @param int $value
     * @param string $array $array
     * @return int
     */
    public function actionIndex(int $value, string $array, int $userId)
    {
        $array = explode(',', $array);
        $numbers = array_map(function ($element){
            return (int)$element;
        }, $array);

        $algorithm = new ArrayDivisionAlgorithm($value, $numbers);
        $result = $algorithm->run();
        echo $result;


        $algorithmResult = new AlgorithmResult();

        $algorithmResult->request_data = json_encode([
            'value' => $value,
            'array' => $numbers,
        ]);

        $algorithmResult->result = $result;

        $user = User::find()
            ->where(['id'=> $userId])
            ->one();
        if($user->id !== null){
            $algorithmResult->link('user', $user);
        }

        $algorithmResult->save();

        return ExitCode::OK;
    }
}
