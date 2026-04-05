# Calendly Integration

## Authentication

The Calendly integration uses a Personal Access Token passed via the `Authorization: Bearer {token}` header on every request.

Generate a token: **Calendly → Integrations & Apps → API & Webhooks → Personal Access Tokens**

## Response Format

Single-resource responses wrap data in `resource`:

```json
{
  "resource": {
    "uri": "https://api.calendly.com/users/...",
    "name": "John Doe",
    "email": "john@example.com"
  }
}
```

Collection responses include `collection` and `pagination`:

```json
{
  "collection": [...],
  "pagination": {
    "count": 20,
    "next_page": "https://api.calendly.com/scheduled_events?page_token=..."
  }
}
```

## Pagination

List endpoints use `page_token` for cursor-based pagination. Pass the `page_token` value from `pagination.next_page` to fetch the next page. When `next_page` is `null`, there are no more results.

---

## Tools

### calendly_get_user

Get the authenticated user's profile (name, email, scheduling URL, timezone, organization).

```lua
local user = app.integrations.calendly.get_user()
print(user.resource.name, user.resource.email)
```

---

### calendly_get_event_types

List event types for a user.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user` | string | no | User URI to filter by |
| `active` | boolean | no | Filter by active status |
| `page_token` | string | no | Pagination token |

```lua
local result = app.integrations.calendly.get_event_types({
  user = "https://api.calendly.com/users/abc-123",
  active = true
})

for _, et in ipairs(result.collection) do
  print(et.name, et.duration, et.scheduling_url)
end
```

---

### calendly_get_event_type

Get a single event type by UUID.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `uuid` | string | yes | Event type UUID |

```lua
local et = app.integrations.calendly.get_event_type({ uuid = "abc-123" })
print(et.resource.name, et.resource.duration)
```

---

### calendly_list_events

List scheduled events with optional filters.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user` | string | no | User URI to filter by |
| `status` | string | no | `"active"` or `"canceled"` |
| `min_start_time` | string | no | ISO 8601 lower bound |
| `max_start_time` | string | no | ISO 8601 upper bound |
| `page_token` | string | no | Pagination token |
| `count` | integer | no | Results per page (default 20, max 100) |

```lua
local result = app.integrations.calendly.list_events({
  status = "active",
  min_start_time = "2024-01-01T00:00:00Z",
  max_start_time = "2024-12-31T23:59:59Z"
})

for _, event in ipairs(result.collection) do
  print(event.name, event.start_time, event.end_time)
end
```

---

### calendly_get_event

Get a single scheduled event by UUID.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `uuid` | string | yes | Scheduled event UUID |

```lua
local event = app.integrations.calendly.get_event({ uuid = "evt-123" })
print(event.resource.name, event.resource.start_time)
```

---

### calendly_cancel_event

Cancel a scheduled event.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `uuid` | string | yes | Scheduled event UUID |
| `reason` | string | no | Cancellation reason |

```lua
local result = app.integrations.calendly.cancel_event({
  uuid = "evt-123",
  reason = "Rescheduling"
})
```

---

### calendly_list_invitees

List invitees for a scheduled event.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `event_uuid` | string | yes | Scheduled event UUID |
| `page_token` | string | no | Pagination token |
| `count` | integer | no | Results per page (default 20, max 100) |

```lua
local result = app.integrations.calendly.list_invitees({
  event_uuid = "evt-123"
})

for _, invitee in ipairs(result.collection) do
  print(invitee.name, invitee.email, invitee.status)
end
```

---

### calendly_get_invitee

Get a single invitee for an event.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `event_uuid` | string | yes | Scheduled event UUID |
| `invitee_uuid` | string | yes | Invitee UUID |

```lua
local inv = app.integrations.calendly.get_invitee({
  event_uuid = "evt-123",
  invitee_uuid = "inv-456"
})
print(inv.resource.name, inv.resource.email)
```

---

### calendly_create_one_off

Create a one-off event type for a specific time window.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `host` | string | yes | Host user URI |
| `start_time` | string | yes | ISO 8601 start time |
| `end_time` | string | yes | ISO 8601 end time |
| `location` | object | no | Location object (type + location) |
| `name` | string | no | Event type name |

```lua
local result = app.integrations.calendly.create_one_off({
  host = "https://api.calendly.com/users/abc-123",
  start_time = "2024-06-15T10:00:00Z",
  end_time = "2024-06-15T11:00:00Z",
  name = "Quick Sync",
  location = { type = "zoom" }
})
print(result.resource.scheduling_url)
```

---

### calendly_list_organization_memberships

List members of a Calendly organization.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `organization_uuid` | string | yes | Organization UUID |
| `page_token` | string | no | Pagination token |
| `count` | integer | no | Results per page |

```lua
local result = app.integrations.calendly.list_organization_memberships({
  organization_uuid = "org-123"
})

for _, member in ipairs(result.collection) do
  print(member.user.name, member.user.email, member.role)
end
```

---

### calendly_get_organization

Get an organization by UUID.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `uuid` | string | yes | Organization UUID |

```lua
local org = app.integrations.calendly.get_organization({ uuid = "org-123" })
print(org.resource.name, org.resource.slug)
```

---

### calendly_create_single_use_link

Create a single-use or multi-use scheduling link.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `owner_uri` | string | yes | Event type or user URI |
| `max_event_count` | integer | no | Max bookings via this link (default 1) |
| `link_type` | string | no | `"singe_use"` or `"multi_use"` (default `"singe_use"`) |

```lua
local result = app.integrations.calendly.create_single_use_link({
  owner_uri = "https://api.calendly.com/event_types/abc-123",
  max_event_count = 1,
  link_type = "singe_use"
})
print(result.resource.booking_url)
```

---

## Common Workflows

### Check upcoming meetings for the current user

1. `calendly_get_user` — Get the authenticated user's URI
2. `calendly_list_events` — Filter by `user` URI and `status = "active"` with a `min_start_time` of now

### Cancel an event and notify the invitee

1. `calendly_list_events` — Find the event
2. `calendly_list_invitees` — Get invitee details (name, email)
3. `calendly_cancel_event` — Cancel with a reason

### Create a quick booking link

1. `calendly_get_event_types` — Find the desired event type URI
2. `calendly_create_single_use_link` — Generate a shareable link for that event type

### Set up a one-off meeting

1. `calendly_create_one_off` — Create a temporary event type for a specific time window
2. Share the resulting `scheduling_url` with the participant
