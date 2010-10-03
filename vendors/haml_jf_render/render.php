<?php
  // Определить масто расположения скомпилированных файлов
  define(HAML_COMPILED_TEMPLATES_PATH, TEMP_PATH.'haml_compiled_files');
  
  // ОТРИСОВАТЬ МАКЕТ
  function haml_layout($file, &$controller){
    // Регистрация переменных
    $framework = &$controller->framework;
    $data = &$controller->data;
    $layout = &$controller;
    $fragment = &$controller->fragment;
    
    // Инициализация парсера
    // Указываем расположение шаблонов
    // Указываем путь, где будут храниться скомпилированные шаблоны
    $parser = new HamlParser(LAYOUT_PATH, HAML_COMPILED_TEMPLATES_PATH);
    $parser->setSource(file_get_contents(LAYOUT_PATH."$file.haml"));
    $php_code = $parser->get_php_from_haml();
    
    // ВЫПОЛНЕНИЕ ШАБЛОНА
		$code = ' ?>'.$php_code.'<?php ';
		$output = '';
		ob_start();
			eval($code);
			$output = ob_get_contents();
		ob_end_clean();
		echo $output;
  }
  
	/**
	 * Write attributes
	 */
	function hamlWriteAttributes()
	{
		$aAttr = array();
		foreach (func_get_args() as $aArray)
			$aAttr = array_merge($aAttr, $aArray);
		foreach ($aAttr as $sName => $sValue)
			if ($sValue)
				echo " $sName=\"".htmlentities($sValue).'"';
	}
?>