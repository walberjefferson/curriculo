<?php

if (!function_exists('active_class')) {
    function active_class($path, $active = 'active')
    {
        return (Request::routeIs($path) || Request::is($path)) ? $active : '';
//        return call_user_func_array('Request::routeIs', (array)$path) ? $active : '';
    }
}

if (!function_exists('is_active_route')) {
    function is_active_route($path)
    {
        return (Request::routeIs($path) || Request::is($path)) ? 'true' : 'false';
//        return call_user_func_array('Request::routeIs', (array)$path) ? 'true' : 'false';
    }
}
if (!function_exists('show_class')) {
    function show_class($path)
    {
        return (Request::routeIs($path) || Request::is($path)) ? 'show' : '';
//        return call_user_func_array('Request::routeIs', (array)$path) ? 'show' : '';
    }
}

if (!function_exists('str_numbers')) {
    function str_numbers($value)
    {
        return preg_replace("/[^0-9]/", "", $value);
    }
}


if (!function_exists('isActiveRoute')) {
    function isActiveRoute($route, $output = 'active')
    {
        if (Route::currentRouteName() == $route) {
            return $output;
        }
    }
}

if (!function_exists('mask_cpf_or_cnpj')) {
    function mask_cpf_or_cnpj($value)
    {
        $value = str_numbers($value);
        if (strlen($value) == 11) {
            return the_mask($value, "###.###.###-##");
        } else {
            return the_mask($value, "##.###.###/####-##");
        }
    }
}


if (!function_exists('the_mask')) {
    function the_mask($value, $mask)
    {
        $maskared = '';
        $k = 0;
        for ($i = 0; $i <= strlen($mask) - 1; $i++) {
            if ($mask[$i] == '#' || $mask[$i] == '*') {
                if (isset($value[$k])) {
                    $maskared .= $value[$k++];
                }
            } else {
                if (isset($mask[$i])) {
                    $maskared .= $mask[$i];
                }
            }
        }
        return $maskared;
    }
}

if (!function_exists('moeda_real')) {
    function moeda_real($valor, $simbolo = null)
    {
        $valor = number_format($valor, 2, ',', '.');
        if (is_null($simbolo)) {
            return "R$ {$valor}";
        }
        return "$simbolo $valor";
    }
}

if (!function_exists('data_brasil_americana')) {
    function data_brasil_americana($data)
    {
        $dt = explode('/', $data);
        if (count($dt) > 1) {
            $data = "{$dt[2]}-{$dt[1]}-{$dt[0]}";
            return \Carbon\Carbon::createFromFormat('Y-m-d', $data)->format('Y-m-d');
        }
        return $data;
    }
}

if (!function_exists('data_brasil')) {
    function data_brasil($data)
    {
        if (!empty($data)) {
            $dt = \Carbon\Carbon::createFromDate($data);
            return $dt->format('d/m/Y');
        }
        return $data;
    }
}

if (!function_exists('hora_brasil_processo')) {
    function hora_brasil_processo($datahora)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $datahora)->format('H:i:s');
    }
}

if (!function_exists('data_brasil_americana_hora')) {
    function data_brasil_americana_hora($data)
    {
        $dt = explode(' ', $data);
        $dt1 = explode('/', $dt[0]);
        if (count($dt1) > 1) {
            $data = "{$dt1[2]}-{$dt1[1]}-{$dt1[0]}" . " " . $dt[1];
            return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data);
        }
        return $data;
    }
}

if (!function_exists('data_brasil_hora')) {
    function data_brasil_hora($data)
    {
        if (!empty($data)) {
            $dt = \Carbon\Carbon::createFromDate($data);
            return $dt->format('d/m/Y H:i:s');
        }
        return $data;
    }
}

if (!function_exists('is_aniversariante_mes')) {
    function is_aniversariante_mes($data)
    {
        if (!empty($data)) {
            $dt = \Carbon\Carbon::createFromDate($data);
            return $dt->format('m') == date('m');
        }
        return false;
    }
}

if (!function_exists('lista_meses')) {
    function lista_meses($mes = null)
    {
        $meses = collect([
            1 => 'Janeiro',
            2 => 'Fevereiro',
            3 => 'Março',
            4 => 'Abril',
            5 => 'Maio',
            6 => 'Junho',
            7 => 'Julho',
            8 => 'Agosto',
            9 => 'Setembro',
            10 => 'Outubro',
            11 => 'Novembro',
            12 => 'Dezembro'
        ]);
        if ($mes) {
            $mes = (int)$mes;
            return $meses[$mes];
        }
        return $meses;
    }
}

if (!function_exists('lista_anos')) {
    function lista_anos($quant = null)
    {
        if ($quant == null) {
            $quant = 1;
        }

        $anos_array = [];
        for ($i = 0; $i < $quant; $i++) {
            $ano = date('Y') - $i;
            $anos_array[$ano] = $ano;
        }
        $anos = collect($anos_array);

        return $anos;
    }
}

if (!function_exists('mascara_protocolo')) {

    function mascara_protocolo($protocolo)
    {
        if ($protocolo) {
            $posicao = (int)strlen($protocolo) / 2;
            return substr_replace($protocolo, '.', $posicao, 0);
        }
        return null;
    }
}

if (!function_exists('fpdf_utf8')) {
    function fpdf_utf8($value)
    {
        return iconv(mb_detect_encoding($value), 'windows-1252//IGNORE', $value);
    }
}

if (!function_exists('fpdf_utf8_uppercase')) {
    function fpdf_utf8_uppercase($value)
    {
        return iconv(mb_detect_encoding($value), 'windows-1252//IGNORE', mb_strtoupper($value));
    }
}

if (!function_exists('moeda_brasil_americana')) {
    function moeda_brasil_americana($value)
    {
        return str_replace(',', '.', str_replace('.', '', $value));
    }
}
if (!function_exists('insertInPosition')) {
    function insertInPosition($str, $pos = '4', $c = '.')
    {
        return substr_replace($str, $c, $pos, 0);
        //        return substr($str, 0, $pos) . $c . substr($str, $pos);
    }
}

if (!function_exists('format_numer_kg')) {
    function format_numer_kg($str, $total = 0, $c = '.', $k = '.')
    {
        if ($str) {
            return number_format($str, $total, $c, $k);
        }
        return $str;
    }
}

if (!function_exists('lista_meses_abreviado')) {
    function lista_meses_abreviado($mes = null)
    {
        $meses = [
            1 => 'Jan',
            2 => 'Fev',
            3 => 'Mar',
            4 => 'Abr',
            5 => 'Mai',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Ago',
            9 => 'Set',
            10 => 'Out',
            11 => 'Nov',
            12 => 'Dez'
        ];
        if ($mes) {
            return $meses[$mes];
        }
        return $meses;
    }
}

if (!function_exists('lista_dia_semana_abreviado')) {
    function lista_dia_semana_abreviado($mes = null)
    {
        $meses = [
            1 => 'Seg',
            2 => 'Ter',
            3 => 'Qua',
            4 => 'Qui',
            5 => 'Sex',
            6 => 'Sab',
            7 => 'Dom',
        ];
        if ($mes) {
            return $meses[$mes];
        }
        return $meses;
    }
}

if (!function_exists('format_date_carbon_str')) {
    function format_date_carbon_str($date)
    {
        if ($date) {
            $diaSemana = lista_dia_semana_abreviado($date->format('N'));
            $mesAbr = mb_strtolower(lista_meses_abreviado($date->format('n')));
            return sprintf('%s, %s de %s de %s', $diaSemana, $date->format('j'), $mesAbr, $date->format('Y'));
        }
        return $date;
    }
}

if (!function_exists('check_class_bg')) {
    function check_class_bg($date, $index)
    {
        if ($date->format('N') == 6) {
            return 'bg-warning';
        }

        if ($date->format('N') == 7) {
            return 'bg-danger';
        }

        if ($index % 2 !== 0) {
            return 'bg-muted';
        }

        return null;
    }
}

if (!function_exists('dateParse')) {
    function dateParse($date, $isHour = false, $isNotSecond = false)
    {
        $newDate = date_parse_from_format('d/m/Y', $date);
        if ($newDate['error_count']) {
            $newDate = date_parse_from_format('Y-m-d', $date);
        }
        if ($newDate['error_count']) {
            $newDate = date_parse_from_format('d/m/Y H:i', $date);
        }
        if ($newDate['error_count']) {
            $newDate = date_parse_from_format('Y-m-d H:i', $date);
        }
        if ($newDate['error_count']) {
            $newDate = date_parse_from_format('d/m/Y H:i:s', $date);
        }
        if ($newDate['error_count']) {
            $newDate = date_parse_from_format('Y-m-d H:i:s', $date);
        }

        if (!$newDate['error_count']) {
            $dia = $newDate['day'] < 10 ? '0' . $newDate['day'] : $newDate['day'];
            $mes = $newDate['month'] < 10 ? '0' . $newDate['month'] : $newDate['month'];
            $date = "{$newDate['year']}-{$mes}-{$dia}";

            if ($newDate['hour'] >= 0 && $newDate['minute'] >= 0 && $isHour && $isNotSecond) {
                $h = $newDate['hour'] ? $newDate['hour'] < 10 ? '0' . $newDate['hour'] : $newDate['hour'] : '00';
                $m = $newDate['minute'] ? $newDate['minute'] < 10 ? '0' . $newDate['minute'] : $newDate['minute'] : '00';
                $hour = "{$h}:{$m}";
                return "{$date} {$hour}";
            }
            if ($newDate['hour'] >= 0 && $newDate['minute'] >= 0 && $newDate['second'] >= 0 && $isHour) {
                $h = $newDate['hour'] ? $newDate['hour'] < 10 ? '0' . $newDate['hour'] : $newDate['hour'] : '00';
                $m = $newDate['minute'] ? $newDate['minute'] < 10 ? '0' . $newDate['minute'] : $newDate['minute'] : '00';
                $s = $newDate['second'] ? $newDate['second'] < 10 ? '0' . $newDate['second'] : $newDate['second'] : '00';
                $hour = "{$h}:{$m}:{$s}";
                return "{$date} {$hour}";
            }
            return $date;
        }
        return $date;
    }
}
