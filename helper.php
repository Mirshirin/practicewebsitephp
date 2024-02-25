<?php

function dd($data)
{
    die('<pre>' . print_r($data, true) . '</pre>');
}