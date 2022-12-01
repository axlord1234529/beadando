<?php
class Arfolyamok_model
{
    private SoapClient $_client;
    private const WSDL = 'http://www.mnb.hu/arfolyamok.asmx?wsdl';
    public function __construct()
    {
        $this->_client = new SoapClient(self::WSDL);
    }


    public function get_data($vars): array
    {
        $retData = array();
        $retData['currencies'] = $this->get_currencies();

        if (isset($vars['currency1']) && isset($vars['currency2']) && isset($vars['startDate']) && isset($vars['endDate']) && !empty($vars['startDate']) && !empty($vars['endDate'])) {
            $retData['selectedCurrency1'] = $vars['currency1'];
            $retData['selectedCurrency2'] = $vars['currency2'];
            $retData['currency2'] = $vars['currency2'];
            $rates = $this->get_exchange_rate($vars['startDate'], $vars['endDate'], $vars['currency1'], $vars['currency2']);
            if (is_array($rates)) {
                $retData['rates'] = $this->get_exchange_rate($vars['startDate'], $vars['endDate'], $vars['currency1'], $vars['currency2']);
            } else {
                $retData['errors'][0] = $rates;
            }
        }elseif (isset($vars['currency1']) && isset($vars['currency2']))
        {
            $retData['errors'][0] = "Nem adott meg idő intervalumot.";
        }

        return $retData;

    }

    private function get_exchange_rate(string $startDate, string $endDate, string $currency1, string $currency2): array|string
    {
        $formattedStartDate = date('y-m-d', strtotime($startDate));
        $formattedEndDate = date('y-m-d', strtotime($endDate));
        $xml = $this->_client->GetExchangeRates(array('startDate' => $formattedStartDate, 'endDate' => $formattedEndDate, 'currencyNames' => $currency1 . "," . $currency2))->GetExchangeRatesResult;
        $parser = xml_parser_create();
        xml_parse_into_struct($parser, $xml, $values);

        $i = 0;
        array_shift($values);

        if (count($values) && $values[$i]['tag'] == 'DAY') {
            $rates = array();

            while ($values[$i]['tag'] != 'MNBEXCHANGERATES' && $values[$i]['type'] != 'close') {
                $j = $i + 1;
                $date = $values[$i]['attributes']['DATE'];
                if(!isset($values[$j]['attributes']['CURR'])) return "Nincs adat";
                do {
                    if ($values[$j]['attributes']['CURR'] == $currency1) {
                        $rates[$date][$currency1]['unit'] = $values[$j]['attributes']['UNIT'];
                        $rates[$date][$currency1]['value'] = $values[$j]['value'];
                    } elseif ($values[$j]['attributes']['CURR'] == $currency2) {
                        $rates[$date][$currency2]['unit'] = $values[$j]['attributes']['UNIT'];
                        $rates[$date][$currency2]['value'] = $values[$j]['value'];
                    }

                    $j++;
                } while ($values[$j]['tag'] != 'DAY' && $values[$j]['type'] != 'close');
                $i = ++$j;
            }

            return $rates;
        } else if ($startDate == $endDate) {
            return "Nincs adat. A választott nap hétvégére esik vagy ünnepnapp. Az árfolyamok megállapítására 11 órakor kerül.";
        } else {
            return "Hiba történt!";
        }
    }

    private function get_currencies(): array
    {
        $xml = $this->_client->GetCurrencies(null)->GetCurrenciesResult;

        $parser = xml_parser_create();

        xml_parse_into_struct($parser, $xml, $values);

        $currencies = array();
        foreach ($values as $currency) {
            if ($currency['tag'] == 'CURR') {
                $currencies[] = $currency['value'];
            }
        }

        return $currencies;
    }
}