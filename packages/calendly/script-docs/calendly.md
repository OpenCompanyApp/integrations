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
    "next_page": "https://api.calendly.com/v2/event_types?page_token=..."
  }
}
```

## Pagination

List endpoints use `page_token` for cursor-based pagination. Pass the `page_token` value from `pagination.next_page` to fetch the next page. When `next_page` is `null`, there are no more results.

---

## Tools

### calendly_list_event_types

List event types for a user or organization.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user` | string | no | User URI to filter by |
| `organization` | string | no | Organization URI to filter by |
| `active` | boolean | no | Filter by active status |
| `page_token` | string | no | Pagination token |
| `count` | integer | no | Results per page (default 20, max 100) |

```js
var result = app.integrations.calendly.list_event_types({
  active: true,
})

for (const et of (result.collection)) {
  console.log(et.name, et.duration, et.scheduling_url)
}
```
---

### calendly_get_event_type

Get a single event type by UUID.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `uuid` | string | yes | Event type UUID |

```js
var et = app.integrations.calendly.get_event_type({ uuid: "abc-123" })
console.log(et.resource.name, et.resource.duration)
```
---

### calendly_create_booking

Create a booking by generating a one-off event type with a scheduling URL.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `host` | string | yes | Host user URI (e.g. https://api.calendly.com/users/...) |
| `start_time` | string | yes | ISO 8601 start time |
| `end_time` | string | yes | ISO 8601 end time |
| `location` | object | no | Location object (type + location) |
| `name` | string | no | Name for the booking |

```js
var result = app.integrations.calendly.create_booking({
  host: "https://api.calendly.com/users/abc-123",
  start_time: "2024-06-15T10:00:00Z",
  end_time: "2024-06-15T11:00:00Z",
  name: "Quick Sync",
  location: { type: "zoom" },
})
console.log(result.resource.scheduling_url)
```
---

### calendly_list_bookings

List scheduled bookings (events) with optional filters.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user` | string | no | User URI to filter by |
| `organization` | string | no | Organization URI to filter by |
| `status` | string | no | `"active"` or `"canceled"` |
| `min_start_time` | string | no | ISO 8601 lower bound |
| `max_start_time` | string | no | ISO 8601 upper bound |
| `page_token` | string | no | Pagination token |
| `count` | integer | no | Results per page (default 20, max 100) |

```js
var result = app.integrations.calendly.list_bookings({
  status: "active",
  min_start_time: "2024-01-01T00:00:00Z",
  max_start_time: "2024-12-31T23:59:59Z",
})

for (const booking of (result.collection)) {
  console.log(booking.name, booking.start_time, booking.end_time)
}
```
---

### calendly_list_organizations

List organizations the authenticated user belongs to.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_token` | string | no | Pagination token |

```js
var result = app.integrations.calendly.list_organizations({})

for (const org of (result.collection)) {
  console.log(org.name, org.slug)
}
```
---

### calendly_list_users

List users (organization memberships) in a Calendly organization.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `organization` | string | no | Organization URI to filter by |
| `user` | string | no | User URI to filter by |
| `page_token` | string | no | Pagination token |
| `count` | integer | no | Results per page (default 20, max 100) |

```js
var result = app.integrations.calendly.list_users({
  organization: "https://api.calendly.com/organizations/org-123",
})

for (const member of (result.collection)) {
  console.log(member.user.name, member.user.email, member.role)
}
```
---

### calendly_get_current_user

Get the authenticated user's profile (name, email, scheduling URL, timezone, organization).

```js
var user = app.integrations.calendly.get_current_user()
console.log(user.resource.name, user.resource.email)
```
---

## Common Workflows

### Check upcoming meetings for the current user

1. `calendly_get_current_user` — Get the authenticated user's URI
2. `calendly_list_bookings` — Filter by `user` URI and `status = "active"` with a `min_start_time` of now

### Find available event types and create a booking link

1. `calendly_list_event_types` — Find available event types
2. `calendly_get_event_type` — Get details for a specific event type
3. `calendly_create_booking` — Create a one-off event type with a scheduling URL

### Explore organization structure

1. `calendly_get_current_user` — Get user profile with organization info
2. `calendly_list_organizations` — See all organizations
3. `calendly_list_users` — List members within an organization

---

## Multi-Account Usage

If you have multiple Calendly accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.calendly.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.calendly.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.calendly.work.function_name({ /* parameters */ })
app.integrations.calendly.personal.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
