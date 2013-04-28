<?php
if(!defined('INIT_SENSITIVE')) { exit; }

class Parser extends AbstractBase {
    public static function xml2Array($xml,$simple = false) {
        if(!is_string($xml)) {
            return false;
        }
        if($simple) {
            $xml = @simplexml_load_string($xml);
        } else {
            $xml = @json_decode(json_encode((array) simplexml_load_string($xml)),1);
        }
        return $xml;
    }
    public static function array2XML($value, $root='root', $encoding='utf-8') {
        if( !is_array($value) && !is_string($value) && !is_bool($value) && !is_numeric($value) && !is_object($value) ) {
            return false;
        }
        return simplexml_load_string('<?xml version="1.0" encoding="'.$encoding.'"?>'.self::x2str($value,$root))->asXml();
    }
    private static function x2str($xml,$key) {
        if (!is_array($xml) && !is_object($xml)) {
            return "<$key>".htmlspecialchars($xml)."</$key>";      
        }
        $xml_str='';
        foreach ($xml as $k=>$v) {   
            if(is_numeric($k)) {
                $k = '_'.$k;
            }
            $xml_str.=self::x2str($v,$k);       
        }    
        return "<$key>$xml_str</$key>"; 
    }
}
?>
