# MailerSend - Lua API Reference

Namespace: `app.integrations["mailer-send"]`

This integration uses the MailerSend API V1 with bearer-token authentication. The API returns MailerSend's native JSON response shapes, commonly `data`, `links`, and `meta` for list endpoints.

Official API reference: https://developers.mailersend.com/api/v1/

## Coverage

The integration exposes tools for:

- Email sending: single email and bulk email.
- Messages, templates, domains, DNS records, verification, and domain recipients.
- Activity and analytics by date, country, user-agent, and reading environment.
- Recipients and suppression lists for hard bounces, spam complaints, unsubscribes, and on-hold entries.
- Webhooks and inbound email routes.
- SMTP users for sending domains.

## Sending Email

```lua
local result = app.integrations["mailer-send"].send_email({
  from = {email = "noreply@example.test", name = "Example"},
  to = {
    {email = "ada@example.test", name = "Ada"}
  },
  subject = "Welcome",
  html = "<p>Hello Ada</p>",
  text = "Hello Ada",
  tags = {"onboarding"},
  personalization = {
    {
      email = "ada@example.test",
      data = {first_name = "Ada"}
    }
  }
})
```

For batches, pass an array of full MailerSend email payloads:

```lua
local bulk = app.integrations["mailer-send"].send_bulk_email({
  messages = {
    {
      from = {email = "noreply@example.test", name = "Example"},
      to = {{email = "ada@example.test"}},
      subject = "Batch 1",
      text = "Hello"
    }
  }
})
```

## Domains

```lua
local domains = app.integrations["mailer-send"].list_domains({
  limit = 25,
  page = 1,
  verified = true
})

local dns = app.integrations["mailer-send"].get_domain_dns_records({
  domain_id = "domain_123"
})

local status = app.integrations["mailer-send"].get_domain_verification_status({
  domain_id = "domain_123"
})
```

Domain writes include `create_domain`, `delete_domain`, and `update_domain_settings`.

## Activity And Analytics

MailerSend activity endpoints require a domain and a Unix timestamp range. Analytics data is retained by MailerSend for a limited period.

```lua
local activity = app.integrations["mailer-send"].list_activities({
  domain_id = "domain_123",
  date_from = 1778112000,
  date_to = 1778198400,
  event = {"sent", "delivered"},
  limit = 25
})

local by_date = app.integrations["mailer-send"].get_analytics_by_date({
  date_from = 1778112000,
  date_to = 1778198400,
  event = {"sent", "delivered", "opened"},
  group_by = "days"
})
```

Open analytics tools are available for country, user-agent, and reading environment.

## Suppressions

```lua
local bounces = app.integrations["mailer-send"].list_hard_bounces({
  domain_id = "domain_123",
  limit = 25
})

app.integrations["mailer-send"].add_unsubscribes({
  domain_id = "domain_123",
  recipients = {"user@example.test"}
})
```

Deletion tools accept `ids` or `all = true` where the upstream endpoint supports bulk deletion.

## Webhooks And Inbound Routes

```lua
local webhook = app.integrations["mailer-send"].create_webhook({
  domain_id = "domain_123",
  name = "Events",
  url = "https://example.test/hooks/mailersend",
  events = {"activity.sent", "activity.delivered"},
  enabled = true
})

local route = app.integrations["mailer-send"].create_inbound_route({
  domain_id = "domain_123",
  name = "Support replies",
  domain_enabled = true,
  inbound_domain = "inbound.example.test",
  inbound_priority = 10,
  catch_filter = {type = "catch_all", filters = {}},
  match_filter = {type = "match_all", filters = {}},
  forwards = {
    {type = "webhook", value = "https://example.test/hooks/inbound"}
  }
})
```

## SMTP Users

```lua
local smtp_users = app.integrations["mailer-send"].list_smtp_users({
  domain_id = "domain_123"
})
```

Use SMTP user write tools for setup automation only; generated credentials are sensitive and should not be logged.

## Multi-Account Usage

```lua
app.integrations["mailer-send"].list_messages({})
app.integrations["mailer-send"].default.list_messages({})
app.integrations["mailer-send"].production.list_domains({})
```

All account namespaces expose the same tools; only credentials differ.
