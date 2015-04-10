<?php
/**
 * Copyright (c) 2015, Avot Media BV
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * - Redistributions of source code must retain the above copyright notice,
 *    this list of conditions and the following disclaimer.
 * - Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in the
 *    documentation and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE AUTHOR AND CONTRIBUTORS ``AS IS'' AND ANY
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE AUTHOR OR CONTRIBUTORS BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY
 * OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH
 * DAMAGE.
 *
 * @license     Berkeley Software Distribution License (BSD-License 2) http://www.opensource.org/licenses/bsd-license.php
 * @author      Avot Media BV <contact@avot.nl>
 * @copyright   Avot Media BV
 * @link        https://www.avot.nl / http://getfound.nl/
 */
/**
 * Retrieves the KiyOh score and reviews for the given hash
 *
 * @param	string	The hash to use
 * @param	int		The number of seconds, the score and reviews are cached
 * @param	string	Optional User Agent string, defaults to KiyOh Score And Review Client
 * @return	mixed	The array (name:string, score:decimal, reviews:int) with score and number of reviews or FALSE
 */
function get_kiyoh_score_and_reviews($Hash, $Expires = 3600, $UA = 'KiyOh Score And Review Client')
{
	$CacheFile = realpath(NULL).'/kiyoh_'.$Hash.'.txt';
	if (!file_exists($CacheFile) || filemtime($CacheFile) < (time() - $Expires)) {
		$Context = stream_context_create(array('http' => array(
			'method'	=> 'GET',
			'header'	=> "Accept-language: en\r\nUser-Agent: ".$UA."\r\n"
		)));
		if (($APIData = file_get_contents('https://kiyoh.api.gl/?q='.$Hash, FALSE, $Context)) !== FALSE && ($APIResult = json_decode($APIData, TRUE)) !== FALSE && array_key_exists('code', $APIResult) && (int)$APIResult['code'] === 200 && array_key_exists('result', $APIResult)) {
			file_put_contents($CacheFile, json_encode($APIResult['result']), LOCK_EX);
			return $APIResult['result'];
		}
	}
	return (($Data = file_get_contents($CacheFile)) !== FALSE && ($ReturnData = json_decode($Data, TRUE)) !== FALSE ? $ReturnData : FALSE);
}
?>