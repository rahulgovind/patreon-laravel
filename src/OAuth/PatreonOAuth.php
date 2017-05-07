<?php namespace PatreonLaravel\OAuth;

use \Config;
class PatreonOAuth
{
    public $client_id;
    private $client_secret;
    /*
     * Constructor
     */
    public function __construct()
    {

    }

    /*
     * Detect and get config
     */
    public function setConfig()
    {
        $this->client_id = Config::get('patreon-laravel.client_id');
        $this->client_secret = Config::get('patreon-laravel.client_secret');
    }

    /*
     * Redirect to Patreon
     */
    public function redirect()
    {
//        Documentation
//        GET www.patreon.com/oauth2/authorize
//        ?response_type=code
//        &client_id=<your client id>
//    &redirect_uri=<one of your redirect_uris that you provided in step 0>
        $redirect_url = "http://www.patreon.com/oauth2/authorize?response_type=code&client_id=" . $this->client_id . "&redirect_uri=" . Config::get('patreon-laravel.redirect_uri');
        return redirect($redirect_url);
    }
}