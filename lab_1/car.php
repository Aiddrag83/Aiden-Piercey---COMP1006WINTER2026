<?php

/**
 * Class of car
 * Represents a car with basic details.
 */
class Car
{
    private string $make;
    private string $model;
    private int $year;
    /**
     * Car constructor!!
     */
    public function __construct(string $make, string $model, int $year)
    {
        $this->make  = $make;
        $this->model = $model;
        $this->year  = $year;
    }
    /**
     * Returns formatted car information I believe (If im being honest Im just trying to submit this and get it done)
     */
    public function getCarInfo(): string
    {
        return "{$this->year} {$this->make} {$this->model}";
    }
}
