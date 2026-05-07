# Constant Contact Integration

Constant Contact V3 API integration for AI agents: contacts, lists, campaigns, campaign activities, email reports, account summary, user privileges, tags, custom fields, segments, bulk activities, and generic V3 endpoint access.

## Tools

| Tool | Type | Description |
|------|------|-------------|
| `constantcontact_list_contacts` | read | List contacts with pagination and status filtering |
| `constantcontact_get_contact` | read | Get a contact by ID |
| `constantcontact_create_contact` | write | Create a contact |
| `constantcontact_create_or_update_contact` | write | Create or update a contact via sign-up form semantics |
| `constantcontact_update_contact` | write | Update a contact |
| `constantcontact_delete_contact` | write | Delete a contact |
| `constantcontact_get_contact_activity_summary` | read | Get contact campaign activity summary |
| `constantcontact_list_lists` | read | List contact lists |
| `constantcontact_get_list` | read | Get a contact list |
| `constantcontact_create_list` | write | Create a contact list |
| `constantcontact_update_list` | write | Update a contact list |
| `constantcontact_delete_list` | write | Delete a contact list |
| `constantcontact_list_campaigns` | read | List email campaigns |
| `constantcontact_get_campaign` | read | Get an email campaign |
| `constantcontact_get_campaign_activity` | read | Get an email campaign activity |
| `constantcontact_get_email_sends_report` | read | Get sends report for an email activity |
| `constantcontact_get_email_bounces_report` | read | Get bounces report for an email activity |
| `constantcontact_get_email_clicks_report` | read | Get clicks report for an email activity |
| `constantcontact_list_tags` | read | List contact tags |
| `constantcontact_list_custom_fields` | read | List custom fields |
| `constantcontact_list_segments` | read | List segments |
| `constantcontact_get_segment` | read | Get a segment |
| `constantcontact_list_activities` | read | List bulk activities |
| `constantcontact_get_activity` | read | Get bulk activity status |
| `constantcontact_get_account_summary` | read | Get account summary details |
| `constantcontact_get_user_privileges` | read | Get access-token user privileges |
| `constantcontact_api_get` | read | Call a read-only V3 endpoint |
| `constantcontact_api_post` | write | Call a V3 POST endpoint |

`constantcontact_get_current_user` remains available as a compatibility alias for account summary.

## Configuration

| Field | Type | Required | Default |
|-------|------|----------|---------|
| `access_token` | secret | yes | - |
| `url` | url | no | `https://api.cc.email/v3` |

## Notes

- Account details use the documented `/account/summary` endpoint.
- Generic API tools accept relative paths only, not full URLs.
- Use `constantcontact_api_get` for lower-frequency report endpoints that are not modeled as first-class tools.

## API Reference

See the [Constant Contact V3 API documentation](https://developer.constantcontact.com/api_reference/api-reference.html).

## License

MIT
