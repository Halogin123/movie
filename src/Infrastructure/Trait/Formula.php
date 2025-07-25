<?php

namespace Ducnm\Infrastructure\Trait;

trait Formula
{
    /***
     * @param int $after
     * @param $before
     * @return float
     */
    public function subtract(float $after, $before): float
    {
        return $after - $before;
    }

    /***
     * @param int $after
     * @param $before
     * @return float
     */
    public function addition(int $after, $before): float
    {
        return $after + $before;
    }

    /***
     * @param float $after
     * @param int $before
     * @return float
     */
    public function multiplication(float $after, float $before): float
    {
        return $after * $before;
    }

    /***
     * @param $divisor
     * @param $divided
     * @return float
     */
    public function division($divided, $divisor): float
    {
        if ($divisor <= 0) {
            return 0;
        }
        return $divided / $divisor;
    }

    // formula excel

    /***
     * @param array $values
     * @return float
     */
    public function sum(array $values): float
    {
        $point = 0;

        foreach ($values as $value) {
            if (is_int($value) || is_float($value)) {
                $point += $value;
            }
        }

        return $point;
    }

    /***
     * @param array $valueOne
     * @param array $valueTwo
     * @return float|int
     */
    public function sumProduct(array $valueOne, array $valueTwo): float
    {
        $point = 0;

        if (empty($valueOne)) {
            return $point;
        }

        foreach ($valueOne as $key => $item) {
            if ((is_int($item) || is_float($item)) && (is_int($valueTwo[$key]) || is_float($valueTwo[$key]))){
                $point += ($item * $valueTwo[$key]);
            }
        }

        return $point;
    }

    /***
     * @param $lookupValue
     * @param string $key
     * @param array $data
     * @return array|null
     */
    public function lookup($lookupValue, string $key, array $data): ?array
    {
        $arrayCount = count($data);

        for ($i = 0; $i < $arrayCount - 1; $i++) {
            if ($lookupValue == (float)$data[$arrayCount - 1][$key]) {
                return $data[$arrayCount - 1];
            }

            if ($lookupValue == (float)$data[$i][$key]) {
                return $data[$i];
            }

            if ($lookupValue >= (float)$data[$i][$key] && $lookupValue < (float)$data[$i + 1][$key]) {
                return $data[$i];
            }
        }

        return null;
    }
}
