# Amazon SES Ruby Reference

Namespace: `amazon-ses`

Amazon SES uses AWS Signature Version 4. Configure `access_key_id`,
`secret_access_key`, `region`, and optional `session_token`; do not use bearer
tokens.

## Core Tools

```ruby
sent = app.call("integrations.amazon-ses.send_email", from_email_address: "hello@example.test", destination: {ToAddresses: ["user@example.test"]}, subject: "Welcome", text_body: "Thanks for signing up")
account = app.call("integrations.amazon-ses.get_account")
identities = app.call("integrations.amazon-ses.list_identities", page_size: 50)
identity = app.call("integrations.amazon-ses.get_identity", identity: "example.test")
config_sets = app.call("integrations.amazon-ses.list_configuration_sets")
suppressions = app.call("integrations.amazon-ses.list_suppressions", reason: "BOUNCE")
```
Template tools:

```ruby
app.call("integrations.amazon-ses.create_template", template_name: "welcome", subject: "Welcome, {{name}}", html_content: "<p>Hello {{name}}</p>", text_content: "Hello {{name}}")
template = app.call("integrations.amazon-ses.get_template", name: "welcome")
app.call("integrations.amazon-ses.update_template", template_name: "welcome", subject: "Updated subject", text_content: "Updated text")
app.call("integrations.amazon-ses.delete_template", template_name: "welcome")
```
## Generic Signed API

Use generic tools for SES v2 endpoints without a dedicated wrapper. Paths must
start with `/v2/`.

```ruby
result = app.call("integrations.amazon-ses.api_get", path: "/v2/email/account")
updated = app.call("integrations.amazon-ses.api_put", path: "/v2/email/account/suppression", body: {SuppressedReasons: ["BOUNCE", "COMPLAINT"]})
```
Generic tools return raw SES JSON. Refer to the official SES v2 API reference
for request and response shapes.
