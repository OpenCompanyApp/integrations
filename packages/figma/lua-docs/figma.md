# Figma — Lua API Reference

## figma_list_files

List Figma files accessible to the authenticated user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of files to return (default: 30) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```lua
local result = app.integrations.figma.figma_list_files({
  limit = 10,
  page = 1
})

for _, file in ipairs(result.files) do
  print(file.name .. " — " .. file.key)
end
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

```lua
local result = app.integrations.figma.figma_get_file({
  file_key = "abc123def456",
  depth = 2
})

print("File: " .. result.name)
for _, page in ipairs(result.document.children) do
  print("  Page: " .. page.name)
end
```

---

## figma_list_projects

List all projects in a Figma team.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `team_id` | string | yes | The Figma team ID |

### Example

```lua
local result = app.integrations.figma.figma_list_projects({
  team_id = "12345"
})

for _, project in ipairs(result.projects) do
  print(project.id .. ": " .. project.name)
end
```

---

## figma_list_components

List all components in a Figma file.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file_key` | string | yes | The Figma file key |

### Example

```lua
local result = app.integrations.figma.figma_list_components({
  file_key = "abc123def456"
})

for _, comp in ipairs(result.meta.components) do
  print(comp.name .. " — " .. comp.key)
end
```

---

## figma_get_component

Get a Figma component by its key.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `component_key` | string | yes | The component key |

### Example

```lua
local result = app.integrations.figma.figma_get_component({
  component_key = "abc123componentkey"
})

print(result.name .. ": " .. (result.description or "no description"))
```

---

## figma_list_comments

List all comments on a Figma file. Includes authors, positions, and reply threads.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file_key` | string | yes | The Figma file key |

### Example

```lua
local result = app.integrations.figma.figma_list_comments({
  file_key = "abc123def456"
})

for _, comment in ipairs(result.comments) do
  print(comment.user.handle .. ": " .. comment.message)
end
```

---

## figma_get_current_user

Get the authenticated Figma user profile. Returns name, email, and account details.

### Example

```lua
local result = app.integrations.figma.figma_get_current_user({})
print("Logged in as: " .. result.email)
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
