<?php
  function GetDomain(){
    $url = '';
    if(isset($_SERVER['HTTP_HOST'])){
        $url = $_SERVER['HTTP_HOST'];
    }else if(isset($_SERVER['SERVER_NAME'])){
        $url = $_SERVER['SERVER_NAME'];
    }else if(isset($_SERVER['SERVER_ADDR'])){
      $url = $_SERVER['SERVER_ADDR'];
    }

    $url = in_array($url, ['0.0.0.0', '::1'])? 'localhost': $url;

    $pieces = parse_url($url);
    $domain = isset($pieces['host'])? $pieces['host']: (isset($pieces['path'])? $pieces['path']: '');
        
    if(preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)){
        return '.'.$regs['domain'];
    }
    
    return $domain;
  }