# Client for the Builder.io Visual CMS API covering models, content, symbols, and user info — JavaScript API Reference

## builder_io_list_models

List all models in the Builder.io space.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of models to return. |
| `offset` | integer | no | Number of models to skip for pagination. |

### Example

```js
var result = app.integrations.builder_io.builder_io_list_models({
  limit: 25,
  offset: 0,
})
```
## builder_io_get_model

Get detailed information about a specific Builder.io model by its ID or name.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `model_id` | string | yes | The ID or name of the model to retrieve. |

### Example

```js
var result = app.integrations.builder_io.builder_io_get_model({
  model_id: "page",
})
```
## builder_io_list_content

List content entries for a specific Builder.io model.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `model_name` | string | yes | The model name to list content for (e.g. "page", "blog-post"). |
| `limit` | integer | no | Maximum number of entries to return. |
| `offset` | integer | no | Number of entries to skip for pagination. |
| `query` | string | no | Query string to filter content entries. |
| `fields` | string | no | Comma-separated list of fields to include in the response. |

### Example

```js
var result = app.integrations.builder_io.builder_io_list_content({
  model_name: "blog-post",
  limit: 10,
  offset: 0,
})
```
## builder_io_get_content

Get detailed information about a specific Builder.io content entry by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `content_id` | string | yes | The ID of the content entry to retrieve. |

### Example

```js
var result = app.integrations.builder_io.builder_io_get_content({
  content_id: "abc123",
})
```
## builder_io_create_content

Create a new content entry in Builder.io for a given model.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `model_name` | string | yes | The model name for the new content entry (e.g. "page", "blog-post"). |
| `name` | string | yes | The name/title of the new content entry. |
| `data` | string | yes | JSON object of content data. E.g. `{"blocks": [], "title": "My Page"}`. |

### Example

```js
var result = app.integrations.builder_io.builder_io_create_content({
  model_name: "page",
  name: "My New Page",
  data: '{"title": "My Page", "blocks": []}',
})
```
## builder_io_list_symbols

List all symbols (reusable components) in the Builder.io space.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of symbols to return. |
| `offset` | integer | no | Number of symbols to skip for pagination. |

### Example

```js
var result = app.integrations.builder_io.builder_io_list_symbols({
  limit: 25,
  offset: 0,
})
```
## builder_io_get_current_user

Get information about the currently authenticated Builder.io user.

### Example

```js
var result = app.integrations.builder_io.builder_io_get_current_user({
})
```
---

## Multi-Account Usage

If you have multiple builder-io accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.builder_io.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.builder_io.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.builder_io.work.function_name({ /* parameters */ })
app.integrations.builder_io.personal.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
