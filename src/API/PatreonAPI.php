<?php namespace PatreonLaravel\API;

use Patreon\API;
use PatreonLaravel\Models\PatreonUser;

class PatreonAPI
{
    private $access_token;
    private $api_client;

    /*
     * Constructor
     */
    public function __construct()
    {

    }

    /*
     * Set access token for client
     */
    public function setAccessToken($access_token)
    {
        \Log::debug("Access token: $access_token");
        $this->access_token = $access_token;
        $this->api_client = new API($this->access_token);
    }


    /*
     * Get user data
     */
    public function getUserData()
    {
        $response = $this->api_client->fetch_user();
        \Log::debug($response['data']);
        return PatreonUser::createFromJSON($response['data']);
    }

}