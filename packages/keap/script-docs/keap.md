# Keap CRM — Ruby API Reference

## list_contacts

List contacts from Keap CRM with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `limit` | integer | no | Results per page (default: 20, max: 200) |

### Example

```ruby
result = app.integrations.keap.list_contacts(page: 1, limit: 20)
result.contacts.each do |contact|
  puts((contact.given_name).to_s + " " + (contact.family_name).to_s)
end
```
---

## get_contact

Retrieve a single contact by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Keap contact ID |

### Example

```ruby
result = app.integrations.keap.get_contact(id: 12345)
puts((result.given_name).to_s + " " + (result.family_name).to_s)
```
---

## create_contact

Create a new contact in Keap CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `first_name` | string | no | First name |
| `last_name` | string | no | Last name |
| `email` | string | no | Primary email address |
| `company_name` | string | no | Company name |

At least one field is required.

### Example

```ruby
result = app.integrations.keap.create_contact(first_name: "Jane", last_name: "Doe", email: "jane@example.com", company_name: "Acme Corp")
puts("Created contact ID: " + (result.id).to_s)
```
---

## list_opportunities

List sales opportunities with optional stage filter.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `limit` | integer | no | Results per page (default: 20, max: 200) |
| `stage` | string | no | Filter by stage (e.g., "New", "Appointment Scheduled", "Closed Won", "Closed Lost") |

### Example

```ruby
result = app.integrations.keap.list_opportunities(page: 1, limit: 20, stage: "New")
result.opportunities.each do |opp|
  puts((opp.title).to_s + " — $" + (opp.value).to_s)
end
```
---

## get_opportunity

Retrieve a single opportunity by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Keap opportunity ID |

### Example

```ruby
result = app.integrations.keap.get_opportunity(id: 67890)
puts((result.title).to_s + " — Stage: " + (result.stage).to_s)
```
---

## list_tags

List all tags in Keap.

### Parameters

None.

### Example

```ruby
result = app.integrations.keap.list_tags()
result.tags.each do |tag|
  puts((tag.id).to_s + ": " + (tag.name).to_s)
end
```
---

## get_current_user

Get the currently authenticated Keap user.

### Parameters

None.

### Example

```ruby
result = app.integrations.keap.get_current_user()
puts("Connected as: " + (result.first_name).to_s + " " + (result.last_name).to_s)
```
---

## Multi-Account Usage

If you have multiple Keap accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.keap.list_contacts(page: 1)
# Explicit default (portable across setups)
app.integrations.keap.default.list_contacts(page: 1)
# Named accounts
app.integrations.keap.production.list_contacts(page: 1)
app.integrations.keap.staging.list_contacts(page: 1)
```
All functions are identical across accounts — only the credentials differ.
