<?php
use Carbon\Carbon;

if (!function_exists('fullDate')) {

    function fullDate($date, $format = 'F d, Y')
    {
        return Carbon::parse($date)->format($format);
    }
}

if (!function_exists('moneyFormat')) {
    function moneyFormat($amount)
    {
        if ($amount) {
            return '0.00';
        }
        return number_format($amount, 2, '.', ',');
    }
}

if (!function_exists('generateFullName')) {
    function generateFullName($last_name, $first_name, $middle_name)
    {
        $mid_name = '';
        if ($middle_name) {
            $middle_name = explode(' ', $middle_name);

            foreach ($middle_name as $middle) {
                $mid_name .= $middle[0];
            }
            $middle_name = ($mid_name != '') ? $mid_name . '.' : '';
        }

        $full_name = $last_name . ', ' . $first_name . ' ' . $middle_name;
        return ucwords($full_name);
    }
}

if (!function_exists('getInitialName')) {
    function getNameInitial($name)
    {
        $name_initial = '';
        $name_explode = explode(' ', $name);

        if (is_array($name_explode)) {
            foreach ($name_explode as $value) {
                $name_initial .= $value[0];
            }
        }

        return ucwords($name_initial);
    }
}

if (!function_exists('monthList')) {
    function monthList()
    {
        $month_list = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December',
        ];
        return $month_list;
    }
}

if (!function_exists('yearList')) {
    function yearList($start_year = 2014)
    {
        $year_list = [];
        for ($i = $start_year; $i <= Carbon::now()->year; $i++) {
            $year_list[] = $i;
        }
        return $year_list;
    }
}

if (!function_exists('userName')) {
    function userName($user_id)
    {
        $user = App\User::find(1);
        return ($user) ? $user->name : '';
    }
}

if (!function_exists('invalidRequestArray')) {
    function invalidRequestArray()
    {
        return [
            'message' => 'Invalid request.',
            'error' => true
        ];
    }
}