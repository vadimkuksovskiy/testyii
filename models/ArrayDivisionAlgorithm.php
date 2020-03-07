<?php

namespace app\models;

class ArrayDivisionAlgorithm
{
    const CODE_FAIL = -1;

    protected $array;
    protected $value;
    protected $leftCounter;
    protected $rightCounter;

    /**
     * ArrayDivisionAlgorithm constructor.
     * @param int $value
     * @param array $array
     */
    public function __construct(int $value, array $array)
    {
        $this->value = $value;
        $this->array = $array;
    }

    /**
     * @return int
     */
    public function run(): int
    {
        $this->leftCounter = -1;
        $this->rightCounter = count($this->array);

        while ($this->checkCrossing()) {

            while (isset($this->array[$this->leftCounter + 1])
                && $this->array[$this->leftCounter + 1] !== $this->value
                && $this->checkCrossing()
            ) {
                $this->leftCounter++;
            }

            if (!$this->checkCrossing()) {
                break;
            }

            while (isset($this->array[$this->rightCounter - 1])
                && $this->array[$this->rightCounter - 1] === $this->value
                && $this->checkCrossing()
            ) {
                $this->rightCounter--;
            }

            if (!$this->checkCrossing()) {
                $this->leftCounter++;
                break;
            }

            $this->leftCounter++;
            $this->rightCounter--;

            // по условию задачи нужно возвращать индекс числа, перед которым нужно поставить разделение
            if ($this->leftCounter === count($this->array)) {
                return self::CODE_FAIL;
            }
        }

        return $this->leftCounter;
    }

    /**
     * @return bool
     */
    protected function checkCrossing(): bool
    {
        return $this->leftCounter < $this->rightCounter;
    }
}
