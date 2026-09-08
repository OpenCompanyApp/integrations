# Accelo — Ruby API Reference

## list_tickets

List support issues, also known as tickets, in Accelo. Accelo's API resource for these records is `/api/v0/issues`.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of tickets per page (default: 25, max: 100) |
| `page` | integer | no | Page number for pagination (1-based) |
| `status` | string | no | Filter by standing (e.g. "open", "closed", "resolved") |

### Examples

```ruby
# List open tickets
result = app.integrations.accelo.list_issues(status: "open", limit: 10)
result.each do |ticket|
  puts((ticket.id).to_s + ": " + (ticket.title).to_s)
end
```
```ruby
# Paginate through all tickets
page1 = app.integrations.accelo.list_issues(limit: 50, page: 1)
page2 = app.integrations.accelo.list_issues(limit: 50, page: 2)
```
---

## get_ticket

Get details of a specific support issue, also known as a ticket.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Accelo ticket ID |

### Examples

```ruby
ticket = app.integrations.accelo.get_issue(id: 12345)
puts(ticket.title)
puts(ticket.body)
puts("Status: " + (ticket.status).to_s)
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

```ruby
# Create a basic ticket
ticket = app.integrations.accelo.create_issue(title: "Login issue", body: "User cannot log in to the portal after password reset.")
puts("Created ticket #" + (ticket.id).to_s)
```
```ruby
# Create a ticket with contract and priority
ticket = app.integrations.accelo.create_issue(title: "Feature request", body: "Customer requests SSO integration.", contract_id: 100, priority: 2)
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

```ruby
# List in-progress tasks
tasks = app.integrations.accelo.list_tasks(status: "in_progress", limit: 20)
tasks.each do |task|
  puts((task.id).to_s + ": " + (task.title).to_s + " [" + (task.status).to_s + "]")
end
```
---

## get_task

Get details of a specific task.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Accelo task ID |

### Examples

```ruby
task = app.integrations.accelo.get_task(id: 67890)
puts(task.title)
puts("Status: " + (task.status).to_s)
puts("Assignee: " + ((task.assignee || "unassigned")).to_s)
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

```ruby
# List all open projects
projects = app.integrations.accelo.list_jobs(status: "open")
projects.each do |project|
  puts((project.id).to_s + ": " + (project.title).to_s)
end
```
---

## get_current_user

Get token information for the current Accelo access token.

### Parameters

None.

### Examples

```ruby
user = app.integrations.accelo.get_token_info()
puts("Logged in as: " + (user.firstname).to_s + " " + (user.surname).to_s)
puts("Email: " + (user.email).to_s)
```
---

## Multi-Account Usage

If you have multiple Accelo deployments configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.accelo.list_issues()
# Explicit default (portable across setups)
app.integrations.accelo.default.list_issues()
# Named accounts
app.integrations.accelo.production.list_issues()
app.integrations.accelo.staging.list_issues()
```
All functions are identical across accounts — only the credentials differ.
