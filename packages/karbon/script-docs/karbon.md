# Karbon — Ruby API Reference

## list_contacts

List contacts in Karbon with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `limit` | integer | no | Results per page (default: 20, max: 100) |

### Example

```ruby
result = app.integrations.karbon.list_contacts(page: 1, limit: 20)
result.each do |contact|
  puts((contact.firstName).to_s + " " + (contact.lastName).to_s)
end
```
---

## get_contact

Get a single contact by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The unique contact identifier |

### Example

```ruby
contact = app.integrations.karbon.get_contact(id: "contact-123")
puts((contact.firstName).to_s + " " + (contact.lastName).to_s)
puts(contact.email)
puts(contact.company)
```
---

## create_contact

Create a new contact in Karbon.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `firstName` | string | yes | First name |
| `lastName` | string | yes | Last name |
| `email` | string | no | Email address |
| `company` | string | no | Company or organization name |
| `phone` | string | no | Phone number |

### Example

```ruby
contact = app.integrations.karbon.create_contact(first_name: "Jane", last_name: "Doe", email: "jane@example.com", company: "Acme Corp", phone: "+1234567890")
puts("Created contact: " + (contact.id).to_s)
```
---

## list_work_items

List work items with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `limit` | integer | no | Results per page (default: 20, max: 100) |
| `status` | string | no | Filter by status (e.g., "Open", "InProgress", "Completed") |
| `assignee` | string | no | Filter by assignee email or ID |

### Example

```ruby
# List open work items
result = app.integrations.karbon.list_work_items(status: "Open", limit: 50)
result.each do |item|
  puts((item.title).to_s + " - " + (item.status).to_s)
end
# List work items assigned to a specific user
assigned = app.integrations.karbon.list_work_items(assignee: "user@example.com", page: 1)
```
---

## get_work_item

Get a single work item by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The unique work item identifier |

### Example

```ruby
item = app.integrations.karbon.get_work_item(id: "work-item-456")
puts(item.title)
puts(item.status)
puts(item.dueDate)
```
---

## list_users

List users in the Karbon account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of users to return (default: 20) |

### Example

```ruby
users = app.integrations.karbon.list_users(limit: 50)
users.each do |user|
  puts((user.firstName).to_s + " " + (user.lastName).to_s + " - " + (user.email).to_s)
end
```
---

## get_current_user

Get the currently authenticated user.

### Parameters

None.

### Example

```ruby
me = app.integrations.karbon.get_current_user()
puts("Logged in as: " + (me.firstName).to_s + " " + (me.lastName).to_s)
puts("Email: " + (me.email).to_s)
```
---

## Multi-Account Usage

If you have multiple Karbon accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
# Discover the exact function and required parameters with code_read_doc.
# Explicit default (portable across setups)
# Discover the exact function and required parameters with code_read_doc.
# Named accounts
# Discover the exact function and required parameters with code_read_doc.
# Discover the exact function and required parameters with code_read_doc.
```
All functions are identical across accounts — only the credentials differ.
