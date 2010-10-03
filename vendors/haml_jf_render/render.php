<?php
  define(HAML_COMPILED_TEMPLATES_PATH, TEMP_PATH.'haml_compiled_files');
  // ОТРИСОВАТЬ МАКЕТ
  function haml_layout($file, &$controller){
    // Регистрация переменных
    $framework = &$controller->framework;
    $data = &$controller->data;
    $layout = &$controller;
    $fragment = &$controller->fragment;
    // Инициализация парсера
    $parser = new HamlParser(LAYOUT_PATH, HAML_COMPILED_TEMPLATES_PATH);
    //$parser->setSource(file_get_contents($this->sFile));
    $parser->setSource(file_get_contents(LAYOUT_PATH."$file.haml"));
    echo $parser->render();
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