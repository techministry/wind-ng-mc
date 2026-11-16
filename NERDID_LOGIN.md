# NerdID Login Setup

WiND supports NerdID authorization-code sign-in with PKCE. NerdID's email must be verified. If an existing WiND account has exactly that email, the user is signed in (a pending account is activated, since NerdID has verified the email). If none exists, an activated account is created automatically, with a username derived from NerdID's `preferred_username` (or the email prefix, made unique), the given/family names, and a random password that can be changed through the password restore page. Set `'auto_register' => FALSE` to disable creation and only allow sign-in to existing accounts.

Register an OIDC client at NerdID with this redirect URI:

```text
https://your-wind-host/?nerdid=callback
```

Set the following values in the deployment's private `config/config.php`. Keep the client secret out of source control:

```php
$config['nerdid'] = array(
    'client_id' => 'rq626afr1xsi0z56vke34',
    'client_secret' => 'YOUR_NERDID_CLIENT_SECRET',
    'redirect_uri' => 'https://your-wind-host/?nerdid=callback',
    'auto_register' => TRUE, // optional, default TRUE
    'debug' => FALSE // optional: show the failure reason on the error page; use only while troubleshooting
);
```

Use the exact same redirect URI when registering the client. The NerdID button appears once all three settings are present. The configured web server must allow outbound HTTPS requests to `id.techministry.eu` and PHP's OpenSSL extension must be enabled.