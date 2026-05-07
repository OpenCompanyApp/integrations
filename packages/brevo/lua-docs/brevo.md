# Brevo Lua Reference

Namespace: `app.integrations.brevo`

Brevo tools use the `api-key` header against the v3 API. Request and response payloads are decoded Brevo JSON and keep Brevo field names such as `listIds`, `htmlContent`, `sender`, and `templateId`.

## Common Workflows

Create or update a contact:

```lua
app.integrations.brevo.create_contact({
  email = "person@example.test",
  attributes = {
    FIRSTNAME = "Ada"
  },
  list_ids = { 12 },
  update_enabled = true
})
```

Send a transactional email:

```lua
app.integrations.brevo.send_email({
  payload = {
    sender = { email = "noreply@example.test", name = "Example" },
    to = {
      { email = "person@example.test", name = "Ada" }
    },
    subject = "Welcome",
    htmlContent = "<p>Hello Ada</p>"
  }
})
```

Create an email campaign:

```lua
local campaign = app.integrations.brevo.create_email_campaign({
  payload = {
    name = "Launch update",
    subject = "Launch update",
    sender = { id = 3 },
    recipients = { listIds = { 12 } },
    htmlContent = "<p>News</p>"
  }
})
```

## Coverage Notes

- Contact tools cover contacts, attributes, lists, folders, list membership, imports, and exports.
- Messaging tools cover transactional email, templates, SMTP logs/statistics, blocked recipients/domains, transactional SMS, and WhatsApp.
- Campaign tools cover email, SMS, and WhatsApp campaigns plus send-now and template approval operations.
- Account/settings tools cover senders, sender domains, webhooks, inbound parsing, external feeds, and process status.
- eCommerce and event tools cover products, categories, order status, custom events, custom object records, and eCommerce activation.
- Raw `api_get`, `api_post`, `api_put`, `api_patch`, and `api_delete` can call any Brevo v3 endpoint path.

Use `payload` for full Brevo request bodies when a focused tool does not expose every optional field.
