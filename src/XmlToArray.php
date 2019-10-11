<?php
/**
 * XmlToArray | src/XmlToArray.php.
 *
 * @author      Björn Visser
 *
 * @since       v0.1
 */

namespace Omnipay\iDeal;

class XmlToArray
{
    public static function convert($xml)
    {
        $xml = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
        $json = json_encode($xml);
        $data = json_decode($json, true);

        return $data;
    }
}
