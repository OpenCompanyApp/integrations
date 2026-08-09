# Wealthbox CRM — JavaScript API Reference

## list_contacts

List contacts from Wealthbox CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of contacts per page (default: 25, max: 200) |
| `search` | string | no | Search term to filter contacts by name or email |

### Examples

```js
// List all contacts
var result = app.integrations.wealthbox.list_contacts({})

for (const contact of (result.contacts)) {
  console.log(contact.first_name + " " + contact.last_name)
}
```
```js
// Search for a contact
var result = app.integrations.wealthbox.list_contacts({
  search: "John",
})
```
```js
// Paginate through contacts
var result = app.integrations.wealthbox.list_contacts({
  page: 2,
  per_page: 50,
})
```
---

## get_contact

Get a specific contact by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The contact ID in Wealthbox |

### Examples

```js
var result = app.integrations.wealthbox.get_contact({
  id: 12345,
})

console.log(result.first_name + " " + result.last_name)
console.log("Email: " + (result.email || "N/A"))
```
---

## create_contact

Create a new contact in Wealthbox CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `first_name` | string | no* | Contact's first name |
| `last_name` | string | no* | Contact's last name |
| `email` | string | no | Contact's email address |
| `phone` | string | no | Contact's phone number |
| `street` | string | no | Street address |
| `city` | string | no | City |
| `state` | string | no | State or province |
| `zip` | string | no | ZIP or postal code |
| `type` | string | no | Contact type (e.g., "Client", "Prospect", "Lead") |
| `tags` | array | no | Tags to assign to the contact |

*At least `first_name` or `last_name` is required.

### Examples

```js
// Create a basic contact
var result = app.integrations.wealthbox.create_contact({
  first_name: "Jane",
  last_name: "Smith",
  email: "jane@example.com",
})

console.log("Created contact ID: " + result.id)
```
```js
// Create a contact with full details
var result = app.integrations.wealthbox.create_contact({
  first_name: "Jane",
  last_name: "Smith",
  email: "jane@example.com",
  phone: "+1-555-0123",
  street: "123 Main St",
  city: "New York",
  state: "NY",
  zip: "10001",
  type: "Client",
  tags: ["VIP", "Referral"],
})
```
---

## list_tasks

List tasks from Wealthbox CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of tasks per page (default: 25, max: 200) |
| `status` | string | no | Filter by task status (e.g., "open", "completed") |

### Examples

```js
// List open tasks
var result = app.integrations.wealthbox.list_tasks({
  status: "open",
})

for (const task of (result.tasks)) {
  console.log(task.name + " — Due: " + (task.due_date || "No date"))
}
```
---

## create_task

Create a new task in Wealthbox CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The task name or title |
| `due_date` | string | no | Due date (ISO 8601, e.g., "2026-04-15") |
| `description` | string | no | Task description or notes |
| `assignee_id` | integer | no | User ID of the assignee |
| `contact_id` | integer | no | Link the task to a contact by their ID |
| `priority` | string | no | Task priority (e.g., "high", "medium", "low") |

### Examples

```js
// Create a follow-up task
var result = app.integrations.wealthbox.create_task({
  name: "Follow up with Jane Smith",
  due_date: "2026-04-15",
  description: "Discuss portfolio rebalancing",
  contact_id: 12345,
  priority: "high",
})

console.log("Created task ID: " + result.id)
```
---

## list_opportunities

List opportunities (sales pipeline) from Wealthbox CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of opportunities per page (default: 25, max: 200) |
| `status` | string | no | Filter by opportunity status (e.g., "open", "won", "lost") |

### Examples

```js
// List open opportunities
var result = app.integrations.wealthbox.list_opportunities({
  status: "open",
})

for (const opp of (result.opportunities)) {
  console.log(opp.name + " — Value: $" + (opp.value || "0"))
}
```
---

## list_workflows

List workflows from Wealthbox CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of workflows per page (default: 25, max: 200) |

### Examples

```js
var result = app.integrations.wealthbox.list_workflows({})

for (const workflow of (result.workflows)) {
  console.log(workflow.name + " — Status: " + workflow.status)
}
```
---

## list_events

List calendar events from Wealthbox CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of events per page (default: 25, max: 200) |
| `start_date` | string | no | Filter events starting from this date (ISO 8601) |
| `end_date` | string | no | Filter events up to this date (ISO 8601) |

### Examples

```js
// List upcoming events for April 2026
var result = app.integrations.wealthbox.list_events({
  start_date: "2026-04-01",
  end_date: "2026-04-30",
})

for (const event of (result.events)) {
  console.log(event.title + " — " + event.starts_at)
}
```
---

## get_current_user

Get the currently authenticated Wealthbox user.

### Parameters

None.

### Examples

```js
var result = app.integrations.wealthbox.get_current_user({})

console.log("Logged in as: " + result.first_name + " " + result.last_name)
console.log("Email: " + result.email)
```
---

## Multi-Account Usage

If you have multiple Wealthbox accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.wealthbox.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.wealthbox.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.wealthbox.personal.function_name({ /* parameters */ })
app.integrations.wealthbox.firm.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
