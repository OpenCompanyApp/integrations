# Loom — Ruby API Reference

## list_videos

List Loom videos with pagination support.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of videos to return (default: 20, max: 50) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Examples

#### List recent videos

```ruby
result = app.integrations.loom.list_videos(limit: 10, page: 1)
result.videos.each do |video|
  puts((video.id).to_s + ": " + (video.title).to_s)
end
```
#### Paginate through all videos

```ruby
page = 1
limit = 50
# Bound pagination; persist the next cursor if more pages remain.
10.times do
  result = app.integrations.loom.list_videos(limit: limit, page: page)
  (result.videos || []).each do |video|
    puts(video.title)
  end
  page = (page + 1)
  break unless (!((result.length == 0) || (result.length < limit)))
end
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

```ruby
result = app.integrations.loom.get_video(video_id: "abc123-def456")
puts(result.title)
puts(result.duration)
puts(result.playback_url)
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

```ruby
result = app.integrations.loom.create_video(title: "Sprint Review - Week 14", description: "Weekly sprint review covering completed features && blockers.")
puts("Created video: " + (result.id).to_s)
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

```ruby
result = app.integrations.loom.delete_video(video_id: "abc123-def456")
puts(result)
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

```ruby
result = app.integrations.loom.list_folders(limit: 20, page: 1)
(result.folders || result).each do |folder|
  puts((folder.name).to_s + " (ID: " + (folder.id).to_s + ")")
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

```ruby
result = app.integrations.loom.get_folder(folder_id: "folder-abc123")
puts(result.name)
puts("Video count: " + (result.video_count).to_s)
```
---

## list_workspaces

List all Loom workspaces accessible to the authenticated user.

### Parameters

No parameters required.

### Examples

#### List workspaces

```ruby
result = app.integrations.loom.list_workspaces()
(result.workspaces || result).each do |workspace|
  puts((workspace.name).to_s + " (ID: " + (workspace.id).to_s + ")")
end
```
---

## get_current_user

Get the authenticated Loom user's profile information.

### Parameters

No parameters required.

### Examples

#### Get current user profile

```ruby
result = app.integrations.loom.get_current_user()
puts("Logged in as: " + (result.name).to_s + " (" + (result.email).to_s + ")")
```
---

## Multi-Account Usage

If you have multiple Loom accounts configured, use account-specific namespaces:

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
