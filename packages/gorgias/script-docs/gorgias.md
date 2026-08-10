# Gorgias — JavaScript API Reference

## list_tickets

List and search support tickets in Gorgias.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (1-based) |
| `limit` | integer | no | Results per page (max 100) |
| `status` | string | no | Filter by status: `open`, `closed`, `spam` |
| `q` | string | no | Search query (subject, content, customer) |

### Examples

```js
// List open tickets
var result = app.integrations.gorgias.list_tickets({
  status: "open",
  limit: 10,
})

// Search tickets
var result = app.integrations.gorgias.list_tickets({
  q: "billing",
  limit: 5,
})

// Paginate through all tickets
var result = app.integrations.gorgias.list_tickets({
  page: 2,
  limit: 50,
})
```
---

## get_ticket

Get details of a specific ticket.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Ticket ID |

### Example

```js
var result = app.integrations.gorgias.get_ticket({
  id: "12345",
})
console.log(result.subject)
console.log(result.status)
```
---

## create_ticket

Create a new support ticket.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subject` | string | yes | Ticket subject line |
| `body` | string | yes | Ticket body / message content (HTML supported) |
| `from_email` | string | no | Sender email address |
| `to_email` | string | no | Recipient email address |
| `channel` | string | no | Ticket channel: `email`, `chat`, `facebook`, `instagram` |
| `priority` | string | no | Ticket priority: `normal`, `urgent`, `high`, `low` |

### Example

```js
var result = app.integrations.gorgias.create_ticket({
  subject: "Order !received",
  body: "<p>Customer reports order #5678 was never delivered.</p>",
  from_email: "customer@example.com",
  to_email: "support@myshop.com",
  channel: "email",
  priority: "high",
})
console.log("Created ticket: " + result.id)
```
---

## list_customers

List and search customers in Gorgias.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (1-based) |
| `limit` | integer | no | Results per page (max 100) |
| `q` | string | no | Search query (name, email, etc.) |

### Examples

```js
// Search customers
var result = app.integrations.gorgias.list_customers({
  q: "john",
  limit: 10,
})

// List all customers (paginated)
var result = app.integrations.gorgias.list_customers({
  page: 1,
  limit: 100,
})
```
---

## get_customer

Get details of a specific customer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Customer ID |

### Example

```js
var result = app.integrations.gorgias.get_customer({
  id: "67890",
})
console.log(result.name)
console.log(result.email)
```
---

## list_satisfaction_surveys

List satisfaction survey responses.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (1-based) |
| `limit` | integer | no | Results per page (max 100) |
| `ticket_id` | string | no | Filter surveys by ticket ID |

### Examples

```js
// List all survey responses
var result = app.integrations.gorgias.list_satisfaction_surveys({
  limit: 20,
})

// Surveys for a specific ticket
var result = app.integrations.gorgias.list_satisfaction_surveys({
  ticket_id: "12345",
})
```
---

## get_current_user

Get the authenticated user's profile.

### Parameters

None.

### Example

```js
var result = app.integrations.gorgias.get_current_user({})
console.log(result.firstname + " " + result.lastname)
console.log(result.email)
```
---

## Multi-Account Usage

If you have multiple Gorgias accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.gorgias.list_tickets({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.gorgias.default.list_tickets({ /* parameters */ })

// Named accounts
app.integrations.gorgias.support.list_tickets({ /* parameters */ })
app.integrations.gorgias.sales.list_tickets({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
