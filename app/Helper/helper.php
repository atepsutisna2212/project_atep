<?php
function helper()
{
    return "hello helper";
}

function formatDate($date)
{
    return date('d-M-Y', strtotime($date));
}
