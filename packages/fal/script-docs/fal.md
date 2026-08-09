# fal.ai — JavaScript API Reference

## list_models

List available fal.ai models.

### Parameters

None.

### Example

```js
var result = app.integrations["fal"].list_models({})

for (const model of (result)) {
  console.log(model.id + ": " + model.description)
}
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

```js
var result = app.integrations["fal"].submit_request({
  model_id: "fal-ai/flux/schnell",
  input: {
    prompt: "A beautiful sunset over the ocean, cinematic lighting",
    image_size: "landscape_16_9",
    num_images: 1,
  }
})

console.log("Request ID: " + result.request_id)
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

```js
var status = app.integrations["fal"].get_request_status({
  model_id: "fal-ai/flux/schnell",
  request_id: "abc123-def456",
})

console.log("Status: " + status.status)
if (status.queue_position) {
  console.log("Queue position: " + status.queue_position)
}
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

```js
var result = app.integrations["fal"].get_result({
  model_id: "fal-ai/flux/schnell",
  request_id: "abc123-def456",
})

if (result.images) {
  for (const image of (result.images)) {
    console.log("Image URL: " + image.url)
  }
}

if (result.video) {
  console.log("Video URL: " + result.video.url)
}
```
---

## list_files

List files stored in fal.ai storage.

### Parameters

None.

### Example

```js
var result = app.integrations["fal"].list_files({})

for (const file of (result)) {
  console.log(file.file_name + " — " + file.url)
}
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

```js
var result = app.integrations["fal"].upload_file({
  file_path: "/path/to/reference-image.png",
  file_name: "reference.png",
})

console.log("Uploaded file URL: " + result.url)
```
---

## get_current_user

Get the current fal.ai user profile and account information.

### Parameters

None.

### Example

```js
var user = app.integrations["fal"].get_current_user({})

console.log("Name: " + user.name)
console.log("Email: " + user.email)
```
---

## Multi-Account Usage

If you have multiple fal.ai accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations["fal"].function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations["fal"].default.function_name({ /* parameters */ })

// Named accounts
app.integrations["fal"].production.function_name({ /* parameters */ })
app.integrations["fal"].staging.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
