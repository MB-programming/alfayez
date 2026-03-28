<?php namespace App\Libraries {
    class LangFile {
        public static function updateFile($file,$key,$oldValue,$newValue) {
        	$path = base_path().'/resources/lang/'.$file;
			$f = new \Illuminate\Filesystem\Filesystem;
			$handle = fopen($path, "r");
			$content = $f->get($path);
			$content  = trim($content);
			$content = str_replace("'$key' => '$oldValue'", "'$key' => '$newValue'", $content);
			$f->put($path ,$content);
        }
    }
}
?>