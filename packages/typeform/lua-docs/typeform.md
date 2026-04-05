# Typeform — Lua API Reference

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

```lua
local result = app.integrations.typeform.list_forms({
  page = 1,
  page_size = 20,
  search = "Customer"
})

for _, form in ipairs(result.items) do
  print(form.id .. ": " .. form.title)
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

```lua
local result = app.integrations.typeform.get_form({
  form_id = "abc123"
})

print("Form: " .. result.title)
for _, field in ipairs(result.fields) do
  print("  Field: " .. field.title .. " (" .. field.type .. ")")
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

```lua
local result = app.integrations.typeform.list_responses({
  form_id = "abc123",
  page_size = 50,
  completed = true,
  sort = "submitted_at,desc"
})

for _, response in ipairs(result.items) do
  print("Response " .. response.response_id .. " submitted at " .. response.submitted_at)
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

```lua
local result = app.integrations.typeform.get_response({
  form_id = "abc123",
  response_id = "resp001"
})

print("Submitted at: " .. result.submitted_at)
for _, answer in ipairs(result.answers) do
  print("  " .. answer.field.id .. ": " .. (answer.text or answer.choice.label or ""))
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

```lua
local result = app.integrations.typeform.delete_response({
  form_id = "abc123",
  response_id = "resp001"
})

print(result.message)
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

```lua
local result = app.integrations.typeform.list_workspaces({
  page = 1,
  page_size = 50
})

for _, ws in ipairs(result.items) do
  print(ws.id .. ": " .. ws.name)
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

```lua
local result = app.integrations.typeform.get_workspace({
  workspace_id = "ws001"
})

print("Workspace: " .. result.name)
print("Members: " .. #result.members)
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

```lua
local result = app.integrations.typeform.create_webhook({
  form_id = "abc123",
  tag = "my-webhook",
  url = "https://example.com/webhooks/typeform",
  enabled = true
})

print("Webhook created: " .. result.tag .. " -> " .. result.url)
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

```lua
local result = app.integrations.typeform.list_webhooks({
  form_id = "abc123"
})

for _, wh in ipairs(result.items) do
  print(wh.tag .. ": " .. wh.url .. " (enabled=" .. tostring(wh.enabled) .. ")")
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

```lua
local result = app.integrations.typeform.delete_webhook({
  form_id = "abc123",
  tag = "my-webhook"
})

print(result.message)
```

---

## Multi-Account Usage

If you have multiple typeform accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.typeform.function_name({...})

-- Explicit default (portable across setups)
app.integrations.typeform.default.function_name({...})

-- Named accounts
app.integrations.typeform.work.function_name({...})
app.integrations.typeform.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
