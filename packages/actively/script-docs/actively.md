# Actively CRM - JavaScript API Reference

## list_organizations

List organizations you have access to in Actively.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max organizations to return (default: 25) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```js
var result = app.integrations.actively.list_organizations({
  limit: 10,
  page: 1,
})

for (const org of (result.data)) {
  console.log(org.id + ": " + org.name)
}
```
---

## get_current_user

Get the authenticated user's profile from Actively.

### Parameters

None.

### Example

```js
var user = app.integrations.actively.get_current_user({})
console.log("Logged in as: " + user.name + " (" + user.email + ")")
```
---

## list_campaigns

List campaigns for an organization in Actively.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `org_id` | string | yes | The organization UUID |
| `limit` | integer | no | Max campaigns to return (default: 25) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```js
var result = app.integrations.actively.list_campaigns({
  org_id: "org_abc123",
  limit: 10,
  page: 1,
})

for (const campaign of (result.data)) {
  console.log(campaign.title + " (" + campaign.type + ") - " + campaign.status)
}
```
---

## get_campaign

Get details of a specific campaign in Actively.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `org_id` | string | yes | The organization UUID |
| `campaign_id` | string | yes | The campaign UUID |

### Example

```js
var campaign = app.integrations.actively.get_campaign({
  org_id: "org_abc123",
  campaign_id: "camp_xyz789",
})

console.log(campaign.title)
console.log("Type: " + campaign.type)
console.log("Period: " + campaign.start_date + " to " + campaign.end_date)
```
---

## create_campaign

Create a new campaign for an organization in Actively.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `org_id` | string | yes | The organization UUID |
| `title` | string | yes | The campaign title |
| `type` | string | yes | Campaign type (e.g., `"email"`, `"social"`, `"ads"`) |
| `start_date` | string | yes | Start date in ISO 8601 format (e.g., `"2026-01-01"`) |
| `end_date` | string | yes | End date in ISO 8601 format (e.g., `"2026-03-31"`) |

### Example

```js
var campaign = app.integrations.actively.create_campaign({
  org_id: "org_abc123",
  title: "Q1 Product Launch",
  type: "email",
  start_date: "2026-01-15",
  end_date: "2026-03-31",
})

console.log("Created campaign: " + campaign.id)
```
---

## list_contacts

List contacts for an organization in Actively.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `org_id` | string | yes | The organization UUID |
| `limit` | integer | no | Max contacts to return (default: 25) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```js
var result = app.integrations.actively.list_contacts({
  org_id: "org_abc123",
  limit: 50,
  page: 1,
})

for (const contact of (result.data)) {
  console.log(contact.name + " - " + contact.email)
}
```
---

## get_contact

Get details of a specific contact in Actively.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `org_id` | string | yes | The organization UUID |
| `contact_id` | string | yes | The contact UUID |

### Example

```js
var contact = app.integrations.actively.get_contact({
  org_id: "org_abc123",
  contact_id: "cont_def456",
})

console.log(contact.name)
console.log("Email: " + contact.email)
console.log("Phone: " + (contact.phone || "N/A"))
```
---

## Multi-Account Usage

If you have multiple Actively accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.actively.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.actively.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.actively.work.function_name({ /* parameters */ })
app.integrations.actively.personal.function_name({ /* parameters */ })
```
All functions are identical across accounts - only the credentials differ.
