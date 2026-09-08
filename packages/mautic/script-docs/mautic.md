# Mautic — Ruby API Reference

## list_contacts

List contacts in Mautic with optional search, filtering, and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `search` | string | no | Search query (e.g. `"email:john@example.com"` or a name) |
| `limit` | integer | no | Maximum contacts to return (default: 30, max: 100) |
| `start` | integer | no | Offset for pagination (default: 0) |
| `orderBy` | string | no | Field to sort by (e.g. `"email"`, `"firstName"`, `"id"`) |
| `orderByDir` | string | no | Sort direction: `"asc"` or `"desc"` |

### Example

```ruby
result = app.integrations.mautic.list_contacts(search: "example.com", limit: 10)
result.contacts.each do |contact|
  puts((contact.email).to_s + " - " + ((contact.firstname || "")).to_s + " " + ((contact.lastname || "")).to_s)
end
```
---

## get_contact

Get a single contact by ID, including all fields and tags.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Mautic contact ID |

### Example

```ruby
result = app.integrations.mautic.get_contact(id: 42)
puts("Email: " + (result.email).to_s)
puts("Name: " + ((result.firstname || "")).to_s + " " + ((result.lastname || "")).to_s)
```
---

## create_contact

Create a new contact in Mautic.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | Email address |
| `firstname` | string | no | First name |
| `lastname` | string | no | Last name |
| `phone` | string | no | Phone number |
| `company` | string | no | Company name |
| `position` | string | no | Job title |
| `tags` | array | no | Tags to assign (e.g. `{"lead", "newsletter"}`) |
| `owner` | integer | no | User ID of the contact owner |

Additional custom fields can be passed as extra parameters.

### Example

```ruby
result = app.integrations.mautic.create_contact(email: "john@example.com", firstname: "John", lastname: "Doe", company: "Acme Corp", tags: ["lead", "website-signup"])
puts("Created contact ID: " + (result.contact.id).to_s)
```
---

## update_contact

Update an existing contact in Mautic.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The contact ID to update |
| `email` | string | no | Updated email address |
| `firstname` | string | no | Updated first name |
| `lastname` | string | no | Updated last name |
| `phone` | string | no | Updated phone number |
| `company` | string | no | Updated company name |
| `position` | string | no | Updated job title |
| `tags` | array | no | Tags to set (e.g. `{"customer"}`) |
| `owner` | integer | no | User ID of the contact owner |

Additional custom fields can be passed as extra parameters.

### Example

```ruby
result = app.integrations.mautic.update_contact(id: 42, firstname: "Jane", company: "New Corp", tags: ["customer", "vip"])
puts("Updated contact: " + (result.contact.email).to_s)
```
---

## delete_contact

Delete a contact from Mautic by ID. This action is permanent.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The contact ID to delete |

### Example

```ruby
result = app.integrations.mautic.delete_contact(id: 42)
puts(result)
```
---

## list_emails

List marketing emails from Mautic.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `search` | string | no | Search query to filter emails |
| `limit` | integer | no | Maximum emails to return (default: 30) |
| `start` | integer | no | Offset for pagination (default: 0) |
| `orderBy` | string | no | Field to sort by (e.g. `"subject"`, `"id"`) |
| `orderByDir` | string | no | Sort direction: `"asc"` or `"desc"` |

### Example

```ruby
result = app.integrations.mautic.list_emails(limit: 10)
result.emails.each do |email|
  puts((email.name).to_s + " - " + ((email.subject || "no subject")).to_s)
end
```
---

## list_segments

List contact segments (lists) from Mautic.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `search` | string | no | Search query to filter segments |
| `limit` | integer | no | Maximum segments to return (default: 30) |
| `start` | integer | no | Offset for pagination (default: 0) |
| `orderBy` | string | no | Field to sort by (e.g. `"name"`, `"id"`) |
| `orderByDir` | string | no | Sort direction: `"asc"` or `"desc"` |

### Example

```ruby
result = app.integrations.mautic.list_segments()
result.segments.each do |segment|
  puts((segment.name).to_s + " (" + ((segment.alias || "")).to_s + ") - " + ((segment.contactCount || 0)).to_s + " contacts")
end
```
---

## list_forms

List forms from Mautic.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `search` | string | no | Search query to filter forms |
| `limit` | integer | no | Maximum forms to return (default: 30) |
| `start` | integer | no | Offset for pagination (default: 0) |
| `orderBy` | string | no | Field to sort by (e.g. `"name"`, `"id"`) |
| `orderByDir` | string | no | Sort direction: `"asc"` or `"desc"` |

### Example

```ruby
result = app.integrations.mautic.list_forms()
result.forms.each do |form|
  puts((form.name).to_s + " - " + ((form.submissionCount || 0)).to_s + " submissions")
end
```
---

## get_current_user

Get the currently authenticated Mautic user. Useful to verify credentials.

### Parameters

None.

### Example

```ruby
result = app.integrations.mautic.get_current_user()
puts("Authenticated as: " + (result.username).to_s + " (" + ((result.email || "")).to_s + ")")
```
---

## Multi-Account Usage

If you have multiple Mautic instances configured, use account-specific namespaces:

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
