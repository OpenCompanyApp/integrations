# Braze Integration

Namespace: `app.integrations.braze`

Use this integration to work with the Braze REST API from an agent. Configure a Braze REST API key and the REST endpoint for the workspace region, such as `https://rest.iad-01.braze.com` or `https://rest.fra-01.braze.eu`.

## Common Workflows

### Track user data

```lua
local result = app.integrations.braze.track_users({
  payload = {
    attributes = {
      {
        external_id = "user_123",
        email = "person@example.test",
        first_name = "Ada"
      }
    },
    events = {
      {
        external_id = "user_123",
        name = "trial_started",
        time = "2026-05-07T10:00:00Z"
      }
    }
  }
})
```

### Trigger an API campaign

```lua
local result = app.integrations.braze.trigger_campaign_send({
  payload = {
    campaign_id = "campaign-id",
    recipients = {
      {
        external_user_id = "user_123",
        trigger_properties = {
          plan = "pro"
        }
      }
    }
  }
})
```

### Export campaign analytics

```lua
local result = app.integrations.braze.get_campaign_analytics({
  campaign_id = "campaign-id",
  length = 7,
  ending_at = "2026-05-07T00:00:00Z"
})
```

### Manage catalog items

```lua
local result = app.integrations.braze.create_catalog_item({
  catalog_name = "products",
  item_id = "sku_123",
  payload = {
    item = {
      name = "Demo product",
      price = 29
    }
  }
})
```

## Coverage Notes

Focused tools cover Braze catalogs, Cloud Data Ingestion syncs, email lists and statuses, campaign and Canvas exports, analytics, purchases, segments, messaging and scheduling, preference centers, SCIM dashboard users, SDK authentication keys, SMS and subscription groups, content blocks, email templates, user lifecycle endpoints, and media upload.

Most write tools accept a `payload` object that maps directly to the Braze request body. Read tools expose common query parameters directly and also support the raw `api_get`, `api_post`, `api_put`, `api_patch`, and `api_delete` escape hatches when Braze adds a new endpoint before this package has a focused wrapper.

Braze REST API keys are permission-scoped. A valid key can still receive `403` errors for endpoints that were not enabled when the key was created.
