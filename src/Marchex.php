<?php

namespace Marchex;

/**
 * Class Marchex
 *
 * @package Marchex
 **/
 class Marchex
 {
    const VERSION = '1.0.0';

    /**
     * The user email address.
     * @var string
     **/
     protected static $username;

    /**
     * The user password.
     * @var string
     **/
     protected static $password;

    /**
     * The base URL for the Marchex API
     * @var string
     **/
     protected static $api_base_url = 'https://api.marchex.io/api/jsonrpc/1';

     /**
      * Gets the base API URL
      *
      * @return string self::$apiBase
      **/
     public static function getBaseUrl()
     {
        return self::$api_base_url;
     }

     /**
      * Checks if credentials are set
      *
      * @return boolean
      **/
     public static function checkCredentials()
     {
        return isset(self::$username, self::$password);
     }

     /**
      * Sets the username and password for the API user
      *
      * @param string $username
      * @param string $password
      **/
     public static function setCredentials($username, $password)
     {
        self::$username = $username;
        self::$password = $password;
     }

     /**
      * Gets the Base64 Encoded credentials
      *
      * @return string An encoded string representing the user credentials
      **/
      public static function getCredentials()
      {
          if (!self::checkCredentials()) {
              throw new \InvalidArgumentException;
          }

          return base64_encode(self::$username . ':' . self::$password);
      }

     /**
      * Resets the user credentials to null values
      *
      * @return
      **/
      public static function resetCredentials()
      {
          self::$username = null;
          self::$password = null;
      }
 }
