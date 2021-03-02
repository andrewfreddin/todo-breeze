<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function assertIsCollection($item)
    {
        $this->assertTrue((bool)((get_class($item) == Collection::class) | (get_class($item) == DBCollection::class)));
    }

    /**
     * Function to compare floats since PHP really sucks at floats
     * @param float $a
     * @param float $b
     * @return bool
     */
    protected function floatsEqual($a,$b)
    {
        $epsilon = 0.00001;
        return ($a - $b) < $epsilon;
    }

    /**
     *Assertion to check if the given item is of class $class
     * @param string $class the class item should be
     * @param object $item the item to check
     */
    protected function assertIsClass($class, $item)
    {
        $this->assertEquals($class, get_class($item));
    }

    /**
     * assertion to see if two variables are the same class
     * @param $a
     * @param $b
     */
    protected function assertSameClass($a,$b)
    {
        $this->assertEquals(get_class($a), get_class($b));
    }
}
