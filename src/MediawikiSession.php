<?php

namespace Mediawiki\Api;

use Guzzle\Service\Mediawiki\MediawikiApiClient;

/**
 * @since 0.1
 */
class MediawikiSession {

	/**
	 * @var array
	 */
	private $tokens = array();

	/**
	 * @var MediawikiApiClient
	 */
	private $client;

	/**
	 * @param MediawikiApiClient $client
	 */
	public function __construct( MediawikiApiClient $client ) {
		$this->client = $client;
	}

	/**
	 * @since 0.1
	 *
	 * @param string $type
	 *
	 * @return string
	 */
	public function getToken( $type = 'edit' ) {
		if( !array_key_exists( $type , $this->tokens ) ) {
			$result = $this->client->tokens( array( 'type' => $type ) );
			$this->tokens[$type] = array_pop( $result['tokens'] );
		}
		return $this->tokens[$type];
	}

	/**
	 * Clears all tokens stored by the api
	 *
	 * @since 0.2
	 */
	public function clearTokens() {
		$this->tokens = array();
	}

}