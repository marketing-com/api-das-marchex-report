<?php

namespace Marchex;

/**
 * Class PhoneNumber
 *
 * @package PhoneNumber
 **/
class PhoneNumber
{ 

    /**
     *Lists the available telephone numbers in the number pool for the specified account.
     * 
     *@param string $account_id Required string. The unique, system-generated account ID of the specified account.
     *@return array An array of strings, each of which contains an available telephone number in the number pool.
     */    
    public function getNumberAvail($account_id){
      $request = new Request();
      $request->send('number.avail', [ $account_id ]);
      return $request->getOutput();
    }

  }
