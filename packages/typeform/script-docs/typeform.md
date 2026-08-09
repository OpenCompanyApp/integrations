# Typeform — JavaScript API Reference

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

```js
var result = app.integrations.typeform.list_forms({
  page: 1,
  page_size: 20,
  search: "Customer",
})

for (const form of (result.items)) {
  console.log(form.id + ": " + form.title)
}
```
---

## typeform_get_form

Get details of a specific Typeform form including its fields and settings.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `form_id` | string | yes | The unique ID of the Typeform form |

### Example

```js
var result = app.integrations.typeform.get_form({
  form_id: "abc123",
})

console.log("Form: " + result.title)
for (const field of (result.fields)) {
  console.log("  Field: " + field.title + " (" + field.type + ")")
}
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

```js
var result = app.integrations.typeform.list_responses({
  form_id: "abc123",
  page_size: 50,
  completed: true,
  sort: "submitted_at,desc",
})

for (const response of (result.items)) {
  console.log("Response " + response.response_id + " submitted at " + response.submitted_at)
}
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

```js
var result = app.integrations.typeform.get_response({
  form_id: "abc123",
  response_id: "resp001",
})

console.log("Submitted at: " + result.submitted_at)
for (const answer of (result.answers)) {
  console.log("  " + answer.field.id + ": " + (answer.text || answer.choice.label || ""))
}
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

```js
var result = app.integrations.typeform.delete_response({
  form_id: "abc123",
  response_id: "resp001",
})

console.log(result.message)
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

```js
var result = app.integrations.typeform.list_workspaces({
  page: 1,
  page_size: 50,
})

for (const ws of (result.items)) {
  console.log(ws.id + ": " + ws.name)
}
```
---

## typeform_get_workspace

Get details of a specific Typeform workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | yes | The unique ID of the Typeform workspace |

### Example

```js
var result = app.integrations.typeform.get_workspace({
  workspace_id: "ws001",
})

console.log("Workspace: " + result.name)
console.log("Members: " + result.members.length)
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

```js
var result = app.integrations.typeform.create_webhook({
  form_id: "abc123",
  tag: "my-webhook",
  url: "https://example.com/webhooks/typeform",
  enabled: true,
})

console.log("Webhook created: " + result.tag + " -> " + result.url)
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

```js
var result = app.integrations.typeform.list_webhooks({
  form_id: "abc123",
})

for (const wh of (result.items)) {
  console.log(wh.tag + ": " + wh.url + " (enabled=" + String(wh.enabled) + ")")
}
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

```js
var result = app.integrations.typeform.delete_webhook({
  form_id: "abc123",
  tag: "my-webhook",
})

console.log(result.message)
```
---

## Multi-Account Usage

If you have multiple typeform accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.typeform.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.typeform.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.typeform.work.function_name({ /* parameters */ })
app.integrations.typeform.personal.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
