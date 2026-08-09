# Outreach — JavaScript API Reference

## outreach_list_prospects

List prospects in Outreach with optional filtering, sorting, and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of prospects per page (default: 25, max: 100). |
| `page_number` | integer | no | Page number to retrieve (1-based). |
| `sort` | string | no | Sort field, prefix with `-` for descending (e.g., `"createdAt"`, `"-updatedAt"`). |
| `filter` | array | no | JSON:API filter parameters. |

### Example

```js
var result = app.integrations.outreach.list_prospects({
  page_size: 10,
  page_number: 1,
  sort: "-createdAt",
})

for (const prospect of (result.data)) {
  console.log(prospect.attributes.firstName + " " + prospect.attributes.lastName)
}
```
---

## outreach_get_prospect

Get a single prospect by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The prospect ID. |

### Example

```js
var result = app.integrations.outreach.get_prospect({ id: 12345 })
var attrs = result.data.attributes
console.log(attrs.firstName + " " + attrs.lastName)
console.log("Emails: " + attrs.emails || {}.join(", "))
```
---

## outreach_create_prospect

Create a new prospect in Outreach.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `first_name` | string | no | The prospect's first name. |
| `last_name` | string | no | The prospect's last name. |
| `emails` | array | no | Array of email addresses. |
| `company` | string | no | The prospect's company name. |

### Example

```js
var result = app.integrations.outreach.create_prospect({
  first_name: "Jane",
  last_name: "Doe",
  emails: [ "jane@example.com" ],
  company: "Acme Corp",
})

console.log("Created prospect ID: " + result.data.id)
```
---

## outreach_list_sequences

List sales sequences in Outreach.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of sequences per page (default: 25, max: 100). |
| `page_number` | integer | no | Page number to retrieve (1-based). |

### Example

```js
var result = app.integrations.outreach.list_sequences({
  page_size: 20,
  page_number: 1,
})

for (const seq of (result.data)) {
  console.log(seq.attributes.name)
}
```
---

## outreach_get_sequence

Get a single sequence by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The sequence ID. |

### Example

```js
var result = app.integrations.outreach.get_sequence({ id: 42 })
console.log("Sequence: " + result.data.attributes.name)
```
---

## outreach_list_accounts

List accounts (organizations) in Outreach.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of accounts per page (default: 25, max: 100). |
| `page_number` | integer | no | Page number to retrieve (1-based). |

### Example

```js
var result = app.integrations.outreach.list_accounts({
  page_size: 50,
})

for (const account of (result.data)) {
  console.log(account.attributes.name + " (" + (account.attributes.domain || "no domain") + ")")
}
```
---

## outreach_get_current_user

Get the currently authenticated Outreach user.

### Parameters

None.

### Example

```js
var result = app.integrations.outreach.get_current_user({})
var user = result.data.attributes
console.log("Logged in as: " + user.firstName + " " + user.lastName)
console.log("Email: " + (user.email || "N/A"))
```
---

## Multi-Account Usage

If you have multiple Outreach accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.outreach.list_prospects({ page_size: 10 })

// Explicit default (portable across setups)
app.integrations.outreach.default.list_prospects({ page_size: 10 })

// Named accounts
app.integrations.outreach.production.list_prospects({ page_size: 10 })
app.integrations.outreach.staging.list_prospects({ page_size: 10 })
```
All functions are identical across accounts — only the credentials differ.
