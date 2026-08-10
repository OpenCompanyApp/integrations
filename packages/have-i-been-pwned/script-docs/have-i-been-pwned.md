# Have I Been Pwned

Namespace: `have-i-been-pwned`

Use this integration to inspect public breach metadata, check account exposure,
query verified-domain breach data, inspect paste exposure, retrieve stealer-log
summaries, check subscription status, and query the Pwned Passwords range API.

## Authentication

The breach catalogue tools and `hibp_pwned_password_range` work without an API
key. Account, paste, domain, stealer-log, domain-verification, subscribed-domain,
and subscription tools require an HIBP API key. When a protected tool is called
without credentials, it returns a clear configuration error instead of making an
unauthenticated request.

## Tools

- `hibp_breached_account`: returns breaches for an email address. Pass
  `truncate_response=false` when you need complete breach objects instead of
  only names. A not-found result is normalized to an empty array.
- `hibp_breached_account_range`: queries the six-character SHA-1 account hash
  prefix endpoint and returns HIBP's hash suffix response.
- `hibp_breaches`: lists public breach catalogue entries. Optional filters are
  `domain` and `is_spam_list`.
- `hibp_breach_by_name`: retrieves one breach by stable HIBP `Name`.
- `hibp_latest_breach`: retrieves the most recently added breach.
- `hibp_data_classes`: lists all breach data classes.
- `hibp_paste_account`: lists paste records for an email address. A not-found
  result is normalized to an empty array.
- `hibp_breached_domain`: lists breached aliases and breach names for a verified
  domain. A not-found result is normalized to an empty array.
- `hibp_subscribed_domains`: lists domains attached to the API-key subscription.
- `hibp_generate_dns_token`: generates a DNS TXT token for domain verification.
- `hibp_verify_dns_token`: asks HIBP to verify the DNS TXT token.
- `hibp_send_domain_verification_email`: sends a verification email to one of
  `admin`, `hostmaster`, `info`, `security`, or `webmaster`.
- `hibp_stealer_logs_by_email`: lists website domains found in stealer logs for
  an email address.
- `hibp_stealer_logs_by_website_domain`: lists email addresses found in stealer
  logs for a website domain.
- `hibp_stealer_logs_by_email_domain`: lists stealer-log records for addresses
  under an email domain.
- `hibp_subscription_status`: retrieves status for the configured API key.
- `hibp_pwned_password_range`: queries Pwned Passwords by the first five
  hexadecimal characters of a SHA-1 or NTLM hash.

## Return Notes

This package keeps HIBP's response field names intact. Breach objects include
fields such as `Name`, `Title`, `Domain`, `BreachDate`, `AddedDate`,
`ModifiedDate`, `PwnCount`, `DataClasses`, and status flags. Pwned Passwords
range responses are normalized to:

```json
{
  "prefix": "21BD1",
  "mode": "sha1",
  "padded": true,
  "matches": [
    {"hash_suffix": "DA6EE5E6BAE3D2F8C4BDB1A70E3E7F4E4B7F8A", "count": 42}
  ]
}
```

When `padding=true`, HIBP may include zero-count padding rows. Treat only
positive `count` matches as breached passwords.

## Examples

```js
var recent = tools.hibp_latest_breach({})

var breaches = tools.hibp_breached_account({
  account: "person@example.test",
  truncate_response: false,
})

var range = tools.hibp_pwned_password_range({
  prefix: "21BD1",
  mode: "sha1",
})
```
Do not send plaintext passwords to this integration. Hash the password outside
the tool and pass only the first five hexadecimal hash characters to
`hibp_pwned_password_range`.
