# MailerLite Integration

MailerLite email marketing integration for OpenCompany and KosmoKrator agents.

This package targets the current MailerLite API at `https://connect.mailerlite.com/api`, not the older Classic v2 API. Classic accounts should use Classic credentials and migrate when possible.

## Setup

1. Add a MailerLite API key in the integration settings.
2. Generate tokens in MailerLite under Integrations > MailerLite API.

## Tool Coverage

| Area | Tools |
|------|-------|
| Subscribers | list, get, create/upsert, update, delete, activity |
| Groups | list, create, update, delete, list subscribers, add/upsert subscriber, assign, unassign, import |
| Segments | list, list subscribers, update, delete |
| Fields | list, create, update, delete |
| Automations | list, get, activity, create draft, delete |
| Campaigns | list, get, create, update, schedule, cancel, delete, subscriber activity |
| Forms | list, get, update, delete, subscribers |
| Webhooks | list, get, create, update, delete |
| Utilities | batch, credential verification, safe raw GET/POST/PUT/PATCH/DELETE |

## Notes

- Subscriber IDs and email addresses can both be used where MailerLite documents `subscribers/{id or email}`.
- `mailerlite_add_subscriber_to_group` keeps legacy tool semantics by creating or updating a subscriber with the target group in the `groups` payload.
- `mailerlite_assign_subscriber_to_group` and `mailerlite_unassign_subscriber_from_group` use MailerLite's dedicated existing-subscriber group endpoints.
- Raw API helper paths must be relative, such as `/subscribers`; absolute URLs are rejected.

## Configuration

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `api_key` | secret | yes | MailerLite API token |

## API Reference

See [script-docs/mailerlite.md](script-docs/mailerlite.md) for JavaScript usage notes and examples.

## License

MIT
