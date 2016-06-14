<?php

/**
 * Created by PhpStorm.
 * User: conghoan
 * Date: 06/06/2016
 * Time: 15:57
 */
class Pagination
{
    
    function paging($total_value, $value_number_limit, $url, $page_current)
    {
        $html = '';
        if ($total_value > 0) {
            $value_start = ($page_current - 1) * $value_number_limit;
            $value_end = $page_current * $value_number_limit;
            if ($value_end > $total_value) {
                $value_end = $total_value;
            }
            $number_page = ceil($total_value / $value_number_limit);
            if ($number_page > 1) {
                if ($page_current > 1) {
                    $page = $page_current - 1;
                    $html .= '<div class="inline page-button" style = "width:70px;"><a href = "' . $url . '?page=' . $page . '"><button class = "button">Prev</button></a></div>';
                }
                if ($number_page > 8) {
                    if ($page_current <= 4) {
                        $page_start = 1;
                        $page_finish = $number_page > 5 ? 5 : $number_page;
                    } elseif ($page_current > 4 && $page_current < $number_page - 3) {
                        $page_start = $page_current - 2;
                        $page_finish = $page_current + 2;
                    } else {
                        $page_start = $page_current > 4 ? $number_page - 4 : 1;
                        $page_finish = $number_page;
                    }
                    if ($page_current > 4) {
                        $html .= '<div class="inline page-button"><a href = "' . $url . '?page=1"><button class = "button">1</button></a></div>';
                        $html .= "<b>...</b>";
                    }
                } else {
                    $page_start = 1;
                    $page_finish = $number_page;
                }
                for ($i = $page_start; $i <= $page_finish; $i++) {
                    if ($i == $page_current) {
                        $html .= '<div class="inline page-button"><button class = "button" style = "background-color: red">' . $i . '</button></div>';
                    } else {
                        $html .= '<div class="inline page-button"><a href = "' . $url . '?page=' . $i . '"><button class = "button">' . $i . '</button></a></div>';
                    }
                }
                if ($number_page > 8) {
                    if ($page_current < $number_page - 3) {
                        $html .= "<b>...</b>";
                        $html .= '<div class="inline page-button"><a href = "' . $url . '?page=' . $number_page . '"><button class = "button">' . $number_page . '</button></a></div>';
                    }
                }
                if ($page_current < $number_page) {
                    $page = $page_current + 1;
                    $html .= '<div class = "inline page-button" style = "width:70px;"><a href = "' . $url . '?page=' . $page . '"><button class = "button">Next</button></a></div>';
                }
            }
            return array(
                'start' => $value_start,
                'end' => $value_end,
                'html' => $html
            );
        }
    }
}