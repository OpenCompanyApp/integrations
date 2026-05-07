# Mailgun Lua Reference

Namespace: `app.integrations.mailgun`

Mailgun tools use Basic Auth with username `api` and the configured `api_key` as password. Configure a default `domain` for domain-scoped tools; you can override it per call with `domain` where supported.

## Examples

```lua
app.integrations.mailgun.send_email({
  from = "Example <noreply@example.test>",
  to = { "user@example.test" },
  subject = "Hello",
  text = "Hello from Mailgun"
})

local events = app.integrations.mailgun.list_events({
  event = "delivered",
  limit = 100
})

local bounce = app.integrations.mailgun.create_bounce({
  address = "bad@example.test",
  code = 550,
  error = "Suppressed by support request"
})
```

## Coverage Notes

- Domain-scoped tools default to the configured sending domain.
- Suppression tools cover bounces, complaints, unsubscribes, and allowlists.
- Route, webhook, mailing-list, member, template, tag, stats, IP, and domain tools are exposed as focused operations.
- Raw `api_get`, `api_post`, `api_put`, and `api_delete` can call any Mailgun API path, including `/v4/...` for domain APIs.

Responses are decoded Mailgun JSON exactly as returned by the API.
