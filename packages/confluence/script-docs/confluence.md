# HTTP client for the Confluence Cloud REST API — Ruby API Reference

## confluence_add_comment

Add a comment to a Confluence page. Requires the page ID and comment body in HTML..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_id` | string | yes | The content ID of the page to comment on. |
| `body` | string | yes | The comment body in Confluence storage format (HTML). Example:  |

### Example

```ruby
result = app.integrations.confluence.add_comment(page_id: "", body: "")
```
## confluence_add_labels

Add one or more labels to a Confluence page. Labels are provided as an array of name strings..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_id` | string | yes | The content ID of the page. |
| `labels` | array | yes | Array of label name strings to add. Example: [ |

### Example

```ruby
result = app.integrations.confluence.add_labels(page_id: "", labels: {})
```
## confluence_create_page

Create a new page in a Confluence space. Requires space_key, title, and body (HTML). Optionally specify a parent page ID..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `space_key` | string | yes | The space key (e.g.  |
| `title` | string | yes | The title of the page. |
| `body` | string | yes | The page body in Confluence storage format (HTML). Example:  |
| `parent_id` | string | no | Optional parent page ID to nest the new page under. |
| `type` | string | no | Content type. Default:  |

### Example

```ruby
result = app.integrations.confluence.create_page(space_key: "", title: "", body: "")
```
## confluence_delete_page

Delete a Confluence page by its ID. This action moves the page to the trash..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_id` | string | yes | The content ID of the page to delete. |

### Example

```ruby
result = app.integrations.confluence.delete_page(page_id: "")
```
## confluence_get_labels

Get the labels attached to a Confluence page by its ID..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_id` | string | yes | The content ID of the page. |

### Example

```ruby
result = app.integrations.confluence.get_labels(page_id: "")
```
## confluence_get_page

Get details for a specific Confluence page by ID. Returns title, body, version, space, and other metadata..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_id` | string | yes | The content ID of the page. |
| `expand` | string | no | Comma-separated list of properties to expand. Example:  |

### Example

```ruby
result = app.integrations.confluence.get_page(page_id: "", expand: "")
```
## confluence_get_page_ancestors

Get the ancestor (parent) pages of a Confluence page by its ID. Returns the full ancestor hierarchy..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_id` | string | yes | The content ID of the page. |

### Example

```ruby
result = app.integrations.confluence.get_page_ancestors(page_id: "")
```
## confluence_get_page_children

Get the child pages of a Confluence page by its ID. Supports pagination and property expansion..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_id` | string | yes | The content ID of the parent page. |
| `limit` | integer | no | Maximum number of results per page. Default: 25. |
| `start` | integer | no | Start offset for pagination. Default: 0. |
| `expand` | string | no | Comma-separated list of properties to expand. Example:  |

### Example

```ruby
result = app.integrations.confluence.get_page_children(page_id: "", limit: 0, start: 0)
```
## confluence_get_space

Get details for a specific Confluence space by its key..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `space_key` | string | yes | The space key (e.g.  |

### Example

```ruby
result = app.integrations.confluence.get_space(space_key: "")
```
## confluence_get_spaces

List Confluence spaces accessible to the authenticated user. Supports pagination and filtering by type and status..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of results per page. Default: 25. |
| `start` | integer | no | Start offset for pagination. Default: 0. |
| `type` | string | no | Space type filter. Example:  |
| `status` | string | no | Space status filter. Example:  |

### Example

```ruby
result = app.integrations.confluence.get_spaces(limit: 0, start: 0, type: "")
```
## confluence_search_pages

Search for Confluence content using CQL (Confluence Query Language). Examples: \.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `cql` | string | yes | CQL query string. Example: \ |
| `limit` | integer | no | Maximum number of results per page. Default: 25. |
| `start` | integer | no | Start offset for pagination. Default: 0. |
| `expand` | string | no | Comma-separated list of properties to expand. Example:  |

### Example

```ruby
result = app.integrations.confluence.search_pages(cql: "", limit: 0, start: 0)
```
## confluence_update_page

Update an existing Confluence page. Requires page_id, title, body, and the new version number (current version + 1)..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_id` | string | yes | The content ID of the page to update. |
| `title` | string | yes | The updated title of the page. |
| `body` | string | yes | The updated page body in Confluence storage format (HTML). |
| `version` | integer | yes | The new version number (must be current version + 1). |
| `status` | string | no | Optional status. Example:  |

### Example

```ruby
result = app.integrations.confluence.update_page(page_id: "", title: "", body: "")
```
---

## Multi-Account Usage

If you have multiple confluence accounts configured, use account-specific namespaces:

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
