<?php
	// ��������� ������
    // ������ ������ � �����, ������� ���� ���, �������� ���������� ������, �������� �����	
	function template_evalute($file, &$c){
        // ����������� ����������
        $fw = &$c->fw;
        $data = &$c->data;
        $stdout = &$c->stdout;
        $current_user = &$c->current_user;
        // ���������� �������
		$file_text = file_get_contents($file);
		$code = ' ?>'.$file_text.'<?php ';
		$output = '';
		ob_start();
			eval($code);
			$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
    // ���������� ������
	function render($file, &$c){
        $file = $c->fw->view_path."$file.php";
		return template_evalute($file, $c);
	}
    // ���������� �����
    function layout($layout, &$c){
        // ����������� ����������
        $fw = &$c->fw;
        $data = &$c->data;
        $stdout = &$c->stdout;
        $current_user = &$c->current_user;
        // ����������� ������
        require_once(LAYOUT_PATH."/$layout.php");
    }
    function go_to($path){
        header("Location: $path");
        exit;
    }
    function flash(){
        $flash = $_SESSION['flash'];
        if(!isset($flash)) return false;        
        echo "<div class='flash'>";
        if(is_string($flash)){echo $flash;}
        else{
            foreach($flash as $key => $values){
                echo "<h3 class='flash_header'>$key</h3>";
                foreach($values as $index => $msg){
                    echo "<p class='flash_msg'>$msg</p>";
                }
            }
        }
        echo "</div>";
    }
?>