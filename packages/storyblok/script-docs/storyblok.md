# Storyblok — Ruby API Reference

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

```ruby
result = app.integrations.storyblok.list_stories(per_page: 25)
result.stories.each do |story|
  puts((story.name).to_s + " (" + (story.slug).to_s + ")")
end
```
#### Search and sort stories

```ruby
result = app.integrations.storyblok.list_stories(search: "blog", sort_by: "updated_at:desc", per_page: 10)
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

```ruby
result = app.integrations.storyblok.get(id: 12345678)
puts("Name: " + (result.story.name).to_s)
puts("Slug: " + (result.story.slug).to_s)
puts("Content: " + (JSON.generate(result.story.content)).to_s)
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

```ruby
result = app.integrations.storyblok.create(name: "My New Page", slug: "my-new-page", content: {component: "page", title: "My New Page", body: "Hello, world!"})
puts("Created story: " + (result.story.id).to_s)
```
#### Create a nested story

```ruby
result = app.integrations.storyblok.create(name: "Blog Post", slug: "blog-post", content: {component: "post", title: "Blog Post", excerpt: "A short summary"}, parent_id: 12345678, tag_list: ["blog", "news"])
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

```ruby
result = app.integrations.storyblok.update(id: 12345678, content: {component: "page", title: "Updated Title", body: "Updated content"})
puts("Updated story: " + (result.story.name).to_s)
```
#### Update name and tags

```ruby
result = app.integrations.storyblok.update(id: 12345678, name: "Renamed Page", tag_list: ["updated", "featured"])
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

```ruby
result = app.integrations.storyblok.delete(id: 12345678)
puts(result.message)
```
---

## list_components

List all component schemas defined in the configured Storyblok space. Useful for understanding available content structures.

### Parameters

This tool takes no parameters.

### Examples

#### List components

```ruby
result = app.integrations.storyblok.list_components()
result.components.each do |component|
  puts(component.name)
  component.schema.each do |field|
    puts("  - " + (field.name).to_s + " (" + (field.type).to_s + ")")
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

```ruby
result = app.integrations.storyblok.get_current_user_spaces()
result.spaces.each do |space|
  puts((space.name).to_s + " (ID: " + (space.id).to_s + ")")
end
```
---

## Multi-Account Usage

If you have multiple storyblok accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.storyblok.list_stories()
# Explicit default (portable across setups)
app.integrations.storyblok.default.list_stories()
# Named accounts
app.integrations.storyblok.production.list_stories()
app.integrations.storyblok.staging.list_stories()
```
All functions are identical across accounts — only the credentials differ.
