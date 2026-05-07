# Close CRM Integration

Close CRM integration for OpenCompany agents. It exposes Close leads, contacts, opportunities, tasks, notes, users, statuses, and pipelines through one tool per REST API operation.

## Install

```bash
composer require opencompanyapp/integration-close
```

## Configuration

Close uses HTTP Basic authentication with the API key as the username and an empty password.

```php
'close' => [
    'api_key' => env('CLOSE_API_KEY'),
    'url' => env('CLOSE_API_URL', 'https://api.close.com/api/v1'),
],
```

## Tool Coverage

| Tool | Type | Purpose |
| --- | --- | --- |
| `close_list_leads` | read | Search and list leads |
| `close_get_lead` | read | Fetch one lead |
| `close_create_lead` | write | Create a lead with optional contacts |
| `close_update_lead` | write | Update lead fields |
| `close_delete_lead` | write | Delete a lead |
| `close_list_contacts` | read | List contacts |
| `close_get_contact` | read | Fetch one contact |
| `close_create_contact` | write | Create a contact |
| `close_update_contact` | write | Update a contact |
| `close_delete_contact` | write | Delete a contact |
| `close_list_opportunities` | read | List opportunities |
| `close_get_opportunity` | read | Fetch one opportunity |
| `close_create_opportunity` | write | Create an opportunity |
| `close_update_opportunity` | write | Update an opportunity |
| `close_delete_opportunity` | write | Delete an opportunity |
| `close_list_tasks` | read | List tasks |
| `close_create_task` | write | Create a task |
| `close_get_task` | read | Fetch one task |
| `close_update_task` | write | Update a task |
| `close_delete_task` | write | Delete a task |
| `close_list_activities` | read | List activities across types |
| `close_list_notes` | read | List note activities |
| `close_get_note` | read | Fetch one note activity |
| `close_create_note` | write | Create a note activity |
| `close_update_note` | write | Update a note activity |
| `close_delete_note` | write | Delete a note activity |
| `close_get_current_user` | read | Fetch the authenticated user |
| `close_list_users` | read | List organization users |
| `close_get_user` | read | Fetch one user |
| `close_list_user_availability` | read | List user availability statuses |
| `close_list_lead_statuses` | read | List lead statuses |
| `close_create_lead_status` | write | Create a lead status |
| `close_update_lead_status` | write | Rename a lead status |
| `close_delete_lead_status` | write | Delete a lead status |
| `close_list_opportunity_statuses` | read | List opportunity statuses |
| `close_create_opportunity_status` | write | Create an opportunity status |
| `close_update_opportunity_status` | write | Update an opportunity status |
| `close_delete_opportunity_status` | write | Delete an opportunity status |
| `close_list_pipelines` | read | List pipelines |
| `close_create_pipeline` | write | Create a pipeline |
| `close_update_pipeline` | write | Update a pipeline |
| `close_delete_pipeline` | write | Delete a pipeline |

## Notes

- The API base URL defaults to `https://api.close.com/api/v1`.
- List endpoints follow Close pagination fields such as `_limit` and `_skip`.
- Older list tools return compact wrappers for agent ergonomics. New endpoint tools return Close JSON directly.
- Lua usage examples live in `lua-docs/close.md`.

## License

MIT
