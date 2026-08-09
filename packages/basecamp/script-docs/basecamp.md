# Basecamp 3 — JavaScript API Reference

## list_projects

List all Basecamp projects visible to the authenticated user.

### Parameters

*None required.*

### Example

```js
var result = app.integrations.basecamp.list_projects({})

for (const project of (result)) {
  console.log(project.id + ": " + project.name)
}
```
---

## get_project

Get details for a single Basecamp project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | integer | yes | The Basecamp project ID |

### Example

```js
var result = app.integrations.basecamp.get_project({
  project_id: 12345,
})

console.log("Project: " + result.name)
console.log("Description: " + (result.description || "none"))
```
---

## list_todos

List to-dos in a specific Basecamp to-do list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | integer | yes | The Basecamp project ID |
| `todoset_id` | integer | yes | The to-do set (bucket) ID within the project |
| `todolist_id` | integer | yes | The specific to-do list ID |

### Example

```js
var result = app.integrations.basecamp.list_todos({
  project_id: 12345,
  todoset_id: 67890,
  todolist_id: 11111,
})

for (const todo of (result)) {
  console.log(todo.content + (todo.completed && " ✓" || " ○"))
}
```
---

## create_todo

Create a new to-do in a Basecamp to-do list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | integer | yes | The Basecamp project ID |
| `todoset_id` | integer | yes | The to-do set (bucket) ID within the project |
| `todolist_id` | integer | yes | The specific to-do list ID |
| `content` | string | yes | The to-do text |
| `description` | string | no | Extended description (HTML supported) |
| `due_on` | string | no | Due date in ISO 8601 format (e.g., "2026-04-30") |
| `assignee_ids` | array | no | List of person IDs to assign (e.g., {1234, 5678}) |

### Example

```js
var result = app.integrations.basecamp.create_todo({
  project_id: 12345,
  todoset_id: 67890,
  todolist_id: 11111,
  content: "Review the latest pull request",
  description: "Check PR #42 for the auth module changes",
  due_on: "2026-04-30",
})

console.log("Created to-do: " + result.content)
```
---

## list_messages

List messages (message board posts) for a Basecamp project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | integer | yes | The Basecamp project ID |

### Example

```js
var result = app.integrations.basecamp.list_messages({
  project_id: 12345,
})

for (const msg of (result)) {
  console.log(msg.subject + " by " + (msg.creator.name || "unknown"))
}
```
---

## get_message

Get a single message from a Basecamp project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | integer | yes | The Basecamp project ID |
| `message_id` | integer | yes | The message (board post) ID |

### Example

```js
var result = app.integrations.basecamp.get_message({
  project_id: 12345,
  message_id: 99999,
})

console.log("Subject: " + result.subject)
console.log("By: " + result.creator.name)
```
---

## get_current_user

Get the profile of the currently authenticated Basecamp user.

### Parameters

*None required.*

### Example

```js
var result = app.integrations.basecamp.get_current_user({})

console.log("Logged in as: " + result.first_name + " " + result.last_name)
console.log("Email: " + result.email_address)
```
---

## Multi-Account Usage

If you have multiple Basecamp accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.basecamp.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.basecamp.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.basecamp.work.function_name({ /* parameters */ })
app.integrations.basecamp.client.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
