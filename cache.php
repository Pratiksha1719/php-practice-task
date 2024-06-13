<?php

class LRUCache
{
    private $array;
    private $count;

    public function __construct()
    {
        $this->array = array();
        $this->count = count($this->array);
    }

    public function getElement($key)
    {
        if (isset($this->array[$key])) {
            // Move the accessed item to the front of the array
            $value = $this->array[$key];
            unset($this->array[$key]);
            $this->array = $this->reaarange($key,$value);
            print_r($this->array);
            return $value;
        } else {
            return "key not exist!";
        }
    }

    public function setElment($key, $value)
    {
        if (isset($this->array[$key])) {
            // Update the value and move it to the front of the array
            $this->array[$key] = $value;
            $this->array = $this->reaarange($key,$value);
        } else {
            // Add the new item to the front of the array
            $this->array = $this->reaarange($key,$value);
            if (count($this->array) > $this->count) {
                // Remove the oldest item (last element of the array)
                array_pop($this->array);
            }
        }
    }
    public function reaarange($key,$value){
        return  array($key => $value) + $this->array;
    }
    public function createArray($size){
        $this->array = array_fill(0,$size,null);
    }
}

$cache = new LRUCache(); // Create a cache with a maximum size of 3

$cache->createArray(4);
$cache->setElment('key1', 'value1');
$cache->setElment('key2', 'value2');
$cache->setElment('key3', 'value3');
$cache->setElment('key4', 'value4');


echo $cache->getElement('key2'); // Output: value1
// echo $cache->getElement('key2'); // Output: value2
// echo $cache->getElement('key3'); // Output: value3


// $cache->setElment('key5', 'value5'); // Evict key1
// echo $cache->get('key1'); // Output: null

// $cache->setElment('key6', 'value6')."\n"; // Evict key2
// echo $cache->get('key2'); // Output: null

// echo $cache->get('key3'); // Output: value3
// echo $cache->get('key4'); // Output: value4
// echo $cache->getElement('key5')."\n"; // Output: value5

echo $cache->getElement('key10')."\n"; // Output: value5

