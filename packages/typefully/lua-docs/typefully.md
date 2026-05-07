# Typefully

Lua API reference for the `typefully` integration package. This package targets Typefully API v2, which uses `Authorization: Bearer <api_key>` and scopes draft, media, tag, and queue operations under a `social_set_id`.

Start with `typefully_list_social_sets` to find the account or brand you want to publish from.

## User and Social Sets

### `typefully_get_current_user`

```lua
local user = typefully_get_current_user()
print(user.name or user.handle)
```

### `typefully_list_social_sets`

```lua
local sets = typefully_list_social_sets({ limit = 20 })
for _, set in ipairs(sets.results or {}) do
  print(set.id, set.name, set.username)
end
```

### `typefully_get_social_set`

```lua
local set = typefully_get_social_set({ social_set_id = "social-set-test" })
print(set.name)
```

## Drafts

### `typefully_list_drafts`

List drafts with optional `status`, `tags`, `limit`, `offset`, and `sort` filters. Common statuses include `draft`, `scheduled`, and `published`.

```lua
local drafts = typefully_list_drafts({
  social_set_id = "social-set-test",
  status = "scheduled",
  limit = 10,
  sort = "scheduled_date",
})
```

### `typefully_list_scheduled`

Shortcut for listing drafts with `status = "scheduled"`.

```lua
local scheduled = typefully_list_scheduled({
  social_set_id = "social-set-test",
  limit = 10,
})
```

### `typefully_list_published`

Shortcut for listing drafts with `status = "published"`.

```lua
local published = typefully_list_published({
  social_set_id = "social-set-test",
  limit = 10,
})
```

### `typefully_get_draft`

```lua
local draft = typefully_get_draft({
  social_set_id = "social-set-test",
  draft_id = "draft-test",
})
print(draft.id, draft.status)
```

### `typefully_create_draft`

For full v2 control, pass the Typefully `platforms` structure. Supported platform keys include `x`, `linkedin`, `threads`, `bluesky`, and `mastodon`.

```lua
local draft = typefully_create_draft({
  social_set_id = "social-set-test",
  platforms = {
    x = {
      enabled = true,
      posts = {
        { text = "Just shipped a new feature." },
      },
    },
    linkedin = {
      enabled = true,
      posts = {
        { text = "We just shipped a new feature for teams." },
      },
    },
  },
  tags = { "product-launch" },
})
```

For a simple single-platform draft, pass `content` and optionally `platform`.

```lua
local draft = typefully_create_draft({
  social_set_id = "social-set-test",
  platform = "x",
  content = "Simple draft from an agent.",
})
```

To schedule or publish immediately, set `publish_at` to an ISO 8601 datetime, `"next-free-slot"`, or `"now"`.

```lua
local scheduled = typefully_create_draft({
  social_set_id = "social-set-test",
  content = "Scheduled for the next free slot.",
  publish_at = "next-free-slot",
})
```

### `typefully_update_draft`

Patch an existing draft. Only provided fields are sent.

```lua
local draft = typefully_update_draft({
  social_set_id = "social-set-test",
  draft_id = "draft-test",
  publish_at = "now",
  share = true,
})
```

### `typefully_delete_draft`

```lua
local result = typefully_delete_draft({
  social_set_id = "social-set-test",
  draft_id = "draft-test",
})
print(result.deleted)
```

## Media

### `typefully_request_media_upload`

Request a presigned upload URL. Upload the file bytes to the returned URL outside this tool, then check media status and attach the `media_id` to a draft post.

```lua
local upload = typefully_request_media_upload({
  social_set_id = "social-set-test",
  file_name = "launch.png",
  file_type = "image/png",
})
print(upload.media_id, upload.upload_url)
```

### `typefully_get_media`

```lua
local media = typefully_get_media({
  social_set_id = "social-set-test",
  media_id = "media-test",
})
print(media.status)
```

Attach ready media IDs in a draft:

```lua
local draft = typefully_create_draft({
  social_set_id = "social-set-test",
  platforms = {
    x = {
      enabled = true,
      posts = {
        { text = "Launch image attached.", media_ids = { "media-test" } },
      },
    },
  },
})
```

## Tags

### `typefully_list_tags`

```lua
local tags = typefully_list_tags({ social_set_id = "social-set-test" })
```

### `typefully_create_tag`

```lua
local tag = typefully_create_tag({
  social_set_id = "social-set-test",
  name = "Product Launch",
})
```

## Queue

### `typefully_get_queue`

Inspect upcoming scheduled content for a social set where the endpoint is available.

```lua
local queue = typefully_get_queue({
  social_set_id = "social-set-test",
  limit = 10,
})
```

## Return Shapes

Typefully v2 list endpoints commonly return paginated objects with fields such as `results`, `count`, `limit`, and `offset`. Draft and media tools return the Typefully API object for the requested resource. Delete tools return a compact confirmation object:

```lua
{ deleted = true, draft_id = "draft-test" }
```

## Multi-Account Usage

Use the namespace prefix assigned by the host:

```lua
local sets = ns_typefully_work.typefully_list_social_sets({ limit = 10 })
```
