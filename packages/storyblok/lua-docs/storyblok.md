# Storyblok — Lua API Reference

## list_stories

List stories in the configured Storyblok space. Supports pagination, search, and sorting.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of stories per page (default: 25, max: 100) |
| `search` | string | no | Search term to filter stories by name or slug |
| `sort_by` | string | no | Sort field (e.g., `"name:asc"`, `"created_at:desc"`, `"updated_at:desc"`) |

### Examples

#### List stories

```lua
local result = app.integrations.storyblok.list_stories({
  per_page = 25
})

for _, story in ipairs(result.stories) do
  print(story.name .. " (" .. story.slug .. ")")
end
```

#### Search and sort stories

```lua
local result = app.integrations.storyblok.list_stories({
  search = "blog",
  sort_by = "updated_at:desc",
  per_page = 10
})
```

---

## get_story

Retrieve a single Storyblok story by its numeric ID, including full content.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The numeric ID of the story to retrieve |

### Examples

#### Get a story

```lua
local result = app.integrations.storyblok.get_story({
  id = 12345678
})

print("Name: " .. result.story.name)
print("Slug: " .. result.story.slug)
print("Content: " .. json.stringify(result.story.content))
```

---

## create_story

Create a new story in the configured Storyblok space. Requires a name, slug, and content object.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The display name of the story |
| `slug` | string | yes | URL-friendly slug for the story (e.g., `"my-new-page"`) |
| `content` | object | yes | The story content as a JSON object. Must match a component schema in the space (e.g., `{component = "page", title = "Hello"}`) |
| `parent_id` | integer | no | The numeric ID of the parent story (for nested stories) |
| `is_startpage` | boolean | no | Whether this is the root/start page of the space (default: false) |
| `tag_list` | array | no | List of tags to assign to the story |

### Examples

#### Create a story

```lua
local result = app.integrations.storyblok.create_story({
  name = "My New Page",
  slug = "my-new-page",
  content = {
    component = "page",
    title = "My New Page",
    body = "Hello, world!"
  }
})

print("Created story: " .. result.story.id)
```

#### Create a nested story

```lua
local result = app.integrations.storyblok.create_story({
  name = "Blog Post",
  slug = "blog-post",
  content = {
    component = "post",
    title = "Blog Post",
    excerpt = "A short summary"
  },
  parent_id = 12345678,
  tag_list = { "blog", "news" }
})
```

---

## update_story

Update an existing Storyblok story. Provide the story ID and the fields to update (e.g., content, name, slug).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The numeric ID of the story to update |
| `content` | object | no | Updated story content as a JSON object |
| `name` | string | no | Updated display name of the story |
| `slug` | string | no | Updated URL slug for the story |
| `tag_list` | array | no | Updated list of tags |

At least one update field is required.

### Examples

#### Update story content

```lua
local result = app.integrations.storyblok.update_story({
  id = 12345678,
  content = {
    component = "page",
    title = "Updated Title",
    body = "Updated content"
  }
})

print("Updated story: " .. result.story.name)
```

#### Update name and tags

```lua
local result = app.integrations.storyblok.update_story({
  id = 12345678,
  name = "Renamed Page",
  tag_list = { "updated", "featured" }
})
```

---

## delete_story

Delete a story from the configured Storyblok space by its numeric ID. This action is irreversible.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The numeric ID of the story to delete |

### Examples

#### Delete a story

```lua
local result = app.integrations.storyblok.delete_story({
  id = 12345678
})

print(result.message)
```

---

## list_components

List all component schemas defined in the configured Storyblok space. Useful for understanding available content structures.

### Parameters

This tool takes no parameters.

### Examples

#### List components

```lua
local result = app.integrations.storyblok.list_components({})

for _, component in ipairs(result.components) do
  print(component.name)
  for _, field in ipairs(component.schema) do
    print("  - " .. field.name .. " (" .. field.type .. ")")
  end
end
```

---

## get_current_user

List all available Storyblok spaces for the authenticated user. Useful as a health check or to discover space IDs.

### Parameters

This tool takes no parameters.

### Examples

#### List spaces (health check)

```lua
local result = app.integrations.storyblok.get_current_user({})

for _, space in ipairs(result.spaces) do
  print(space.name .. " (ID: " .. space.id .. ")")
end
```

---

## Multi-Account Usage

If you have multiple storyblok accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.storyblok.list_stories({...})

-- Explicit default (portable across setups)
app.integrations.storyblok.default.list_stories({...})

-- Named accounts
app.integrations.storyblok.production.list_stories({...})
app.integrations.storyblok.staging.list_stories({...})
```

All functions are identical across accounts — only the credentials differ.
