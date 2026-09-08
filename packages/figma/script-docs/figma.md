# Figma — Ruby API Reference

## figma_list_files

List Figma files accessible to the authenticated user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of files to return (default: 30) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```ruby
result = app.integrations.figma.list_files(limit: 10, page: 1)
result.files.each do |file|
  puts((file.name).to_s + " — " + (file.key).to_s)
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

```ruby
result = app.integrations.figma.get_file(file_key: "abc123def456", depth: 2)
puts("File: " + (result.name).to_s)
result.document.children.each do |page|
  puts("  Page: " + (page.name).to_s)
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

```ruby
result = app.integrations.figma.list_projects(team_id: "12345")
result.projects.each do |project|
  puts((project.id).to_s + ": " + (project.name).to_s)
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

```ruby
result = app.integrations.figma.list_components(file_key: "abc123def456")
result.meta.components.each do |comp|
  puts((comp.name).to_s + " — " + (comp.key).to_s)
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

```ruby
result = app.integrations.figma.get_component(component_key: "abc123componentkey")
puts((result.name).to_s + ": " + ((result.description || "no description")).to_s)
```
---

## figma_list_comments

List all comments on a Figma file. Includes authors, positions, and reply threads.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file_key` | string | yes | The Figma file key |

### Example

```ruby
result = app.integrations.figma.list_comments(file_key: "abc123def456")
result.comments.each do |comment|
  puts((comment.user.handle).to_s + ": " + (comment.message).to_s)
end
```
---

## figma_get_current_user

Get the authenticated Figma user profile. Returns name, email, and account details.

### Example

```ruby
result = app.integrations.figma.get_current_user()
puts("Logged in as: " + (result.email).to_s)
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
