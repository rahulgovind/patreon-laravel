<?php namespace PatreonLaravel\OAuth;

use \Config;
use Illuminate\Http\Request;
use Patreon\Oauth;

class PatreonOAuth
{
    public $client_id;
    private $client_secret;
    public $redirect_uri;
    private $oauth_client;

    /*
     * Constructor
     */
    public function __construct($config = null)
    {
        if($config == null)
            $this->setDefaultConfig();
        else
            $this->setConfig($config);
    }

    /*
     * Detect and get config
     */
    public function setDefaultConfig()
    {
        $this->setConfig(Config::get('patreon-laravel'));
    }

    public function setConfig($config)
    {
        $this->client_id = $config['client_id'];
        $this->client_secret = $config['client_secret'];
        $this->redirect_uri = $config['redirect_uri'];
        $this->oauth_client = new OAuth($this->client_id, $this->client_secret);
    }

    /*
     * Redirect to Patreon
     */
    public function redirect()
    {
        $redirect_url = "http://www.patreon.com/oauth2/authorize?response_type=code&client_id=" . $this->client_id . "&redirect_uri=" . urlencode($this->redirect_uri);
        return redirect($redirect_url);
    }

    /*
     * Get access and refresh token
     */
    public function getTokens(Request $request)
    {
        $tokens = $this->oauth_client->get_tokens($request->get('code'), $this->redirect_uri);

        \Log::debug($tokens);

        return [
            'access_token' => $tokens['access_token'],
            'refresh_token' => $tokens['refresh_token']
        ];
    }

    /*
     * Refresh access token
     */
    public function getNewAccessToken($refresh_token)
    {
        $tokens = $this->oauth_client->refresh_tokens($refresh_token, null);
        return $tokens['access_token'];
    }
}