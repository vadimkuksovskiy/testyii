<?php

namespace tests\unit\models;

use app\models\ArrayDivisionAlgorithm;
use Codeception\Test\Unit;

class ArrayDivisionAlgorithmTest extends Unit
{
    /**
     * @param array $array
     * @param int $expectedResult
     */
    public function basicTest(array $array, int $expectedResult)
    {
        $algorithm = new ArrayDivisionAlgorithm(5, $array);
        expect($algorithm->run())->equals($expectedResult);
    }

    //region test_run_success
    public function test_run_success_1()
    {
        $this->basicTest([5, 5, 1, 7, 2, 3, 5], 4);
    }

    public function test_run_success_2()
    {
        $this->basicTest([5, 5, 1, 7, 2, 3, 5, 9], 5);
    }

    public function test_run_success_3()
    {
        $this->basicTest([9, 5, 3, 2, 7, 1, 5, 5], 5);
    }

    public function test_run_success_4()
    {
        $this->basicTest([5, 9, 5], 1);
    }

    public function test_run_success_5()
    {
        $this->basicTest([9, 5], 1);
    }

    public function test_run_success_6()
    {
        $this->basicTest([5, 9], 1);
    }

    public function test_run_success_7()
    {
        $this->basicTest([5, 5, 9, 9], 2);
    }

    public function test_run_success_8()
    {
        $this->basicTest([9, 9, 5, 5], 2);
    }

    public function test_run_success_9()
    {
        $this->basicTest([9, 9, 5,], 2);
    }

    public function test_run_success_10()
    {
        $this->basicTest([9, 5, 5,], 1);
    }

    public function test_run_success_11()
    {
        $this->basicTest([5, 5,], 0);
    }

    public function test_run_success_12()
    {
        $this->basicTest([5, 5, 9], 1);
    }
    //endregion


    //region test_run_fail
    public function test_run_fail_1()
    {
        $this->basicTest([], ArrayDivisionAlgorithm::CODE_FAIL);
    }

    public function test_run_fail_2()
    {
        $this->basicTest([9], ArrayDivisionAlgorithm::CODE_FAIL);
    }

    public function test_run_fail_3()
    {
        $this->basicTest([9, 9], ArrayDivisionAlgorithm::CODE_FAIL);
    }
    //endregion
}
