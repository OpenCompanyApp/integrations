# Figma — JavaScript API Reference

## figma_list_files

List Figma files accessible to the authenticated user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of files to return (default: 30) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```js
var result = app.integrations.figma.figma_list_files({
  limit: 10,
  page: 1,
})

for (const file of (result.files)) {
  console.log(file.name + " — " + file.key)
}
```
---

## figma_get_file

Get a Figma file by key. Returns the document tree with pages and nodes.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file_key` | string | yes | The Figma file key (from the file URL) |
| `ids` | string | no | Comma-separated list of node IDs to return |
| `depth` | integer | no | Max depth of the document tree to return |
| `geometry` | string | no | Set to "path" to include vector path data |
| `plugin_data` | string | no | Comma-separated list of plugin IDs to include data for |

### Example

```js
var result = app.integrations.figma.figma_get_file({
  file_key: "abc123def456",
  depth: 2,
})

console.log("File: " + result.name)
for (const page of (result.document.children)) {
  console.log("  Page: " + page.name)
}
```
---

## figma_list_projects

List all projects in a Figma team.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `team_id` | string | yes | The Figma team ID |

### Example

```js
var result = app.integrations.figma.figma_list_projects({
  team_id: "12345",
})

for (const project of (result.projects)) {
  console.log(project.id + ": " + project.name)
}
```
---

## figma_list_components

List all components in a Figma file.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file_key` | string | yes | The Figma file key |

### Example

```js
var result = app.integrations.figma.figma_list_components({
  file_key: "abc123def456",
})

for (const comp of (result.meta.components)) {
  console.log(comp.name + " — " + comp.key)
}
```
---

## figma_get_component

Get a Figma component by its key.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `component_key` | string | yes | The component key |

### Example

```js
var result = app.integrations.figma.figma_get_component({
  component_key: "abc123componentkey",
})

console.log(result.name + ": " + (result.description || "no description"))
```
---

## figma_list_comments

List all comments on a Figma file. Includes authors, positions, and reply threads.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file_key` | string | yes | The Figma file key |

### Example

```js
var result = app.integrations.figma.figma_list_comments({
  file_key: "abc123def456",
})

for (const comment of (result.comments)) {
  console.log(comment.user.handle + ": " + comment.message)
}
```
---

## figma_get_current_user

Get the authenticated Figma user profile. Returns name, email, and account details.

### Example

```js
var result = app.integrations.figma.figma_get_current_user({})
console.log("Logged in as: " + result.email)
```
---

## Extended Tools

### figma_get_file_nodes

Get specific nodes from a Figma file by node IDs.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file_key` | string | yes | The Figma file key |
| `ids` | string | yes | Comma-separated list of node IDs |
| `depth` | integer | no | Max depth of nodes to return |
| `geometry` | string | no | Set to "path" to include vector data |

### figma_get_file_images

Export images from Figma nodes. Returns image download URLs.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file_key` | string | yes | The Figma file key |
| `ids` | string | yes | Comma-separated node IDs to export |
| `format` | string | no | Image format: png, jpg, svg, pdf (default: png) |
| `scale` | number | no | Scale factor (1, 2, 3) |

### figma_get_image_fills

Get image fill metadata for a Figma file.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file_key` | string | yes | The Figma file key |

### figma_post_comment

Post a comment on a Figma file.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file_key` | string | yes | The Figma file key |
| `message` | string | yes | The comment text |
| `client_meta` | string | no | JSON position metadata (x, y) |
| `comment_id` | string | no | Reply to this comment ID |

### figma_delete_comment

Delete a comment from a Figma file.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file_key` | string | yes | The Figma file key |
| `comment_id` | string | yes | The comment ID to delete |

### figma_get_project_files

List all files in a Figma project.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The Figma project ID |
| `branch_data` | boolean | no | Include branch metadata |

### figma_get_styles

List all styles in a Figma file.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file_key` | string | yes | The Figma file key |

### figma_get_style

Get a Figma style by key.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `style_key` | string | yes | The style key |

### figma_list_team_components

List published components in a Figma team.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `team_id` | string | yes | The Figma team ID |
| `max_depth` | integer | no | Maximum depth of component tree |

---

## Multi-Account Usage

If you have multiple Figma accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.figma.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.figma.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.figma.work.function_name({ /* parameters */ })
app.integrations.figma.personal.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
