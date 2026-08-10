# Hunter.io — JavaScript API Reference

## domain_search

Search for professional email addresses associated with a domain.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `domain` | string | yes | The domain to search (e.g., `"example.com"`) |
| `limit` | integer | no | Maximum number of results (default: 10, max: 100) |
| `offset` | integer | no | Number of results to skip for pagination |
| `type` | string | no | Filter by email type: `"personal"` or `"generic"` |

### Example

```js
var result = app.integrations.hunter.domain_search({
  domain: "example.com",
  limit: 20,
})

for (const email of (result.data.emails)) {
  console.log(email.value + " - " + (email.first_name || "") + " " + (email.last_name || ""))
}
```
---

## email_finder

Find the most likely email address for a person based on their name and company domain.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `domain` | string | yes | The company domain (e.g., `"example.com"`) |
| `first_name` | string | no | The person's first name |
| `last_name` | string | no | The person's last name |

### Example

```js
var result = app.integrations.hunter.email_finder({
  domain: "example.com",
  first_name: "John",
  last_name: "Doe",
})

console.log("Email: " + result.data.email)
console.log("Confidence: " + result.data.score + "%")
```
---

## email_verifier

Verify the deliverability of an email address.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | The email address to verify |

### Example

```js
var result = app.integrations.hunter.email_verifier({
  email: "john@example.com",
})

console.log("Result: " + result.data.result) // deliverable, undeliverable, risky, unknown
console.log("Confidence: " + result.data.score + "%")
```
---

## email_count

Get the number of email addresses found for a domain. This endpoint does not consume API credits.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `domain` | string | yes | The domain to count emails for |

### Example

```js
var result = app.integrations.hunter.email_count({
  domain: "example.com",
})

console.log("Total emails: " + result.data.total)
console.log("Personal: " + result.data.personal)
console.log("Generic: " + result.data.generic)
```
---

## list_leads

List leads stored in your Hunter.io account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of leads to return (default: 20, max: 100) |
| `offset` | integer | no | Number of leads to skip for pagination |

### Example

```js
var result = app.integrations.hunter.list_leads({
  limit: 50,
  offset: 0,
})

for (const lead of (result.data.leads)) {
  console.log(lead.id + ": " + lead.email + " - " + (lead.first_name || "") + " " + (lead.last_name || ""))
}
```
---

## get_lead

Retrieve a single lead by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The lead ID |

### Example

```js
var result = app.integrations.hunter.get_lead({
  id: 12345,
})

console.log("Email: " + result.data.email)
console.log("Name: " + (result.data.first_name || "") + " " + (result.data.last_name || ""))
```
---

## create_lead

Create a new lead in Hunter.io.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | The lead's email address |
| `first_name` | string | no | The lead's first name |
| `last_name` | string | no | The lead's last name |
| `list_id` | integer | no | ID of the lead list to add this lead to |

### Example

```js
var result = app.integrations.hunter.create_lead({
  email: "john@example.com",
  first_name: "John",
  last_name: "Doe",
  list_id: 42,
})

console.log("Created lead: " + result.data.id)
```
---

## get_current_user

Get account information and API usage for the authenticated Hunter.io user.

### Parameters

None.

### Example

```js
var result = app.integrations.hunter.get_current_user({})

console.log("Account: " + result.data.email)
console.log("Plan: " + result.data.plan_name)
console.log("Requests used: " + result.data.usage.requests.used + " / " + result.data.usage.requests.limit)
```
---

## Multi-Account Usage

If you have multiple Hunter.io accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.hunter.domain_search({domain: "example.com"})

// Explicit default (portable across setups)
app.integrations.hunter.default.domain_search({domain: "example.com"})

// Named accounts
app.integrations.hunter.work.domain_search({domain: "example.com"})
app.integrations.hunter.personal.domain_search({domain: "example.com"})
```
All functions are identical across accounts — only the credentials differ.
