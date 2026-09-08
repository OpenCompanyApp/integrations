# Firebase — Ruby API Reference

## list_projects

List all Firebase projects the caller has access to.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Maximum number of projects to return (default: 100, max: 256) |
| `page_token` | string | no | Token for pagination from a previous list call |

### Example

```ruby
result = app.integrations.firebase.list_projects(page_size: 50)
(result.results || []).each do |project|
  puts((project.projectId).to_s + ": " + (project.displayName).to_s)
end
```
---

## get_project

Get details of a specific Firebase project by its resource name.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The project resource name (e.g. `"projects/my-project-id"`) |

### Example

```ruby
result = app.integrations.firebase.get_project(name: "projects/my-project-id")
puts("Project: " + (result.displayName).to_s)
puts("ID: " + (result.projectId).to_s)
```
---

## list_databases

List Cloud Firestore databases in a Firebase project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `parent` | string | no | The parent project name (e.g. `"projects/my-project-id"`). Uses the configured project ID if omitted. |

### Example

```ruby
result = app.integrations.firebase.list_databases(parent: "projects/my-project-id")
(result.databases || []).each do |db|
  puts((db.name).to_s + " (" + (db.locationId).to_s + ")")
end
```
---

## list_documents

List documents in a Firestore collection.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `parent` | string | yes | The parent resource (e.g. `"projects/my-project/databases/(default)/documents"`) |
| `collection_id` | string | yes | The collection ID to list documents from |
| `page_size` | integer | no | Maximum number of documents to return |
| `page_token` | string | no | Token for pagination from a previous list call |
| `order_by` | string | no | Field to order results by |

### Example

```ruby
result = app.integrations.firebase.list_documents(parent: "projects/my-project/databases/(default)/documents", collection_id: "users", page_size: 20)
(result.documents || []).each do |doc|
  puts(doc.name)
end
```
---

## list_collections

List collection IDs under a Firestore document or database root.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `parent` | string | yes | The parent resource (e.g. `"projects/my-project/databases/(default)/documents"`) |
| `page_size` | integer | no | Maximum number of collection IDs to return |
| `page_token` | string | no | Token for pagination from a previous list call |

### Example

```ruby
result = app.integrations.firebase.list_collections(parent: "projects/my-project/databases/(default)/documents")
(result.collectionIds || []).each do |id|
  puts("Collection: " + (id).to_s)
end
```
---

## list_users

List users in a Firebase project via the Identity Toolkit API.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `max_results` | integer | no | Maximum number of users to return (default: 1000, max: 1000) |
| `page_token` | string | no | Token for pagination from a previous list call |

### Example

```ruby
result = app.integrations.firebase.list_users(max_results: 50)
(result.users || []).each do |user|
  puts((user.localId).to_s + ": " + ((user.email || "no email")).to_s)
end
```
---

## get_current_user

Get the currently authenticated OAuth2 user profile information.

### Parameters

None.

### Example

```ruby
result = app.integrations.firebase.get_current_user()
puts("Name: " + ((result.name || "unknown")).to_s)
puts("Email: " + ((result.email || "unknown")).to_s)
```
---

## Multi-Account Usage

If you have multiple Firebase accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.firebase.list_projects()
# Explicit default (portable across setups)
app.integrations.firebase.default.list_projects()
# Named accounts
app.integrations.firebase.production.list_projects()
app.integrations.firebase.staging.list_projects()
```
All functions are identical across accounts — only the credentials differ.
