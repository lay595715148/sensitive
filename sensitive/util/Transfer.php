<?php
if(!defined('INIT_SENSITIVE')) { exit; }

/**
 * 
 */
class Transfer extends AbstractBase {
    /**
     * xml format string to php array
     * 
     * @param string $xml xml format string or xml file path string
     * @return array
     */
    public static function xml2PHPArray($xml,$type = 1) {
        if($type) {
            $xmlstr = simplexml_load_file($xml);
        } else {
            $xmlstr = simplexml_load_string($xml);
        }
        $json = json_encode($xmlstr);
        return json_decode($json, true);

        //serialize simplexml bug
        if($type) {
            $xmlstr = simplexml_load_file($xml);
        } else {
            $xmlstr = simplexml_load_string($xml);
        }
        $arr = array();
        $str = serialize($xmlstr);//serialize()  产生一个可存储的值的表示 
        $str = str_replace('O:16:"SimpleXMLElement"', 'a', $str);
        $arr = unserialize($str); //unserialize()  从已存储的表示中创建 PHP 的值
        return $arr;

        //bug
        $xmlary  = array();
        $reels   = '/<(\w+)\s*([^\/>]*)\s*(?:\/>|>(.*)<\/\s*\\1\s*>)/s';
        $reattrs = '/(\w+)=(?:"|\')([^"\']*)(:?"|\')/';

        preg_match_all($reels, $xml, $elements);print_r($elements);

        foreach ($elements[1] as $ie => $xx) {
            $xmlary[$ie]["name"] = $elements[1][$ie];
            if ($attributes = trim($elements[2][$ie])) {
                preg_match_all($reattrs, $attributes, $att);
                foreach ($att[1] as $ia => $xx) {
                    $xmlary[$ie]["attributes"][$att[1][$ia]] = $att[2][$ia];
                }
            }
            $cdend = strpos($elements[3][$ie], "<");
            if ($cdend > 0) {
                $xmlary[$ie]["text"] = substr($elements[3][$ie], 0, $cdend - 1);
            }
            if (preg_match($reels, $elements[3][$ie])) {
                $xmlary[$ie]["elements"] = self::xml2PHPArray($elements[3][$ie]);
            } else if ($elements[3][$ie]) {
                $xmlary[$ie]["text"] = $elements[3][$ie];
            }
        }

        return $xmlary;
    }
    /**
     * php array to json content
     * 
     * @return json content
     */
    public static function array2JsonContent($arr) {
        return json_encode($arr);
    }
    /**
     * php array to php content
     * 
     * @return php content
     */
    public static function array2PHPContent($arr,$encrypt = true) {
		global $_CFG;
		if($_CFG['cache']['cache-encrypt'] && $encrypt) {
            $r = '';
            $r .= self::Array2String($arr);
		} else {
			$r = '<?php return ';
			self::a2s($r,$arr);
			$r .= ';?>';
		}
        return $r;
    }
    /*在Array和String类型之间转换，转换为字符串的数组可以直接在URL上传递*/
    // convert a multidimensional array to url save and encoded string
    // usage: string Array2String( array Array )
    public static function Array2String($Array) {
        $Return='';
        $NullValue="^^^";
        foreach ($Array as $Key => $Value) {
            if(is_array($Value))
                $ReturnValue='^^array^'.self::Array2String($Value);
            else
                $ReturnValue=(strlen($Value)>0)?$Value:$NullValue;
            $Return.=urlencode(base64_encode($Key)) . '|' . urlencode(base64_encode($ReturnValue)).'||';
        }
        return urlencode(substr($Return,0,-2));
    }
    // convert a string generated with Array2String() back to the original (multidimensional) array
    // usage: array String2Array ( string String)
    public static function String2Array($String) {
        $Return=array();
        $String=urldecode($String);
        $TempArray=explode('||',$String);
        $NullValue=urlencode(base64_encode("^^^"));
        foreach ($TempArray as $TempValue) {
            list($Key,$Value)=explode('|',$TempValue);
            $DecodedKey=base64_decode(urldecode($Key));
            if($Value!=$NullValue) {
                $ReturnValue=base64_decode(urldecode($Value));
                if(substr($ReturnValue,0,8)=='^^array^')
                    $ReturnValue=self::String2Array(substr($ReturnValue,8));
                $Return[$DecodedKey]=$ReturnValue;
            }
            else
            $Return[$DecodedKey]=NULL;
        }
        return $Return;
    }
    /**
     * array $a to string $r
     * 
     * @return void
     */
    private static function a2s(&$r,array &$a) {
        $f = false;
        $i=0;
        $r.= 'array('."\n";
        foreach ($a as $k=>$v) {
            if($f)
            $r.=',';
            $j = is_numeric($k);
            self::o2s($r,$k,$v,$i,$j);
            $f=true;
            if($j && $k>=$i)
                $i=$k+1;
        }
        $r.=')'."\n";
    }
    private static function o2s(&$r,$k,$v,$i,$j) {
        if($k!==$i) {
            if($j)
                $r.="$k=>";
            else
                $r.="'$k'=>";
        }
        if(is_array($v))
            self::a2s($r,$v);
        else if(is_numeric($v))
            $r.=$v;
        else
            $r.="'".str_replace(array("\\","'"),array("\\\\","\'"),$v)."'";
    }
}
?>
