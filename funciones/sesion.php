<?php

class sesion
{

  protected static $iniciada= false;
 
  public static function start()
  {
    if (!self::$iniciada) {
      session_start();
      self::$iniciada= true;
    }
  }
  
  
  public static function clear()
  {
    if (self::$iniciada) {
      session_unset();   
      }
      session_destroy();      
      self::$iniciada= false;
    }
  }
  
 
  public static function get( $variable, $defecto=null)
  {
    if (!self::$iniciada) self::start();
    $res= $defecto;
    if (isset($_SESSION[$variable])) $res= $_SESSION[$variable];
    //Descomentar la siguiente linea si se quieren guardar los 
    //parametros no creados manualmente que son por defecto.
    //--else if ($defecto !== null) self::set( $variable, $defecto);
    return $res;
  }//get

  //-------------------------------------------------------------------------
  //Establecer una variable de sesion
  public static function set( $variable, $valor)
  {
    if (!self::$iniciada) self::start();
    $_SESSION[$variable]= $valor;
    //Si se quiere hacer limpieza de variables nulas, descomentar la linea siguiente.
    if ($valor === null) unset( $_SESSION[$variable]);
  }//set

}//class sesion
