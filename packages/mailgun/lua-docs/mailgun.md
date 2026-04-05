# Mailgun Integration

## Authentication

The Mailgun integration uses an API key and a sending domain. The API key is sent as a Bearer token in the `Authorization` header on every request.

Find your API key: **Mailgun Dashboard → Sending → Domain Settings → API Keys**

Your sending domain is the domain you configured in Mailgun (e.g. `mg.example.com`).

## Base URL

- US region: `https://api.mailgun.net/v3` (default)
- EU region: `https://api.eu.mailgun.net/v3`

## Response Format

Mailgun API responses typically wrap data in a top-level object. For example, the domains list returns:

```json
{
  "total_count": 2,
  "items": [
    {
      "name": "mg.example.com",
      "state": "active",
      "created_at": "Mon, 01 Jan 2024 00:00:00 UTC"
    }
  ]
}
```

Events return an `items` array with a `paging` object for navigation.

## Pagination

List endpoints support `limit` and `page` parameters. The `page` value is a URL or token from the previous response's `paging.next` or `paging.previous` field.

## Common Workflows

### Send a tracked email

1. `mailgun_send_email` — Send an email with to, from, subject, and text or html body. Add tags for tracking.

### Monitor email delivery

1. `mailgun_get_events` — Filter by event type (accepted, delivered, failed, bounced) and recipient.
2. `mailgun_get_stats` — Get aggregate stats by day, hour, or month.

### Manage mailing lists

1. `mailgun_list_mailing_lists` — See all lists.
2. `mailgun_create_mailing_list` — Create a new list.
3. `mailgun_list_members` — View members of a list.
4. `mailgun_add_member` — Add a subscriber to a list.

### Handle bounces

1. `mailgun_get_suppressions` — View bounced addresses for a domain.
2. `mailgun_create_suppression` — Manually suppress an address to prevent future delivery.

### Domain management

1. `mailgun_list_domains` — List all domains in the account.
2. `mailgun_get_domain` — Get DNS records and state for a specific domain.

## Event Types

Common event types for filtering:
- `accepted` — Mailgun accepted the message
- `delivered` — Message was delivered to the recipient's server
- `failed` — Permanent delivery failure
- `bounced` — Message bounced
- `opened` — Recipient opened the message (requires tracking)
- `clicked` — Recipient clicked a tracked link

## Tags

You can attach tags to outgoing emails for categorization and filtering. Pass `tags` as a comma-separated string when sending an email. Tags are used for analytics and event filtering.

---

## Multi-Account Usage

If you have multiple mailgun accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.mailgun.function_name({...})

-- Explicit default (portable across setups)
app.integrations.mailgun.default.function_name({...})

-- Named accounts
app.integrations.mailgun.work.function_name({...})
app.integrations.mailgun.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
