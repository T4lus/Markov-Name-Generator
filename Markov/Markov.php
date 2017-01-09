<?php

namespace Classes\Markov;

use GCRandom;
use Classes\Markov\MarkovStruct;

class Markov {

	private $Random;
	private $MarkovList 	= array();
	private $NameList		= array();
	private $depth 			= 2;

	public function __construct($seed) {
		$this->Random = new GCRandom();
		$this->Random->setSeed($seed);
	}

	public function setSeed($_seed) {
		$this->Random->setSeed($_seed);
	}

	public function setNameList($_list) {
		$this->NameList = $_list;
	}

	public function setMarkovList($_list) {
		$this->MarkovList = $_list;
	}

	public function getNameList() {
		return $this->NameList;
	}

	public function getMarkovList() {
		return $this->MarkovList;
	}

	public function ressetMarkovList() {
		$this->MarkovList = array();
	}

	public function makeList(){
		foreach ($this->NameList as $keyAry => $valueAry) {
			$sampleArray 	= str_split($valueAry);
			$sampleLen 		= count($sampleArray);

			for ($i=0; $i < $sampleLen; $i++) { 
				if (isset($sampleArray[$i + 1]))
					$start = $sampleArray[$i] . $sampleArray[$i + 1];
				if(isset($sampleArray[$i + 2]))
					$end = $sampleArray[$i + 2];
				else
					$end = NULL;

				$find = false;
				$neededObject = array_filter(
					$this->MarkovList,
					function ($e) use (&$start) {
						return $e->start == $start;
					}
				);

				foreach ($neededObject as $key => $value) {
					if ($value->end == $end) {
						$value->weight++;
						$find = true;
						break;
					}
				}
				if (!$find && $i < $sampleLen - 1) {
					$this->MarkovList[] = new MarkovStruct($start, $end);
				}
			}
		}
		return $this->MarkovList;
	}

	public function makeName($maxLen = 10) {
		$name = "";

		$startExample = str_split($this->NameList[$this->Random->randArray($this->NameList)]);
		$name = $startExample[0] . $startExample[1];

		foreach ($this->MarkovList as $key => $value) {
			$nameChar = str_split($name);		

			if (count($nameChar) >= $maxLen)
				break;

			$start = $nameChar[count($nameChar) - 2] . $nameChar[count($nameChar) - 1];
			$neededObject = array_filter(
				$this->MarkovList,
				function ($e) use (&$start) {
					return $e->start == $start;
				}
			);

			$weightedTab = array();
			foreach ($neededObject as $key => $value) {
				$weightedTab[$key] = array('val' => $value->end, 'weight' => $value->weight );
			}
			$selectedKey = $this->Random->randArray($weightedTab);
			$weightedTab = array_values($weightedTab);

			if ($weightedTab[$selectedKey]['val']) {
				$name .= $weightedTab[$selectedKey]['val'];
			}
			else {
				break;
			}
		}
		if (in_array($name, $this->NameList))
			$this->makeName();
		return trim($name);
	}
}