# Loom — Lua API Reference

## list_videos

List Loom videos with pagination support.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of videos to return (default: 20, max: 50) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Examples

#### List recent videos

```lua
local result = app.integrations.loom.list_videos({
  limit = 10,
  page = 1
})

for _, video in ipairs(result.videos) do
  print(video.id .. ": " .. video.title)
end
```

#### Paginate through all videos

```lua
local page = 1
local limit = 50

repeat
  local result = app.integrations.loom.list_videos({
    limit = limit,
    page = page
  })

  for _, video in ipairs(result.videos or {}) do
    print(video.title)
  end

  page = page + 1
until #result == 0 or #result < limit
```

---

## get_video

Get detailed information about a specific Loom video.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `video_id` | string | yes | The unique identifier of the Loom video |

### Examples

#### Get video details

```lua
local result = app.integrations.loom.get_video({
  video_id = "abc123-def456"
})

print(result.title)
print(result.duration)
print(result.playback_url)
```

---

## create_video

Create a new Loom video placeholder with a title and optional description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `title` | string | yes | The title of the video |
| `description` | string | no | An optional description for the video |

### Examples

#### Create a video

```lua
local result = app.integrations.loom.create_video({
  title = "Sprint Review - Week 14",
  description = "Weekly sprint review covering completed features and blockers."
})

print("Created video: " .. result.id)
```

---

## delete_video

Delete a Loom video permanently. This action cannot be undone.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `video_id` | string | yes | The unique identifier of the video to delete |

### Examples

#### Delete a video

```lua
local result = app.integrations.loom.delete_video({
  video_id = "abc123-def456"
})

print(result)
```

---

## list_folders

List Loom folders with pagination support.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of folders to return (default: 20) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Examples

#### List folders

```lua
local result = app.integrations.loom.list_folders({
  limit = 20,
  page = 1
})

for _, folder in ipairs(result.folders or result) do
  print(folder.name .. " (ID: " .. folder.id .. ")")
end
```

---

## get_folder

Get detailed information about a specific Loom folder.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `folder_id` | string | yes | The unique identifier of the Loom folder |

### Examples

#### Get folder details

```lua
local result = app.integrations.loom.get_folder({
  folder_id = "folder-abc123"
})

print(result.name)
print("Video count: " .. result.video_count)
```

---

## list_workspaces

List all Loom workspaces accessible to the authenticated user.

### Parameters

No parameters required.

### Examples

#### List workspaces

```lua
local result = app.integrations.loom.list_workspaces({})

for _, workspace in ipairs(result.workspaces or result) do
  print(workspace.name .. " (ID: " .. workspace.id .. ")")
end
```

---

## get_current_user

Get the authenticated Loom user's profile information.

### Parameters

No parameters required.

### Examples

#### Get current user profile

```lua
local result = app.integrations.loom.get_current_user({})

print("Logged in as: " .. result.name .. " (" .. result.email .. ")")
```

---

## Multi-Account Usage

If you have multiple Loom accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.loom.function_name({...})

-- Explicit default (portable across setups)
app.integrations.loom.default.function_name({...})

-- Named accounts
app.integrations.loom.work.function_name({...})
app.integrations.loom.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
