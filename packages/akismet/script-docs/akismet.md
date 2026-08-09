# Akismet

Namespace: `akismet`

Use this integration to check user-submitted content for spam with Akismet,
verify credentials, submit missed-spam or false-positive feedback, and inspect
API-key site activity or monthly usage limits.

## Authentication

Akismet requires an API key and a `blog` URL. The blog value should be the
front page or home URL of the site, app, forum, wiki, or other instance making
the request, including `http://` or `https://`.

## Tools

- `akismet_verify_key`: verify the API key and blog URL.
- `akismet_comment_check`: check submitted content for spam.
- `akismet_submit_spam`: report missed spam.
- `akismet_submit_ham`: report a false positive.
- `akismet_key_sites`: inspect site activity for the API key.
- `akismet_usage_limit`: inspect current monthly usage and throttling status.

## Return Notes

`akismet_comment_check` returns `spam = true` when Akismet returns `true`, and
`spam = false` when Akismet returns `false`. It also includes `pro_tip` from
`X-akismet-pro-tip`, `recheck_after` from `X-akismet-recheck-after`, and
`debug` from `X-akismet-debug-help` when present.

`akismet_verify_key` returns `valid`, `body`, and optional `debug`.
`akismet_key_sites` returns JSON by default. With `format = "csv"`, it returns
the raw CSV body and status.

## Examples

```js
var result = tools.akismet_comment_check({
  user_ip: "198.51.100.10",
  user_agent: "Mozilla/5.0",
  referrer: "https://example.test/contact",
  permalink: "https://example.test/contact",
  comment_type: "contact-form",
  comment_author: "Example User",
  comment_author_email: "user@example.test",
  comment_content: "Hello, I have a question about your product.",
  is_test: true,
})

if (result.spam) {
  // Queue, reject, or discard according to local policy.
}

var usage = tools.akismet_usage_limit({})
```
For `akismet_submit_spam` and `akismet_submit_ham`, send the original content
metadata as closely as possible to the matching `comment-check` request.
Avoid passing private data beyond what is needed for spam analysis.
