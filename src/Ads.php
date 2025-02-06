<?php

namespace Marchex;

/**
 * Class Ads
 *
 * @package Ads
 **/
class Ads
{
	/**
	*
	* Create or Update Ads.
	*
	*@param string $account_id
	*@param array $params
	*@return string. The unique, system-generated campaign ID of the new or existing ad campaign. 
	*
	*/     
	public function createOrUpdate($account,$params)
	{
	  $request = new Request();
	  $request->send('ad.configure', [ $account,$params ]);
	  return $request->getOutput();
	}
}