# Formstack — Ruby API Reference

## list_forms

List all forms in your Formstack account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of forms per page (default: 25, max: 200) |
| `search` | string | no | Search string to filter forms by name |

### Example

```ruby
result = app.integrations.formstack.list(page: 1, per_page: 25)
result.forms.each do |form|
  puts((form.id).to_s + ": " + (form.name).to_s)
end
```
---

## get_form

Get details and field structure of a specific form.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `form_id` | integer | yes | The numeric ID of the form |

### Example

```ruby
form = app.integrations.formstack.get(form_id: 12345)
puts("Form: " + (form.name).to_s)
form.fields.each do |field|
  puts("  " + (field.label).to_s + " (" + (field.type).to_s + ") = field key: " + (field.name).to_s)
end
```
---

## list_submissions

List submissions for a specific form.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `form_id` | integer | yes | The numeric ID of the form |
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of submissions per page (default: 25, max: 200) |
| `expand_data` | boolean | no | Expand submission data with field labels (default: false) |

### Example

```ruby
result = app.integrations.formstack.list_submissions(form_id: 12345, per_page: 10, expand_data: true)
result.submissions.each do |sub|
  puts("Submission " + (sub.id).to_s + " at " + (sub.timestamp).to_s)
end
```
---

## get_submission

Get details of a specific submission.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `submission_id` | integer | yes | The numeric ID of the submission |

### Example

```ruby
sub = app.integrations.formstack.get_submission(submission_id: 67890)
puts("Submission " + (sub.id).to_s)
sub.data.to_a.each do |key, value|
  puts("  " + (key).to_s + " = " + ((value).to_s).to_s)
end
```
---

## create_submission

Create a new submission for a form. Use `get_form` first to discover available field keys.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `form_id` | integer | yes | The numeric ID of the form |
| `fields` | object | yes | Object with field keys and values, e.g. `{field_123456 = "John", field_234567 = "john@example.com"}` |

### Example

```ruby
result = app.integrations.formstack.create_submission(form_id: 12345, fields: {field_123456: "Jane Doe", field_234567: "jane@example.com", field_345678: "Hello, I have a question..."})
puts("Created submission: " + (result.id).to_s)
```
---

## delete_submission

Delete a submission permanently.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `submission_id` | integer | yes | The numeric ID of the submission to delete |

### Example

```ruby
app.integrations.formstack.delete_submission(submission_id: 67890)
puts("Submission deleted")
```
---

## list_folders

List all folders in your Formstack account.

### Parameters

None.

### Example

```ruby
result = app.integrations.formstack.list_folders()
result.folders.each do |folder|
  puts((folder.id).to_s + ": " + (folder.name).to_s)
end
```
---

## get_current_user

Get the currently authenticated user's profile.

### Parameters

None.

### Example

```ruby
user = app.integrations.formstack.get_current_user()
puts("Logged in as: " + (user.first_name).to_s + " " + (user.last_name).to_s + " (" + (user.email).to_s + ")")
```
---

## Multi-Account Usage

If you have multiple Formstack accounts configured, use account-specific namespaces:

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
