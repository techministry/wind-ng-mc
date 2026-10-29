# NerdID Login Setup

WiND supports NerdID authorization-code sign-in with PKCE. It signs in only an existing, activated WiND account whose email exactly matches NerdID's verified email. It does not create accounts or change passwords.

Register an OIDC client at NerdID with this redirect URI:

```text
https://your-wind-host/?nerdid=callback
```

Set the following values in the deployment's private `config/config.php`. Keep the client secret out of source control:

```php
$config['nerdid'] = array(
    'client_id' => 'rq626afr1xsi0z56vke34',
    'client_secret' => 'YOUR_NERDID_CLIENT_SECRET',
    'redirect_uri' => 'https://your-wind-host/?nerdid=callback'
);
```

Use the exact same redirect URI when registering the client. The NerdID button appears once all three settings are present. The configured web server must allow outbound HTTPS requests to `id.techministry.eu` and PHP's OpenSSL extension must be enabled.