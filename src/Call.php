<?php

namespace Marchex;

/**
 * Class Call
 *
 * @package Call
 **/
class Call
{
	/**
	 * List of valid search parameters
	 * @var array
	 **/
	private $validSearch = [
		'start', 'end', 'assto', 'call_boundary',
		'callerid', 'cmpid', 'dispo', 'dna_class',
		'exact_times', 'grpid', 'include_dna',
		'include_spotted_keywords', 'keyword',
		'min_duration_secs', 'status', 'spotted_keywords',
		'subacct',
	];

	/**
	 * List of valid Audio formats
	 * @var array
	 **/
	private $validAudioFormat = array('mp3','wav');

	/**
	*
	* Gets the call log entry for the specified call.
	*
	*@param string $call_id
	*@return array Information about call. 
	*
	*/     
	public function find($call_id)
	{
		$request = new Request();
		$request->send('call.get', [ $call_id ]);
		return $request->getOutput();
	}

	/**
	*
	* Gets a Base64-encoded string that contains the audio data of the specified call, in the specified format.
	*
	* @param  string $call_id
	* @param  string $format default = 'mp3'
	* @return base64 string Audio Data.
	*/
	public function audio($call_id, $format = 'mp3')
	{
		$request = new Request();
		$request->send('call.audio', [ $call_id, $format ]);
		return $request->getOutput();
	}

	/**
	*
	* Gets a Base64-encoded string that contains the audio data of the specified call, in the specified format.
	*
	* @param  array|string $call_id
	* @param  string $format default = 'mp3'
	* @return array Audio Url.
	*/
	public function audio_url($call_ids, $format = null)
	{	
		if ( isset($format) ){
			$format = in_array($format, $this->validAudioFormat) ? $format : 'mp3';	
		}else{
			$format = 'mp3';
		}

		$call_ids = ( is_array($call_ids) ) ? $call_ids : array( $call_ids ) ;
		$request = new Request();
		$request->send('call.audio.url', [ $call_ids, $format ]);
		return $request->getOutput();
	}

	/**
	*
	* Gets whether call recording is enabled for the specified ad campaign.
	*
	*@param string $campaign_id
	*@return boolean 
	*
	*/
	public function enabledRecording($campaign_id)
	{
		$request = new Request();
		$request->send('ad.recordcall.get', [ $campaign_id ]);
		return $request->getOutput();
	}
	 

	/**
	 * Searches the call log of the specified account.
	 *
	 * @param string $account_id
	 * @param array $params
	 * @return array A list of calls matching the requested criteria.
	 **/
	public function search($account_id, $params = [])
	{
		$request = new Request();
		$request->send('call.search', [ $account_id, $params ]);
		return $request->getOutput();
	}
	
	/**
	 * Get Yesterday calls.
	 *
	 * @param string $account_id
	 * @return array A list of calls matching the requested criteria.
	 **/
	public function getYesterdayCalls($account_id)
	{
		$opts = array(
			'start' => date('Y-m-d\T00:00:00-05:00',strtotime('-1 day')),
			'end' => date('Y-m-d\T23:59:59-05:00',strtotime('-1 day'))
		);

		return $this->search($account_id, $opts);
	}
}