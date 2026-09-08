# Typeform — Ruby API Reference

## typeform_list_forms

List Typeform forms with optional search and filtering by workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `page_size` | integer | no | Number of forms per page (default: 10, max: 200) |
| `search` | string | no | Search term to filter forms by title |
| `workspace_id` | string | no | Filter forms by workspace ID |

### Response

Returns an object with:

| Field | Type | Description |
|-------|------|-------------|
| `items` | array | Array of form objects |
| `total_count` | integer | Total number of matching forms |
| `page_count` | integer | Total number of pages |

### Example

```ruby
result = app.integrations.typeform.list(page: 1, page_size: 20, search: "Customer")
result.items.each do |form|
  puts((form.id).to_s + ": " + (form.title).to_s)
end
```
---

## typeform_get_form

Get details of a specific Typeform form including its fields and settings.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `form_id` | string | yes | The unique ID of the Typeform form |

### Example

```ruby
result = app.integrations.typeform.get(form_id: "abc123")
puts("Form: " + (result.title).to_s)
result.fields.each do |field|
  puts("  Field: " + (field.title).to_s + " (" + (field.type).to_s + ")")
end
```
---

## typeform_list_responses

List responses for a Typeform form with filtering by date, completion status, and search.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `form_id` | string | yes | The unique ID of the Typeform form |
| `page_size` | integer | no | Number of responses per page (default: 25, max: 1000) |
| `after` | string | no | Only responses submitted after this date (ISO 8601, e.g. `"2024-01-01T00:00:00Z"`) |
| `before` | string | no | Only responses submitted before this date (ISO 8601) |
| `completed` | boolean | no | Filter by completion status (`true` for completed, `false` for incomplete) |
| `sort` | string | no | Sort order, e.g. `"submitted_at,desc"` or `"submitted_at,asc"` |
| `query` | string | no | Search query to filter responses by answers |

### Response

Returns an object with:

| Field | Type | Description |
|-------|------|-------------|
| `items` | array | Array of response objects |
| `total_count` | integer | Total number of matching responses |
| `page_count` | integer | Total number of pages |

### Example

```ruby
result = app.integrations.typeform.list_responses(form_id: "abc123", page_size: 50, completed: true, sort: "submitted_at,desc")
result.items.each do |response|
  puts("Response " + (response.response_id).to_s + " submitted at " + (response.submitted_at).to_s)
end
```
---

## typeform_get_response

Get a single Typeform response by ID, including answers and metadata.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `form_id` | string | yes | The unique ID of the Typeform form |
| `response_id` | string | yes | The unique ID of the response |

### Example

```ruby
result = app.integrations.typeform.get_response(form_id: "abc123", response_id: "resp001")
puts("Submitted at: " + (result.submitted_at).to_s)
result.answers.each do |answer|
  puts("  " + (answer.field.id).to_s + ": " + (((answer.text || answer.choice.label) || "")).to_s)
end
```
---

## typeform_delete_response

Delete a Typeform response permanently.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `form_id` | string | yes | The unique ID of the Typeform form |
| `response_id` | string | yes | The unique ID of the response to delete |

### Example

```ruby
result = app.integrations.typeform.delete_response(form_id: "abc123", response_id: "resp001")
puts(result.message)
```
---

## typeform_list_workspaces

List Typeform workspaces with optional search.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `page_size` | integer | no | Number of workspaces per page (default: 10, max: 200) |
| `search` | string | no | Search term to filter workspaces by name |

### Response

Returns an object with:

| Field | Type | Description |
|-------|------|-------------|
| `items` | array | Array of workspace objects |
| `total_count` | integer | Total number of matching workspaces |
| `page_count` | integer | Total number of pages |

### Example

```ruby
result = app.integrations.typeform.list_workspaces(page: 1, page_size: 50)
result.items.each do |ws|
  puts((ws.id).to_s + ": " + (ws.name).to_s)
end
```
---

## typeform_get_workspace

Get details of a specific Typeform workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | yes | The unique ID of the Typeform workspace |

### Example

```ruby
result = app.integrations.typeform.get_workspace(workspace_id: "ws001")
puts("Workspace: " + (result.name).to_s)
puts("Members: " + (result.members.length).to_s)
```
---

## typeform_create_webhook

Create or update a webhook for a Typeform form to receive response notifications.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `form_id` | string | yes | The unique ID of the Typeform form |
| `tag` | string | yes | A unique tag to identify this webhook |
| `url` | string | yes | The endpoint URL where Typeform will send webhook events |
| `enabled` | boolean | no | Whether the webhook is enabled (default: `true`) |

### Example

```ruby
result = app.integrations.typeform.create_webhook(form_id: "abc123", tag: "my-webhook", url: "https://example.com/webhooks/typeform", enabled: true)
puts("Webhook created: " + (result.tag).to_s + " -> " + (result.url).to_s)
```
---

## typeform_list_webhooks

List all webhooks configured for a Typeform form.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `form_id` | string | yes | The unique ID of the Typeform form |

### Response

Returns an object with:

| Field | Type | Description |
|-------|------|-------------|
| `items` | array | Array of webhook objects |

### Example

```ruby
result = app.integrations.typeform.list_webhooks(form_id: "abc123")
result.items.each do |wh|
  puts((wh.tag).to_s + ": " + (wh.url).to_s + " (enabled=" + ((wh.enabled).to_s).to_s + ")")
end
```
---

## typeform_delete_webhook

Delete a webhook from a Typeform form.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `form_id` | string | yes | The unique ID of the Typeform form |
| `tag` | string | yes | The unique tag of the webhook to delete |

### Example

```ruby
result = app.integrations.typeform.delete_webhook(form_id: "abc123", tag: "my-webhook")
puts(result.message)
```
---

## Multi-Account Usage

If you have multiple typeform accounts configured, use account-specific namespaces:

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
