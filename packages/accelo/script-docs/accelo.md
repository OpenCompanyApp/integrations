# Accelo — JavaScript API Reference

## list_tickets

List support issues, also known as tickets, in Accelo. Accelo's API resource for these records is `/api/v0/issues`.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of tickets per page (default: 25, max: 100) |
| `page` | integer | no | Page number for pagination (1-based) |
| `status` | string | no | Filter by standing (e.g. "open", "closed", "resolved") |

### Examples

```js
// List open tickets
var result = app.integrations.accelo.list_tickets({
  status: "open",
  limit: 10,
})

for (const ticket of (result)) {
  console.log(ticket.id + ": " + ticket.title)
}
```
```js
// Paginate through all tickets
var page1 = app.integrations.accelo.list_tickets({ limit: 50, page: 1 })
var page2 = app.integrations.accelo.list_tickets({ limit: 50, page: 2 })
```
---

## get_ticket

Get details of a specific support issue, also known as a ticket.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Accelo ticket ID |

### Examples

```js
var ticket = app.integrations.accelo.get_ticket({ id: 12345 })
console.log(ticket.title)
console.log(ticket.body)
console.log("Status: " + ticket.status)
```
---

## create_ticket

Create a new support issue, also known as a ticket.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `title` | string | yes | Ticket title or subject |
| `body` | string | yes | Ticket description |
| `contract_id` | integer | no | Contract ID to associate |
| `priority` | integer | no | Issue priority ID |

### Examples

```js
// Create a basic ticket
var ticket = app.integrations.accelo.create_ticket({
  title: "Login issue",
  body: "User cannot log in to the portal after password reset.",
})

console.log("Created ticket #" + ticket.id)
```
```js
// Create a ticket with contract and priority
var ticket = app.integrations.accelo.create_ticket({
  title: "Feature request",
  body: "Customer requests SSO integration.",
  contract_id: 100,
  priority: 2,
})
```
---

## list_tasks

List tasks in Accelo.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of tasks per page (default: 25, max: 100) |
| `page` | integer | no | Page number for pagination (1-based) |
| `status` | string | no | Filter by standing (e.g. "active", "inactive", "completed") |

### Examples

```js
// List in-progress tasks
var tasks = app.integrations.accelo.list_tasks({
  status: "in_progress",
  limit: 20,
})

for (const task of (tasks)) {
  console.log(task.id + ": " + task.title + " [" + task.status + "]")
}
```
---

## get_task

Get details of a specific task.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Accelo task ID |

### Examples

```js
var task = app.integrations.accelo.get_task({ id: 67890 })
console.log(task.title)
console.log("Status: " + task.status)
console.log("Assignee: " + (task.assignee || "unassigned"))
```
---

## list_projects

List projects in Accelo. Accelo's API resource for these records is `/api/v0/jobs`.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of projects per page (default: 25, max: 100) |
| `page` | integer | no | Page number for pagination (1-based) |
| `status` | string | no | Filter by standing (e.g. "active", "inactive", "completed") |

### Examples

```js
// List all open projects
var projects = app.integrations.accelo.list_projects({
  status: "open",
})

for (const project of (projects)) {
  console.log(project.id + ": " + project.title)
}
```
---

## get_current_user

Get token information for the current Accelo access token.

### Parameters

None.

### Examples

```js
var user = app.integrations.accelo.get_current_user({})
console.log("Logged in as: " + user.firstname + " " + user.surname)
console.log("Email: " + user.email)
```
---

## Multi-Account Usage

If you have multiple Accelo deployments configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.accelo.list_tickets({})

// Explicit default (portable across setups)
app.integrations.accelo.default.list_tickets({})

// Named accounts
app.integrations.accelo.production.list_tickets({})
app.integrations.accelo.staging.list_tickets({})
```
All functions are identical across accounts — only the credentials differ.
