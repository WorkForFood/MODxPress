<?php
class Render {
    public $lang;
    public $style;
    public $ph;
    public $output;
    public $templatesDir;
    private $fileRegister;
    public $debug;

    public function __construct () {
        $this->debug = false;
    }

    function getFileContents($file) {
        if (empty($file)) {
            return false;
        } else {
            if(array_key_exists($file, $this->fileRegister)) {
                return $this->fileRegister[$file];
            } else {
                $filename = $this->templatesDir.'/'.$file.'.tpl';
                $contents = file_get_contents($filename);
                $this->fileRegister[$file] = $contents;
                return $contents;
            }
        }
    }

    function parseString($tpl, $values) {
        foreach ($values as $key => $value) {
            $tpl = str_replace('[+'.$key.'+]', $value, $tpl); 
        }
        $tpl = preg_replace('/(\[\+.*?\+\])/' ,'', $tpl);
        return $tpl;
    }

    function parseTemplate($tpl = false, $values = array()) {
        if(!$tpl) { return ''; }
        $tpl = $this->getFileContents($tpl);
        if($tpl) {
            return $this->parseString($tpl, $values);
        } else {
            return '';
        }
    }

    function translateString($string) {
        $toreplace  = array("Ä","ä","Æ","æ","Ǽ","ǽ","Å","å","Ǻ","ǻ","À","Á","Â","Ã","à","á","â","ã","Ā","ā","Ă","ă","Ą","ą","Ǎ","ǎ","Ạ","Ạ","ạ","Ả","ả","Ấ","ấ","Ầ","ầ","Ẩ","ẩ","Ẫ","ẫ","Ậ","ậ","Ắ","ắ","Ằ","ằ","Ẳ","ẳ","Ẵ","ẵ","Ặ","ặ","Ç","ç","Ć","ć","Ĉ","ĉ","Ċ","ċ","Č","č","Ð","ð","Ď","ď","Đ","đ","È","É","Ê","Ë","è","é","ê","ë","Ē","ē","Ĕ","ĕ","Ė","ė","Ę","ę","Ě","ě","Ẹ","ẹ","Ẻ","ẻ","Ẽ","Ế","ế","Ề","ề","Ể","ể","ễ","Ệ","ệ","Ə","ə","ſ","ſ","Ĝ","ĝ","Ğ","ğ","Ġ","ġ","Ģ","ģ","Ĥ","ĥ","Ħ","ħ","Ì","Í","Î","Ï","ì","í","î","ï","Ĩ","ĩ","Ī","ī","Ĭ","ĭ","Į","į","İ","ı","Ǐ","ǐ","Ỉ","ỉ","Ị","ị","Ĳ","ĳ","ﬁ","ﬂ","Ĵ","ĵ","Ķ","ķ","ĸ","Ĺ","ĺ","Ļ","ļ","Ľ","ľ","Ŀ","ŀ","Ł","ł","Ñ","ñ","Ń","ń","Ņ","Ň","ň","ŉ","Ŋ","ŋ","Ö","ö","Ø","ø","Ǿ","ǿ","Ò","Ó","Ô","Õ","ò","ó","ô","õ","Ō","ō","Ŏ","ŏ","Ő","ő","Ǒ","ǒ","Ọ","ọ","Ỏ","ỏ","Ố","ố","Ồ","ồ","Ổ","ổ","Ỗ","ỗ","Ộ","ộ","Ớ","ớ","Ờ","ờ","Ở","ở","Ỡ","ỡ","Ợ","ợ","Ơ","ơ","Œ","œ","Ŕ","ŕ","Ŗ","ŗ","Ř","ř","Ś","ś","Ŝ","Ş","ş","Š","š","Ţ","ţ","Ť","ť","Ŧ","ŧ","Ü","ü","Ù","Ú","Û","ù","ú","û","Ụ","ụ","Ủ","ủ","Ứ","ứ","Ừ","ừ","Ữ","ữ","Ự","ự","Ũ","ũ","Ū","ū","Ŭ","ŭ","Ů","ů","Ű","ű","Ų","ų","Ǔ","ǔ","ǖ","ǘ","Ǚ","ǚ","Ǜ","ǜ","Ư","ư","Ŵ","ŵ","Ẁ","ẁ","Ẃ","ẃ","Ẅ","ẅ","Ý","ý","ÿ","Ŷ","ŷ","Ÿ","Ỳ","ỳ","Ỵ","ỵ","Ỷ","ỷ","Ỹ","ỹ","Þ","þ","ß","Ź","ź","Ż","ż","Ž","ž","А", "Б", "В", "Г", "Д", "Е", "Ё", "Ж", "З", "И", "Й", "К", "Л", "М", "Н", "О", "П", "Р", "С","Т", "У", "Ф", "Х", "Ц", "Ч", "Ш", "Щ", "Ъ", "Ы", "Ь", "Э", "Ю", "Я","а", "б", "в", "г", "д", "е", "ё", "ж", "з", "и", "й", "к", "л", "м", "н", "о", "п", "р", "с","т", "у", "ф", "х", "ц", "ч", "ш", "щ", "ъ", "ы", "ь", "э", "ю", "я"," ",'"',"'","/",);
        $replacement = array("ae","ae","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","c","c","c","c","c","c","c","c","c","c","d","d","d","d","d","d","e","e","e","e","e","e","e","e","e","e","e","e","e","e","e","e","e","e","e","e","e","e","e","e","e","e","e","e","e","e","e","e","e","e","f","f","g","g","g","g","g","g","g","g","h","h","h","h","i","i","i","i","i","i","i","i","i","i","i","i","i","i","i","i","i","i","i","i","i","i","i","i","ij","ij","fi","fl","j","j","k","k","k","l","l","l","l","l","l","l","l","l","l","n","n","n","n","n","n","n","n","n","n","oe","oe","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","oe","oe","r","r","r","r","r","r","s","s","s","s","s","s","s","t","t","t","t","t","t","ue","ue","u","u","u","u","u","u","u","u","u","u","u","u","u","u","u","u","u","u","u","u","u","u","u","u","u","u","u","u","u","u","u","u","u","u","u","u","u","u","u","u","w","w","w","w","w","w","w","w","y","y","y","y","y","y","y","y","y","y","y","y","y","y","th","th","ss","z","z","z","z","z","z","a", "b", "v", "g", "d", "e", "e", "zh", "z", "i", "j", "k", "l", "m", "n", "o", "p", "r", "s","t", "u", "f", "h", "ts", "ch", "sh", "sch", "", "y", "", "e", "yu", "ya","a", "b", "v", "g", "d", "e", "e", "zh", "z", "i", "j", "k", "l", "m", "n", "o", "p", "r", "s","t", "u", "f", "h", "ts", "ch","sh", "sch", "", "y", "", "e", "yu", "ya","_","","","");
        $string = str_replace($toreplace, $replacement, strtolower($string));
        return $string;
    }

    function setPlaceholder ($phname = null,$phvalue = null) {
        if(!empty($phname) && !empty($phvalue)) {
            $this->ph[$phname] = $phvalue;
            return $this->getPlaceholder($phname);
        } else {
            return false;
        }
    }

    function setPlaceholders ($phs = array(), $phprefix = '', $phsuffix = '') {
        if(sizeof($phs) == 0) { return; }
        foreach ($phs as $key => $value) {
             $this->ph[$phprefix.$key.$phsuffix] = $value;
        }
    }

    function getPlaceholder ($phname = null) {
        if(!empty($phname)) {
            $value = !empty($this->ph[$phname]) ? $this->ph[$phname] : false;
            return $value;
        } else {
            return null;
        }
    }

    function render ($tpl = false,$ph = false,$lang = false,$style = false) {
        if(!$tpl) { return ''; }
        if(!$ph) { $ph = $this->ph; }
        if(!$lang) { $lang = $this->lang; }
        if(!$style) { $style = $this->style; }
        $paceholders = array_merge($ph,$lang,$style);
        $output = $this->parseTemplate($tpl,$paceholders);
        if($this->debug) {
            print_r($ph);
        }
        $this->debug = false;
        return $output;
    }
}   
?>
