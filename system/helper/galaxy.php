<?php
function cal_percent($price, $special){
    $hieu = sqrt(($price - $special) * ($price - $special));
    return (int)$hieu/($price/100);
}