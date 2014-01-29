<?php
class myIterator implements Iterator {
    private $position = 0;
    private $array = array(
        "premierelement",
        "secondelement",
        "dernierelement",
    );  
 private $array2 = array(
        "premierelement1",
        "secondelement2",
        "dernierelement3",
    ); 
    public function __construct() {
        $this->position = 0;
    }

    function rewind() {
        var_dump(__METHOD__);
        $this->position = 0;
    }

    function current() {
        var_dump(__METHOD__);
        return $this->array2[$this->position];
    }

    function key() {
        var_dump(__METHOD__);
        return $this->position;
    }

    function next() {
        var_dump(__METHOD__);
        ++$this->position;
    }

    function valid() {
        var_dump(__METHOD__);
        return isset($this->array[$this->position]);
    }
}

$it = new myIterator;

foreach($it as $key => $value) {
    var_dump($key, $value);
    echo "\n";
}
?>