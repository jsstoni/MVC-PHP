<?php
namespace src;
class Request
{
	public 	$REQUEST_POST = array(),
			$REQUEST_GET = array();

	public function __construct($get, $post)
	{
		array_walk($get, array(&$this, 'set_get'));
		array_walk($post, array(&$this, 'set_post'));
	}

	private function cleanSpace($str)
	{
		if ($str) {
			$str = preg_replace("/[\r\n\s\t]+/", '', $str);
			return $str;
		}
		return null;
	}

	private function set_post($str, $key) {
		$this->REQUEST_POST[$key] = $str;
	}

	private function set_get($str, $key) {
		$this->REQUEST_GET[$key] = $str;
	}

	private function outputAtribute($a)
	{
		return $this->$a;
	}

	public function __call($method, $arg)
	{
		$attribute = '';
		switch ($method) {
			case '__POST':
				$attribute = 'REQUEST_POST';
				break;
			case '__GET':
				$attribute = 'REQUEST_GET';
				break;
		}

		$out = $this->outputAtribute( $attribute );
		if (isset($out[$arg[0]])) {
			$data = $this->cleanSpace($out[$arg[0]]);
			if ( isset( $data ) && !empty($data) ) {
				return $out[$arg[0]];
			}
		}else if (isset($_GET[$arg[0]])) {
			$data = $this->cleanSpace($_GET[$arg[0]]);
			if ( isset( $data ) && !empty($data) ) {
				return $_GET[$arg[0]];
			}
		}
		return false;
	}
}