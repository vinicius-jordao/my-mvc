<?php

    class utilities extends model {

        public function pagination($page, $url, $count) {

            $url = HTTP . $url . '?page=';

            $totalPages = ($count >= PAGE_LIMIT ? ceil($count / PAGE_LIMIT) : 1);

            $margin = 2;
            $start = ($totalPages > $margin && $page > $margin ? $page - $margin : 1);
            $end = ($page + $margin < $totalPages ? $page + $margin : $totalPages);

            $html = '';
            $html .= '<ul>';
                $html .= '<li>';
                    $html .= '<a href="' . ($url . ($page - 1)) . '" class="' . ($page == 1 ? 'disabled' : '') . '">';
                        $html .= '<i class="fa-solid fa-chevron-left"></i>';
                    $html .= '</a>';
                $html .= '</li>';
                for($x=$start;$x<=$end;$x++) {
                    $html .= '<li>';
                        $html .= '<a href="' . ($url . $x) . '" class="' . ($page == $x ? 'active' : '') . '">' . $x . '</a>';
                    $html .= '</li>';
                }
                $html .= '<li>';
                    $html .= '<a href="' . ($url . ($page + 1)) . '" class="' . ($page >= $totalPages ? 'disabled' : '') . '">';
                        $html .= '<i class="fa-solid fa-chevron-right"></i>';
                    $html .= '</a>';
                $html .= '</li>';
            $html .= '</ul>';
            $html .= '<div class="count">Página ' . $page . ' de ' . $totalPages . ' com ' . $count . ' registros.</div>';

            return $html;

        }

    }

?>