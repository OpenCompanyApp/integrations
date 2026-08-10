# Freshmarketer — JavaScript API Reference

## list_campaigns

List marketing campaigns with pagination and optional status filter.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `limit` | integer | no | Number of campaigns per page (default: 20) |
| `status` | string | no | Filter by status (e.g., `"active"`, `"completed"`, `"draft"`) |

### Examples

```js
// List first 20 campaigns
var result = app.integrations.freshmarketer.list_campaigns({
  page: 1,
  limit: 20,
})

// Filter active campaigns only
var result = app.integrations.freshmarketer.list_campaigns({
  status: "active",
})
```
---

## get_campaign

Get detailed information about a specific campaign.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The campaign ID |

### Example

```js
var result = app.integrations.freshmarketer.get_campaign({
  id: 123,
})
```
---

## create_campaign

Create a new marketing campaign.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Campaign name |
| `channel_list` | array | no | Channels (e.g., `{"email"}`) |
| `schedule` | object | no | Schedule config (e.g., `{type = "immediate"}` or `{type = "scheduled", scheduled_at = "2025-06-01T09:00:00Z"}`) |

### Examples

```js
// Create an immediate email campaign
var result = app.integrations.freshmarketer.create_campaign({
  name: "Welcome Series",
  channel_list: ["email"],
  schedule: { type: "immediate" },
})

// Create a scheduled campaign
var result = app.integrations.freshmarketer.create_campaign({
  name: "Monthly Newsletter",
  channel_list: ["email"],
  schedule: {
    type: "scheduled",
    scheduled_at: "2025-06-01T09:00:00Z",
  }
})
```
---

## list_segments

List contact segments with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `limit` | integer | no | Results per page (default: 20) |

### Example

```js
var result = app.integrations.freshmarketer.list_segments({
  page: 1,
  limit: 20,
})
```
---

## get_segment

Get details of a specific contact segment.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The segment ID |

### Example

```js
var result = app.integrations.freshmarketer.get_segment({
  id: 456,
})
```
---

## list_users

List all users in the Freshmarketer account.

### Parameters

None.

### Example

```js
var result = app.integrations.freshmarketer.list_users({})
```
---

## get_current_user

Get the currently authenticated user's profile.

### Parameters

None.

### Example

```js
var result = app.integrations.freshmarketer.get_current_user({})
var user = result.user
console.log("Logged in as: " + user.email)
```
---

## Multi-Account Usage

If you have multiple Freshmarketer accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.freshmarketer.list_campaigns({page: 1, limit: 20})

// Explicit default (portable across setups)
app.integrations.freshmarketer.default.list_campaigns({page: 1, limit: 20})

// Named accounts
app.integrations.freshmarketer.work.list_campaigns({page: 1, limit: 20})
app.integrations.freshmarketer.personal.list_campaigns({page: 1, limit: 20})
```
All functions are identical across accounts — only the credentials differ.
