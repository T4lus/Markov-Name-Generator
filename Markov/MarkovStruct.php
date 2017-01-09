<?php

namespace Classes\Markov;

class MarkovStruct {

	public $start 	= "";
	public $end 	= "";
	public $weight	= 1;

	public function __construct($_start, $_end) {
		$this->start 	= $_start;
		$this->end 		= $_end;
	}

}