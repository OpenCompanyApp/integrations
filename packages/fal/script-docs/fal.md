# fal.ai — Ruby API Reference

## list_models

List available fal.ai models.

### Parameters

None.

### Example

```ruby
result = app.integrations.fal.list_models()
result.each do |model|
  puts((model.id).to_s + ": " + (model.description).to_s)
end
```
---

## submit_request

Submit a generation request to a fal.ai model.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `model_id` | string | yes | The model identifier (e.g., `"fal-ai/flux/schnell"`) |
| `input` | object | yes | Model input values (e.g., prompt, image_url) |
| `webhook_url` | string | no | URL to receive POST notifications on completion |

### Example

```ruby
result = app.integrations.fal.submit_request(model_id: "fal-ai/flux/schnell", input: {prompt: "A beautiful sunset over the ocean, cinematic lighting", image_size: "landscape_16_9", num_images: 1})
puts("Request ID: " + (result.request_id).to_s)
```
---

## get_request_status

Get the status of a submitted fal.ai request.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `model_id` | string | yes | The model identifier used when submitting |
| `request_id` | string | yes | The request ID returned by `submit_request` |

### Example

```ruby
status = app.integrations.fal.get_request_status(model_id: "fal-ai/flux/schnell", request_id: "abc123-def456")
puts("Status: " + (status.status).to_s)
if status.queue_position
  puts("Queue position: " + (status.queue_position).to_s)
end
```
---

## get_result

Get the result of a completed fal.ai request.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `model_id` | string | yes | The model identifier used when submitting |
| `request_id` | string | yes | The request ID returned by `submit_request` |

### Example

```ruby
result = app.integrations.fal.get_result(model_id: "fal-ai/flux/schnell", request_id: "abc123-def456")
if result.images
  result.images.each do |image|
    puts("Image URL: " + (image.url).to_s)
  end
end
if result.video
  puts("Video URL: " + (result.video.url).to_s)
end
```
---

## list_files

List files stored in fal.ai storage.

### Parameters

None.

### Example

```ruby
result = app.integrations.fal.list_files()
result.each do |file|
  puts((file.file_name).to_s + " — " + (file.url).to_s)
end
```
---

## upload_file

Upload a file to fal.ai storage for use as model input.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file_path` | string | yes | The local file path to upload |
| `file_name` | string | no | Custom file name for the upload |

### Example

```ruby
result = app.integrations.fal.upload_file(file_path: "/path/to/reference-image.png", file_name: "reference.png")
puts("Uploaded file URL: " + (result.url).to_s)
```
---

## get_current_user

Get the current fal.ai user profile and account information.

### Parameters

None.

### Example

```ruby
user = app.integrations.fal.get_current_user()
puts("Name: " + (user.name).to_s)
puts("Email: " + (user.email).to_s)
```
---

## Multi-Account Usage

If you have multiple fal.ai accounts configured, use account-specific namespaces:

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
