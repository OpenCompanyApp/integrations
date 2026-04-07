# Postmark Integration

## Authentication

The Postmark integration uses a Server API token. The token is sent via the `X-Postmark-Server-Token` header on every request.

Find your Server API token: **Postmark Dashboard → Server → API Tokens**

For account-level operations (listing servers), you may need an Account API token.

## Base URL

- Default: `https://api.postmarkapp.com`

## Response Format

Postmark API responses return JSON. For example, the message list returns:

```json
{
  "TotalCount": 100,
  "Messages": [
    {
      "MessageID": "abc-123",
      "MessageStream": "outbound",
      "To": ["user@example.com"],
      "From": "sender@example.com",
      "Subject": "Hello",
      "Status": "Sent",
      "CreatedAt": "2024-01-01T00:00:00.0000000-00:00"
    }
  ]
}
```

## Pagination

List endpoints support `count` and `offset` parameters for pagination.

- `count` — Number of records to return (default 100, max 500)
- `offset` — Number of records to skip

## Common Workflows

### Send an email

1. `postmark_send_email` — Send an email with To, From, Subject, and TextBody or HtmlBody. Optionally add Cc, Bcc, Tag, and ReplyTo.

### Track messages

1. `postmark_list_messages` — List outbound messages. Filter by recipient, sender, subject, status, or tag.
2. `postmark_get_message` — Get full details for a specific message by MessageID.

### Manage templates

1. `postmark_list_templates` — Browse all templates in the account.
2. `postmark_get_template` — View template content including subject, HTML, and text body.

### Server management

1. `postmark_list_servers` — List servers in the account. Filter by name.
2. `postmark_get_current_user` — Get current server info and settings. Useful as a health check.

## Message Statuses

Common message statuses for filtering:
- `queued` — Message is queued for delivery
- `sent` — Message was delivered to the recipient's server
- `bounced` — Message bounced
- `inbound` — Message was received inbound
- `opened` — Recipient opened the message (requires open tracking)
- `clicked` — Recipient clicked a tracked link

## Tags

You can attach a tag to outgoing emails for categorization. Pass a `Tag` string when sending an email. Tags can be used to filter messages in `postmark_list_messages`.

## Sender Signatures

The `From` email address must correspond to a verified Sender Signature in your Postmark account. Create and verify sender signatures in the Postmark Dashboard.

---

## Multi-Account Usage

If you have multiple Postmark accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.postmark.function_name({...})

-- Explicit default (portable across setups)
app.integrations.postmark.default.function_name({...})

-- Named accounts
app.integrations.postmark.production.function_name({...})
app.integrations.postmark.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
