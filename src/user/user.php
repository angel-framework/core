<?php

  /*
  |--------------------------------------------------------------------------
  | user::fetch data from user
  |--------------------------------------------------------------------------
  |
  | This class supports:
  | - uri
  | - url
  | - ip
  | - port
  | - agent
  | - post
  | - get
  | - file
  | - dir
  |
  |
  */

  namespace angel;
  class user {

    public static function uri() {
      return ltrim(explode('?', $_SERVER['REQUEST_URI'])[0],'/');
    }

    public static function port() {
      return $_SERVER['REMOTE_PORT'];
    }

    public static function ip() {
      return $_SERVER['REMOTE_ADDR'];
    }

    public static function agent() {
      return $_SERVER['HTTP_USER_AGENT'];
    }

    public static function post($input) {
      if(is::ary($input)){
        return ary::map($input,function($key,$value){
          return $_POST[$value];
        });
      }else{
        return $input=='all' ? $_POST : $_POST[$input];
      }
    }

    public static function file($input) {
      return $input=='all' ? $_FILES : $_FILES[$input];
    }

    public static function get($input) {
      foreach (explode('&',explode('?', $_SERVER['REQUEST_URI'])[1]) as $value) {
        $value = explode('=',$value);
        $out[$value[0]] = $value[1];
      }
      if(is::ary($input)){
        return ary::map($input,function($key,$value){
          return $out[$value];
        });
      }else{
        return $input=='all' ? $out : $out[$input];
      }
    }

    public static function url() {
      return (isset($_SERVER['HTTPS'])?'https':'http').'://'.$_SERVER['HTTP_HOST'];
    }

    public static function dir() {
      return str_replace('\vendor\angel-project\core\src\user','',str_replace('/vendor/angel-project/core/src/user','',__dir__));
    }

  }
