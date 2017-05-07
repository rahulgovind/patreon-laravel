<?php

return [
    'client_id' => env('PATREON_CLIENT_ID', ''),
    'client_secret' => env('PATREON_CLIENT_SECRET', ''),
    'redirect_uri' => env('PATREON_REDIRECT_URL', 'localhost:8000/oauth/patreon/redirect')
];