# MailerLite Integration

Email marketing and subscriber management for OpenCompany.

## Setup

1. Install the package via Composer.
2. Add your MailerLite API key in the integration settings.
3. Generate an API key at **MailerLite → Integrations → API**.

## Tools

| Tool | Type | Description |
|------|------|-------------|
| `mailerlite_list_subscribers` | read | List subscribers with pagination and status filtering |
| `mailerlite_get_subscriber` | read | Get a single subscriber by ID |
| `mailerlite_create_subscriber` | write | Add a new subscriber |
| `mailerlite_update_subscriber` | write | Update subscriber name or custom fields |
| `mailerlite_delete_subscriber` | write | Delete a subscriber permanently |
| `mailerlite_list_groups` | read | List subscriber groups |
| `mailerlite_add_subscriber_to_group` | write | Add a subscriber to a group |
| `mailerlite_get_current_user` | read | Get authenticated account info |

## API Reference

See [lua-docs/mailerlite.md](lua-docs/mailerlite.md) for the full Lua API reference.

## Configuration

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `api_key` | secret | yes | MailerLite API key |

## License

MIT
