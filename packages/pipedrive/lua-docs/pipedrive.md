# Pipedrive Integration

## Authentication

The Pipedrive integration uses a personal access token (API key) passed as the `api_token` query parameter on every request. You also need your company domain (e.g., `https://mycompany.pipedrive.com`).

Find your API token: **Pipedrive → Settings → Personal → API**

## Response Format

All Pipedrive API responses wrap data in:

```json
{
  "success": true,
  "data": { ... }
}
```

For list endpoints, `data` is an array and `additional_data.pagination` contains pagination info:

```json
{
  "success": true,
  "data": [...],
  "additional_data": {
    "pagination": {
      "start": 0,
      "limit": 100,
      "more_items_in_collection": true
    }
  }
}
```

## Pagination

List endpoints use `start` (0-based offset) and `limit` parameters. Check `more_items_in_collection` to determine if more pages exist.

## Common Workflows

### Create a deal with a new contact and organization

1. `pipedrive_create_organization` — Create the company
2. `pipedrive_create_person` — Create the contact (pass `org_id` from step 1)
3. `pipedrive_create_deal` — Create the deal (pass `person_id` and `org_id`)

### Search and update

1. `pipedrive_search_persons` — Find a person by name or email
2. `pipedrive_update_person` — Update their details

### Move a deal through the pipeline

1. `pipedrive_list_pipelines` — Get available pipelines
2. `pipedrive_list_stages` — Get stages for a specific pipeline
3. `pipedrive_update_deal` — Move the deal to a new stage (pass `stage_id`)

## Deal Status

Deals can have the following statuses:
- `open` — Active deal in the pipeline
- `won` — Deal is won/closed
- `lost` — Deal is lost/closed

---

## Multi-Account Usage

If you have multiple pipedrive accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.pipedrive.function_name({...})

-- Explicit default (portable across setups)
app.integrations.pipedrive.default.function_name({...})

-- Named accounts
app.integrations.pipedrive.work.function_name({...})
app.integrations.pipedrive.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
