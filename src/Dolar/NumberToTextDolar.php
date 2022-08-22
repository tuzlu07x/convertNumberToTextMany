<?php

namespace Dolar;

class NumberToTextDolar
{

    protected float $amount;
    protected string $text;

    public function __construct(float $amount)
    {
        $this->amount = $amount;
        $this->text = $this->convertAmountToText($this->amount, '$');
    }
    function convertAmountToText($number, $separator)
    {
        $counter = explode($separator, $number);

        $str = "";
        $items = array(
            array("", ""),
            array("ONE", "TEN"),
            array("TWO", "TWENTY"),
            array("THREE", "THIRTY"),
            array("FOUR", "FORTY"),
            array("FIVE", "FIFTY"),
            array("SIX", "SIXTY"),
            array("SEVEN", "SEVENTY"),
            array("EIGHT", "EIGHTY"),
            array("NINE", "NINETY")
        );

        for ($factor = 0; $factor < count($counter); $factor++) {

            for ($step = 1; $step <= strlen($counter[$factor]); $step++) {
                $stepd = 1 + (strlen($counter[$factor]) - $step);


                switch ($stepd) {
                    case 6:
                        $str = $str . " " . $items[substr($counter[$factor], $step - 1, 1)][0] . " ONE HUNDRED";
                        break;
                    case 5:
                        $str = $str . " " . $items[substr($counter[$factor], $step - 1, 1)][1];
                        break;
                    case 4:
                        if ($items[substr($counter[$factor], $step - 1, 1)][0] != "BIR") $str = $str . " " . $items[substr($counter[$factor], $step - 1, 1)][0] . " THOUSAND";
                        else $str = $str . " THOUSAND";
                        break;
                    case 3:
                        if ($items[substr($counter[$factor], $step - 1, 1)][0] == "") {
                            $str .= " ";
                        } elseif ($items[substr($counter[$factor], $step - 1, 1)][0] != "BIR") $str = $str . " " . $items[substr($counter[$factor], $step - 1, 1)][0] . " ONE HUNDRED";

                        else $str = $str . " ONE HUNDRED";
                        break;
                    case 2:
                        $str = $str . " " . $items[substr($counter[$factor], $step - 1, 1)][1];
                        break;
                    default:
                        $str =  $str . " " . $items[substr($counter[$factor], $step - 1, 1)][0];
                        break;
                }
            }
            if ($factor < 1) $str = $str . "Dollars";
            else {
                if ($counter[1] != "00") $str = $str . " Cent";
            }
        }
        return $str;
    }

    public function getText()
    {
        return trim($this->text);
    }
}
