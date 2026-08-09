# Lasso CRM — JavaScript API Reference

## list_contacts

List contacts (registrants) in Lasso CRM. Supports filtering by project and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | no | Filter contacts by project ID |
| `limit` | integer | no | Max results (default: 25) |
| `page` | integer | no | Page number for pagination |

### Example

```js
var result = app.integrations.lasso.list_contacts({
  project_id: "proj_abc123",
  limit: 10,
})

for (const contact of (result.contacts)) {
  console.log(contact.id + ": " + (contact.first_name || "") + " " + (contact.last_name || ""))
}
```
---

## get_contact

Get full details for a single contact by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The contact ID |

### Example

```js
var contact = app.integrations.lasso.get_contact({
  id: "contact_abc123",
})

console.log(contact.first_name + " " + contact.last_name)
console.log("Email: " + (contact.email || "N/A"))
console.log("Phone: " + (contact.phone || "N/A"))
```
---

## create_contact

Create a new contact (registrant) in Lasso CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `first_name` | string | no | Contact first name |
| `last_name` | string | no | Contact last name |
| `email` | string | no | Primary email address |
| `phone` | string | no | Primary phone number |
| `project_id` | string | no | Project ID to associate with |
| `source` | string | no | Lead source (e.g., "Website", "Referral") |
| `notes` | string | no | Notes about the contact |

At least a `first_name` or `last_name` is required.

### Example

```js
var contact = app.integrations.lasso.create_contact({
  first_name: "Jane",
  last_name: "Smith",
  email: "jane@example.com",
  phone: "+1234567890",
  project_id: "proj_abc123",
  source: "Website",
})

console.log("Created contact: " + contact.id)
```
---

## list_deals

List deals (sales) in Lasso CRM with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | no | Filter deals by project ID |
| `status` | string | no | Filter by deal status |
| `limit` | integer | no | Max results (default: 25) |
| `page` | integer | no | Page number for pagination |

### Example

```js
var result = app.integrations.lasso.list_deals({
  project_id: "proj_abc123",
  status: "Active",
  limit: 10,
})

for (const deal of (result.deals)) {
  console.log(deal.id + ": " + (deal.name || deal.id))
}
```
---

## get_deal

Get full details for a single deal by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The deal ID |

### Example

```js
var deal = app.integrations.lasso.get_deal({
  id: "deal_abc123",
})

console.log("Deal: " + (deal.name || deal.id))
console.log("Price: " + (deal.price || "N/A"))
console.log("Status: " + (deal.status || "N/A"))
```
---

## list_inventory

List available inventory (units/lots) in Lasso CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | no | Filter inventory by project ID |
| `status` | string | no | Filter by status (e.g., "Available", "Sold", "Reserved") |
| `limit` | integer | no | Max results (default: 25) |
| `page` | integer | no | Page number for pagination |

### Example

```js
var result = app.integrations.lasso.list_inventory({
  project_id: "proj_abc123",
  status: "Available",
  limit: 10,
})

for (const item of (result.inventory)) {
  console.log(item.id + ": " + (item.name || item.unit_number || item.id))
}
```
---

## get_current_user

Get the authenticated user's profile.

### Parameters

None.

### Example

```js
var user = app.integrations.lasso.get_current_user({})

console.log("Logged in as: " + (user.first_name || "") + " " + (user.last_name || ""))
console.log("Email: " + (user.email || "N/A"))

if (user.organization) {
  console.log("Organization: " + (user.organization.name || "N/A"))
}
```
---

## Multi-Account Usage

If you have multiple Lasso CRM accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.lasso.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.lasso.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.lasso.downtown_project.function_name({ /* parameters */ })
app.integrations.lasso.suburb_project.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
