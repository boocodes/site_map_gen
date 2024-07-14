<?php

namespace Classes;

use Exceptions\ErrorGoalYearException;
use Interfaces\PromoDaysInterface;

class PromoDays implements PromoDaysInterface
{
    const MONTH_COUNT = 12;
    const FRIDAY_AS_INT = 5;
    const START_YEAR = 2000;
    private int $promoChairs = 0;
    private int $promoTables = 0;
    private array $tablesDaysData = [];
    private array $chairsDaysData = [];
    private int $goalYear = 0;

    /**
     * @throws ErrorGoalYearException
     */
    public function __construct($goalYear)
    {
        if ($goalYear < 2000) {
            throw  new ErrorGoalYearException("Error, goal year must be less than 2000\n");
        }
        $this->goalYear = $goalYear;
    }

    private function isOdd($num): bool
    {
        return $num % 2 == 0;
    }

    private function getChairsDaysData(): array
    {
        return $this->chairsDaysData;
    }

    private function getTablesDaysData(): array
    {
        return $this->tablesDaysData;
    }

    private function getMonthNameByInt($int)
    {
        switch ($int) {
            case 1:
                return 'янв.';
            case 2:
                return 'фев.';
            case 3:
                return 'март';
            case 4:
                return 'апр.';
            case 5:
                return 'май';
            case 6:
                return 'июнь';
            case 7:
                return 'июль';
            case 8:
                return 'авг.';
            case 9:
                return 'сент.';
            case 10:
                return 'окт.';
            case 11:
                return 'нояб.';
            case 12:
                return 'дек.';
        }
    }

    private function increaseTablesCount($year, $month, $day): void
    {
        $this->promoTables++;
        $this->tablesDaysData[] = $day . '-e' . ' ' . $this->getMonthNameByInt($month) . ' ' . $year;
    }

    private function increaseChairsCount($year, $month, $day): void
    {
        $this->promoChairs++;
        $this->chairsDaysData[] = $day . '-e' . ' ' . $this->getMonthNameByInt($month) . ' ' . $year;
    }

    // standard calc method

    /**
     * @throws ErrorGoalYearException
     */
    public function calculate(): array
    {
        if (!isset($this->goalYear)) {
            throw new ErrorGoalYearException();
        }
        for ($year = self::START_YEAR; $year <= $this->goalYear; $year++) {
            for ($month = 1; $month <= self::MONTH_COUNT; $month++) {
                for ($day = 1; $day <= 31; $day++) {
                    if (date("w", mktime(0, 0, 0, $month, $day, $year)) == self::FRIDAY_AS_INT) {
                        // goal friday
                        if ($this->promoTables > $this->promoChairs) {
                            $this->increaseChairsCount($year, $month, $day);
                            break;
                        } else if ($this->promoChairs > $this->promoTables) {
                            $this->increaseTablesCount($year, $month, $day);
                            break;
                        } else if ($this->promoTables == $this->promoChairs) {
                            if ($this->isOdd($month)) {
                                $this->increaseChairsCount($year, $month, $day);
                            } else {
                                $this->increaseTablesCount($year, $month, $day);
                            }
                            break;
                        }
                    };
                }
            }
        }
        return $this->tablesDaysData;
    }

    // second method for faster calculating
    public function calculate_fast()
    {

    }

}