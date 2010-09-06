<?php
/* SVN FILE: $Id$ */

/**
 * Washes strings from unwanted noise.
 *
 * Helpful methods to make unsafe strings usable.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs
 * @since         CakePHP(tm) v 0.10.0.1076
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

class Sanitize {

	function paranoid($string, $allowed = array()) {
		$allow = null;
		if (!empty($allowed)) {
			foreach ($allowed as $value) {
				$allow .= "\\$value";
			}
		}

		if (is_array($string)) {
			$cleaned = array();
			foreach ($string as $key => $clean) {
				$cleaned[$key] = preg_replace("/[^{$allow}a-zA-Z0-9]/", '', $clean);
			}
		} else {
			$cleaned = preg_replace("/[^{$allow}a-zA-Z0-9]/", '', $string);
		}
		return $cleaned;
	}

	function escape($string, $connection = 'default') {
		$db =& ConnectionManager::getDataSource($connection);
		if (is_numeric($string) || $string === null || is_bool($string)) {
			return $string;
		}
		$string = substr($db->value($string), 1);
		$string = substr($string, 0, -1);
		return $string;
	}

	function html($string, $remove = false) {
		if ($remove) {
			$string = strip_tags($string);
		} else {
			$patterns = array("/\&/", "/%/", "/</", "/>/", '/"/', "/'/", "/\(/", "/\)/", "/\+/", "/-/");
			$replacements = array("&amp;", "&#37;", "&lt;", "&gt;", "&quot;", "&#39;", "&#40;", "&#41;", "&#43;", "&#45;");
			$string = preg_replace($patterns, $replacements, $string);
		}
		return $string;
	}

	function stripWhitespace($str) {
		$r = preg_replace('/[\n\r\t]+/', '', $str);
		return preg_replace('/\s{2,}/', ' ', $r);
	}

	function stripImages($str) {
		$str = preg_replace('/(<a[^>]*>)(<img[^>]+alt=")([^"]*)("[^>]*>)(<\/a>)/i', '$1$3$5<br />', $str);
		$str = preg_replace('/(<img[^>]+alt=")([^"]*)("[^>]*>)/i', '$2<br />', $str);
		$str = preg_replace('/<img[^>]*>/i', '', $str);
		return $str;
	}

	function stripScripts($str) {
		return preg_replace('/(<link[^>]+rel="[^"]*stylesheet"[^>]*>|<img[^>]*>|style="[^"]*")|<script[^>]*>.*?<\/script>|<style[^>]*>.*?<\/style>|<!--.*?-->/i', '', $str);
	}

	function stripAll($str) {
		$str = Sanitize::stripWhitespace($str);
		$str = Sanitize::stripImages($str);
		$str = Sanitize::stripScripts($str);
		return $str;
	}

	function stripTags() {
		$params = params(func_get_args());
		$str = $params[0];

		for ($i = 1; $i < count($params); $i++) {
			$str = preg_replace('/<' . $params[$i] . '\b[^>]*>/i', '', $str);
			$str = preg_replace('/<\/' . $params[$i] . '[^>]*>/i', '', $str);
		}
		return $str;
	}

	function clean($data, $options = array()) {
		if (empty($data)) {
			return $data;
		}

		if (is_string($options)) {
			$options = array('connection' => $options);
		} else if (!is_array($options)) {
			$options = array();
		}

		$options = array_merge(array(
			'connection' => 'default',
			'odd_spaces' => true,
			'encode' => true,
			'dollar' => true,
			'carriage' => true,
			'unicode' => true,
			'escape' => true,
			'backslash' => true
		), $options);

		if (is_array($data)) {
			foreach ($data as $key => $val) {
				$data[$key] = Sanitize::clean($val, $options);
			}
			return $data;
		} else {
			if ($options['odd_spaces']) {
				$data = str_replace(chr(0xCA), '', str_replace(' ', ' ', $data));
			}
			if ($options['encode']) {
				$data = Sanitize::html($data);
			}
			if ($options['dollar']) {
				$data = str_replace("\\\$", "$", $data);
			}
			if ($options['carriage']) {
				$data = str_replace("\r", "", $data);
			}

			$data = str_replace("'", "'", str_replace("!", "!", $data));

			if ($options['unicode']) {
				$data = preg_replace("/&amp;#([0-9]+);/s", "&#\\1;", $data);
			}
			if ($options['escape']) {
				$data = Sanitize::escape($data, $options['connection']);
			}
			if ($options['backslash']) {
				$data = preg_replace("/\\\(?!&amp;#|\?#)/", "\\", $data);
			}
			return $data;
		}
	}

	function formatColumns(&$model) {
		foreach ($model->data as $name => $values) {
			if ($name == $model->alias) {
				$curModel =& $model;
			} elseif (isset($model->{$name}) && is_object($model->{$name}) && is_subclass_of($model->{$name}, 'Model')) {
				$curModel =& $model->{$name};
			} else {
				$curModel = null;
			}

			if ($curModel != null) {
				foreach ($values as $column => $data) {
					$colType = $curModel->getColumnType($column);

					if ($colType != null) {
						$db =& ConnectionManager::getDataSource($curModel->useDbConfig);
						$colData = $db->columns[$colType];

						if (isset($colData['limit']) && strlen(strval($data)) > $colData['limit']) {
							$data = substr(strval($data), 0, $colData['limit']);
						}

						if (isset($colData['formatter']) || isset($colData['format'])) {

							switch (strtolower($colData['formatter'])) {
								case 'date':
									$data = date($colData['format'], strtotime($data));
								break;
								case 'sprintf':
									$data = sprintf($colData['format'], $data);
								break;
								case 'intval':
									$data = intval($data);
								break;
								case 'floatval':
									$data = floatval($data);
								break;
							}
						}
						$model->data[$name][$column]=$data;
						/*
						switch ($colType) {
							case 'integer':
							case 'int':
								return  $data;
							break;
							case 'string':
							case 'text':
							case 'binary':
							case 'date':
							case 'time':
							case 'datetime':
							case 'timestamp':
							case 'date':
								return "'" . $data . "'";
							break;
						}
						*/
					}
				}
			}
		}
	}
}
?>