# Vero Lua API Reference

Namespace: `app.integrations.vero`

Vero tools wrap the Track REST API at `https://api.getvero.com/api/v2`. The integration adds `auth_token` automatically as a query parameter.

## Users

### identify_user

Creates or updates a user via `POST /users/track`.

```lua
app.integrations.vero.identify_user({
  id = "usr_123",
  email = "person@example.test",
  name = "Example User",
  data = {
    plan = "premium",
    signup_date = "2026-05-01"
  }
})
```

Optional `channels` may include Vero channel objects, for example push tokens with `type`, `address`, and `platform`.

### update_user

Compatibility helper for profile updates. It also uses `POST /users/track`.

```lua
app.integrations.vero.update_user({
  id = "usr_123",
  data = {
    plan = "enterprise"
  }
})
```

### alias_user

Changes a user's identifier via `PUT /users/reidentify`. This merges identities, so use it only when that merge is intended.

```lua
app.integrations.vero.alias_user({
  id = "anonymous_123",
  new_id = "usr_123"
})
```

### unsubscribe / resubscribe

```lua
app.integrations.vero.unsubscribe({ id = "usr_123" })
app.integrations.vero.resubscribe({ id = "usr_123" })
```

### delete_user

Deletes the user profile and activity. Deleted users are not recoverable in Vero.

```lua
app.integrations.vero.delete_user({
  id = "usr_123"
})
```

## Tags

### edit_tags

Adds and removes tags in one call via `PUT /users/tags/edit`.

```lua
app.integrations.vero.edit_tags({
  id = "usr_123",
  add = { "prospect", "trial" },
  remove = { "inactive" }
})
```

## Events

### track_event

Tracks an event via `POST /events/track`. Prefer an identity object with `id` and/or `email`.

```lua
app.integrations.vero.track_event({
  identity = {
    id = "usr_123",
    email = "person@example.test"
  },
  event_name = "Viewed product",
  data = {
    product_name = "Example product",
    product_url = "https://example.test/products/1"
  },
  extras = {
    source = "OpenCompany",
    created_at = "2026-05-07T12:00:00+0000"
  }
})
```

Vero deduplicates similar events over a short window. Include unique event data when every event occurrence must be recorded.

## Generic API

Use generic tools only for documented endpoints that do not yet have a first-class tool. Paths must be relative.

```lua
local campaigns = app.integrations.vero.api_get({
  path = "/campaigns",
  params = { page = 1 }
})

app.integrations.vero.api_post({
  path = "/users/track",
  payload = {
    id = "usr_456",
    email = "new@example.test"
  }
})
```

Absolute URLs are rejected.

## Connection Status

`get_current_user` returns local configuration status only. Vero Track API does not expose a current-user endpoint, so API access is verified when a write tool sends data.

```lua
local status = app.integrations.vero.get_current_user({})
```

## Multi-Account Usage

```lua
app.integrations.vero.identify_user({ id = "1", email = "a@example.test" })
app.integrations.vero.default.identify_user({ id = "1", email = "a@example.test" })
app.integrations.vero.marketing.track_event({
  identity = { id = "1", email = "a@example.test" },
  event_name = "Signed up"
})
```
