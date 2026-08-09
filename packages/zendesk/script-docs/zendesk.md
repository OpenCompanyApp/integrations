# Client for the Zendesk REST API covering tickets, users, and organizations — JavaScript API Reference

## zendesk_list_tickets

List Zendesk tickets with pagination and filtering.
Returns ticket IDs, subjects, status, priority, and created dates.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Number of tickets per page (default 25, max 100). |
| `page` | integer | no | Page number for pagination (1-indexed). |
| `sort_by` | string | no | Field to sort by (e.g. "created_at", "updated_at", "priority"). |
| `sort_order` | string | no | Sort order: "asc" or "desc". |
| `status` | string | no | Filter by ticket status: "new", "open", "pending", "hold", "solved", "closed". |

### Example

```js
var result = app.integrations.zendesk.zendesk_list_tickets({
  per_page: 25,
  page: 1,
  status: "open",
})
```
## zendesk_get_ticket

Retrieve a Zendesk ticket by its ID.
Returns the full ticket including subject, description, status, priority, and metadata.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `ticket_id` | string | yes | Zendesk ticket ID. |

### Example

```js
var result = app.integrations.zendesk.zendesk_get_ticket({
  ticket_id: "12345",
})
```
## zendesk_create_ticket

Create a new ticket in Zendesk.
Requires a subject and description. Optionally set priority, type, status, and assignee.
Returns the created ticket with its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subject` | string | yes | Subject of the ticket. |
| `description` | string | yes | Initial description/body of the ticket. |
| `priority` | string | no | Ticket priority: "urgent", "high", "normal", "low". |
| `type` | string | no | Ticket type: "problem", "incident", "question", "task". |
| `status` | string | no | Initial status: "new", "open", "pending", "hold" (default: "new"). |
| `assignee_id` | string | no | ID of the agent to assign the ticket to. |
| `tags` | array | no | Array of tags to apply to the ticket. |

### Example

```js
var result = app.integrations.zendesk.zendesk_create_ticket({
  subject: "Login issue",
  description: "User cannot log in to the application.",
  priority: "high",
  type: "incident",
})
```
## zendesk_list_users

List Zendesk users with pagination and filtering.
Returns user IDs, names, emails, and roles.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Number of users per page (default 100, max 100). |
| `page` | integer | no | Page number for pagination (1-indexed). |
| `role` | string | no | Filter by role: "end-user", "agent", "admin". |
| `sort_by` | string | no | Field to sort by (e.g. "name", "created_at"). |
| `sort_order` | string | no | Sort order: "asc" or "desc". |

### Example

```js
var result = app.integrations.zendesk.zendesk_list_users({
  per_page: 50,
  role: "agent",
})
```
## zendesk_get_user

Retrieve a Zendesk user by its ID.
Returns the user's ID, name, email, role, and profile details.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user_id` | string | yes | Zendesk user ID. |

### Example

```js
var result = app.integrations.zendesk.zendesk_get_user({
  user_id: "98765",
})
```
## zendesk_list_organizations

List Zendesk organizations with pagination.
Returns organization IDs, names, and created dates.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Number of organizations per page (default 100, max 100). |
| `page` | integer | no | Page number for pagination (1-indexed). |

### Example

```js
var result = app.integrations.zendesk.zendesk_list_organizations({
  per_page: 50,
})
```
## zendesk_get_current_user

Retrieve the currently authenticated Zendesk user.
Returns the user's ID, name, email, role, and avatar.
Useful for identifying which account or token is in use.

### Example

```js
var result = app.integrations.zendesk.zendesk_get_current_user({
})
```
---

## Multi-Account Usage

If you have multiple zendesk accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.zendesk.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.zendesk.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.zendesk.work.function_name({ /* parameters */ })
app.integrations.zendesk.personal.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
