<?php

namespace Turkishliras;

class NumberToTextLira
{

    protected float $amount;
    protected string $text;

    public function __construct(float $amount)
    {
        $this->amount = $amount;
        $this->text = $this->convertAmountToText($this->amount, 'tr');
    }
    function convertAmountToText($sayi, $separator)
    {
        $sayarr = explode($separator, $sayi);

        $str = "";
        $items = array(
            array("", ""),
            array("BIR", "ON"),
            array("IKI", "YIRMI"),
            array("UC", "OTUZ"),
            array("DORT", "KIRK"),
            array("BES", "ELLI"),
            array("ALTI", "ALTMIS"),
            array("YEDI", "YETMIS"),
            array("SEKIZ", "SEKSEN"),
            array("DOKUZ", "DOKSAN")
        );

        for ($eleman = 0; $eleman < count($sayarr); $eleman++) {

            for ($basamak = 1; $basamak <= strlen($sayarr[$eleman]); $basamak++) {
                $basamakd = 1 + (strlen($sayarr[$eleman]) - $basamak);


                switch ($basamakd) {
                    case 6:
                        $str = $str . " " . $items[substr($sayarr[$eleman], $basamak - 1, 1)][0] . " YUZ";
                        break;
                    case 5:
                        $str = $str . " " . $items[substr($sayarr[$eleman], $basamak - 1, 1)][1];
                        break;
                    case 4:
                        if ($items[substr($sayarr[$eleman], $basamak - 1, 1)][0] != "BIR") $str = $str . " " . $items[substr($sayarr[$eleman], $basamak - 1, 1)][0] . " BIN";
                        else $str = $str . " BIN";
                        break;
                    case 3:
                        if ($items[substr($sayarr[$eleman], $basamak - 1, 1)][0] == "") {
                            $str .= " ";
                        } elseif ($items[substr($sayarr[$eleman], $basamak - 1, 1)][0] != "BIR") $str = $str . " " . $items[substr($sayarr[$eleman], $basamak - 1, 1)][0] . " YUZ";

                        else $str = $str . " YUZ";
                        break;
                    case 2:
                        $str = $str . " " . $items[substr($sayarr[$eleman], $basamak - 1, 1)][1];
                        break;
                    default:
                        $str =  $str . " " . $items[substr($sayarr[$eleman], $basamak - 1, 1)][0];
                        break;
                }
            }
            if ($eleman < 1) $str = $str . "Türk Lirasi";
            else {
                if ($sayarr[1] != "00") $str = $str . " KRS";
            }
        }
        return $str;
    }

    public function getText()
    {
        return trim($this->text);
    }
}
