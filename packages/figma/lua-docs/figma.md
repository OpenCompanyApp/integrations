# Client for the Figma REST API (v1) — Lua API Reference

## figma_delete_comment

Delete a comment from a Figma file..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file_key` | string | yes | The Figma file key. |
| `comment_id` | string | yes | The comment ID to delete. |

### Example

```lua
local result = app.integrations.figma.figma_delete_comment({
  file_key = ""
  comment_id = ""
})
```

## figma_get_comments

List all comments on a Figma file..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file_key` | string | yes | The Figma file key. |

### Example

```lua
local result = app.integrations.figma.figma_get_comments({
  file_key = ""
})
```

## figma_get_component

Get a Figma component by its key..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `component_key` | string | yes | The component key. |

### Example

```lua
local result = app.integrations.figma.figma_get_component({
  component_key = ""
})
```

## figma_get_components

List all components in a Figma file..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file_key` | string | yes | The Figma file key. |

### Example

```lua
local result = app.integrations.figma.figma_get_components({
  file_key = ""
})
```

## figma_get_file

Get a Figma file by key. Returns the document tree with pages and nodes..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file_key` | string | yes | The Figma file key (from the file URL). |
| `ids` | string | no | Comma-separated list of node IDs to return. |
| `depth` | integer | no | Max depth of the document tree to return. |
| `geometry` | string | no | Set to  |
| `plugin_data` | string | no | Comma-separated list of plugin IDs to include data for. |

### Example

```lua
local result = app.integrations.figma.figma_get_file({
  file_key = ""
  ids = ""
  depth = 0
})
```

## figma_get_file_images

Export images from Figma nodes in a file. Returns image download URLs..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file_key` | string | yes | The Figma file key. |
| `ids` | string | yes | Comma-separated list of node IDs to export. |
| `format` | string | no | Image format: png, jpg, svg, or pdf. Defaults to png. |
| `scale` | number | no | Image scale factor (e.g. 1, 2, 3). Defaults to 1. |
| `svg_include_id_token` | boolean | no | If true, include id attribute for SVG root. |

### Example

```lua
local result = app.integrations.figma.figma_get_file_images({
  file_key = ""
  ids = ""
  format = ""
})
```

## figma_get_file_nodes

Get specific nodes from a Figma file by node IDs..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file_key` | string | yes | The Figma file key. |
| `ids` | string | yes | Comma-separated list of node IDs to retrieve. |
| `depth` | integer | no | Max depth of nodes to return. |
| `geometry` | string | no | Set to  |

### Example

```lua
local result = app.integrations.figma.figma_get_file_nodes({
  file_key = ""
  ids = ""
  depth = 0
})
```

## figma_get_image_fills

Get image fill metadata for a Figma file. Returns image URLs for all image fills..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file_key` | string | yes | The Figma file key. |

### Example

```lua
local result = app.integrations.figma.figma_get_image_fills({
  file_key = ""
})
```

## figma_get_me

Get the authenticated Figma user profile..

### Example

```lua
local result = app.integrations.figma.figma_get_me({
})
```

## figma_get_project_files

List all files in a Figma project..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The Figma project ID. |
| `branch_data` | boolean | no | If true, include branch metadata for each file. |

### Example

```lua
local result = app.integrations.figma.figma_get_project_files({
  project_id = ""
  branch_data = true
})
```

## figma_get_style

Get a Figma style by its key..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `style_key` | string | yes | The style key. |

### Example

```lua
local result = app.integrations.figma.figma_get_style({
  style_key = ""
})
```

## figma_get_styles

List all styles in a Figma file..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file_key` | string | yes | The Figma file key. |

### Example

```lua
local result = app.integrations.figma.figma_get_styles({
  file_key = ""
})
```

## figma_get_team_projects

List all projects in a Figma team..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `team_id` | string | yes | The Figma team ID. |

### Example

```lua
local result = app.integrations.figma.figma_get_team_projects({
  team_id = ""
})
```

## figma_list_team_components

List published components in a Figma team..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `team_id` | string | yes | The Figma team ID. |
| `max_depth` | integer | no | Maximum depth of component tree to return. |

### Example

```lua
local result = app.integrations.figma.figma_list_team_components({
  team_id = ""
  max_depth = 0
})
```

## figma_post_comment

Post a comment on a Figma file. Can be a top-level comment or a reply..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file_key` | string | yes | The Figma file key. |
| `message` | string | yes | The comment text. |
| `client_meta` | string | no | JSON object with position metadata (x, y) for the comment. |
| `comment_id` | string | no | If provided, this comment is a reply to the given comment ID. |

### Example

```lua
local result = app.integrations.figma.figma_post_comment({
  file_key = ""
  message = ""
  client_meta = ""
})
```

---

## Multi-Account Usage

If you have multiple figma accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.figma.function_name({...})

-- Explicit default (portable across setups)
app.integrations.figma.default.function_name({...})

-- Named accounts
app.integrations.figma.work.function_name({...})
app.integrations.figma.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
