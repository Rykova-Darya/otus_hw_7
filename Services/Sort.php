<?php

namespace Services;

class Sort
{
    private array $arr = [];
    private int $lengthArr;

    private int $cmp = 0;
    private int $asg = 0;

    public function __construct()
    {
    }

    public function selectionSort(): void
    {
        for ($j = $this->lengthArr - 1; $j > 0; $j--)
        {
            $this->Swap($this->findMax($j), $j);
        }
    }

    public function heapSort(): void
    {
        for ($h = (int) ($this->lengthArr / 2) - 1; $h >= 0; $h--) {
            $this->heapify($h, $this->lengthArr);
        }
        for ($j = $this->lengthArr - 1; $j > 0; $j--) {
            $this->Swap(0, $j);
            $this->heapify(0, $j);
        }

    }

    private function heapify(int $root, int $size)
    {
        $P = $root;
        $L = 2 * $P + 1;
        $R = $L + 1;
        if ($L < $size && $this->More($this->arr[$L], $this->arr[$P])) $P = $L;
        if ($R < $size && $this->More($this->arr[$R], $this->arr[$P])) $P = $R;
        if ($P == $root) return;
        $this->Swap($root, $P);
        $this->heapify($P, $size);

    }

    public function setRandom(int $lengthArr)
    {
        $this->lengthArr = $lengthArr;

        mt_srand(12345);

        for ($j = 0; $j < $lengthArr; $j++) {
            $this->arr[$j] = mt_rand(0, $lengthArr * 100 -1);
        }

    }

    public function setSorted(int $lengthArr)
    {
        $this->lengthArr = $lengthArr;
        for ($j = 0; $j < $lengthArr; $j++) {
            $this->arr[$j] = $j+1;
        }
    }

    public function setReversed(int $lengthArr)
    {
        $this->lengthArr = $lengthArr;
        for ($j = 0; $j < $lengthArr; $j++) {
            $this->arr[$j] = $j-1;
        }
    }

    private function More(int $a, int $b): bool
    {
        $this->cmp++;
        return $a > $b;
    }
    private function Swap(int $x, int $y): void
    {
        $t = $this->arr[$x];
        $this->arr[$x] = $this->arr[$y];
        $this->arr[$y] = $t;
        $this->asg += 3;
    }

    private function findMax(int $j)
    {
        $imax = 0;
        for ($i = 1; $i <= $j; $i++) {
            if ($this->More($this->arr[$i], $this->arr[$imax])) {
                $imax = $i;
            }
        }
        return $imax;

    }

    public function toString()
    {
        return "Длинна массива: " . $this->lengthArr . "\tcmp: " . $this->cmp . "\tasg " . $this->asg;

    }
}