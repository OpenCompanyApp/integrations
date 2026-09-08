# Immigrant — Ruby API Reference

## list_applications

List immigration applications.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of applications per page (default: 25, max: 100) |
| `page` | integer | no | Page number for pagination (1-based) |
| `status` | string | no | Filter by status (e.g. "pending", "approved", "rejected") |

### Examples

```ruby
# List pending applications
result = app.integrations.immigrant.list_applications(status: "pending", limit: 10)
result.each do |app|
  puts((app.id).to_s + ": " + (app.applicant_name).to_s + " [" + (app.status).to_s + "]")
end
```
```ruby
# Paginate through all applications
page1 = app.integrations.immigrant.list_applications(limit: 50, page: 1)
page2 = app.integrations.immigrant.list_applications(limit: 50, page: 2)
```
---

## get_application

Get details of a specific immigration application.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Immigrant application ID |

### Examples

```ruby
application = app.integrations.immigrant.get_application(id: "app_abc123")
puts(application.applicant_name)
puts(application.type)
puts("Status: " + (application.status).to_s)
```
---

## create_application

Create a new immigration application.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type` | string | yes | Application type (e.g. "visa", "green_card", "citizenship") |
| `applicant_name` | string | yes | Full name of the applicant |
| `details` | object | no | Additional application details (key-value pairs) |

### Examples

```ruby
# Create a basic visa application
application = app.integrations.immigrant.create_application(type: "visa", applicant_name: "Jane Doe")
puts("Created application #" + (application.id).to_s)
```
```ruby
# Create an application with details
application = app.integrations.immigrant.create_application(type: "green_card", applicant_name: "John Smith", details: {country_of_origin: "Canada", current_visa_type: "H1B", employer: "Acme Corp"})
```
---

## list_documents

List documents for a specific immigration application.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `application_id` | string | yes | The Immigrant application ID |
| `limit` | integer | no | Number of documents per page (default: 25, max: 100) |
| `page` | integer | no | Page number for pagination (1-based) |

### Examples

```ruby
# List documents for an application
docs = app.integrations.immigrant.list_documents(application_id: "app_abc123", limit: 20)
docs.each do |doc|
  puts((doc.id).to_s + ": " + (doc.name).to_s + " (" + (doc.status).to_s + ")")
end
```
---

## get_document

Get details of a specific document.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Immigrant document ID |

### Examples

```ruby
doc = app.integrations.immigrant.get_document(id: "doc_xyz789")
puts(doc.name)
puts("Status: " + (doc.status).to_s)
puts("Uploaded: " + (doc.uploaded_at).to_s)
```
---

## list_statuses

List all available application statuses.

### Parameters

None.

### Examples

```ruby
statuses = app.integrations.immigrant.list_statuses()
statuses.each do |status|
  puts((status.id).to_s + ": " + (status.name).to_s + " - " + (status.description).to_s)
end
```
---

## get_current_user

Get the currently authenticated Immigrant user's profile.

### Parameters

None.

### Examples

```ruby
user = app.integrations.immigrant.get_current_user()
puts("Logged in as: " + (user.first_name).to_s + " " + (user.last_name).to_s)
puts("Email: " + (user.email).to_s)
```
---

## Multi-Account Usage

If you have multiple Immigrant accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.immigrant.list_applications()
# Explicit default (portable across setups)
app.integrations.immigrant.default.list_applications()
# Named accounts
app.integrations.immigrant.production.list_applications()
app.integrations.immigrant.staging.list_applications()
```
All functions are identical across accounts — only the credentials differ.
