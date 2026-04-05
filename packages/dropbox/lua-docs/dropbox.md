# HTTP client for the Dropbox API v2 — Lua API Reference

## dropbox_copy

Copy a file or folder to a new location in Dropbox. Both from_path and to_path are required. Set allow_shared_folder to true to copy shared folders..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `from_path` | string | yes | Source path of the file or folder, e.g.  |
| `to_path` | string | yes | Destination path, e.g.  |
| `autorename` | boolean | no | If true and a file exists at to_path, auto-rename. Default: false. |
| `allow_shared_folder` | boolean | no | If true, allows copying shared folders. Default: false. |

### Example

```lua
local result = app.integrations.dropbox.dropbox_copy({
  from_path = ""
  to_path = ""
  autorename = true
})
```

## dropbox_create_folder

Create a new folder in Dropbox at the specified path. Parent folders are created automatically. Set autorename to true to avoid conflicts with existing folders..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `path` | string | yes | Path for the new folder, e.g.  |
| `autorename` | boolean | no | If true and a folder with the same name exists, auto-rename. Default: false. |

### Example

```lua
local result = app.integrations.dropbox.dropbox_create_folder({
  path = ""
  autorename = true
})
```

## dropbox_create_shared_link

Create a shared link for a file or folder in Dropbox. Optionally configure link settings such as access level, password, and expiry..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `path` | string | yes | Path to the file or folder to share, e.g.  |
| `settings` | string | no | Link settings object. Keys: requested_visibility ( |

### Example

```lua
local result = app.integrations.dropbox.dropbox_create_shared_link({
  path = ""
  settings = ""
})
```

## dropbox_delete

Delete a file or folder at the given path in Dropbox. This action can be undone within the recovery window by restoring the file from revisions..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `path` | string | yes | Path to the file or folder to delete, e.g.  |

### Example

```lua
local result = app.integrations.dropbox.dropbox_delete({
  path = ""
})
```

## dropbox_download_file

Download a file from Dropbox. Returns the raw file content. The path must reference a file (not a folder)..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `path` | string | yes | Path to the file in Dropbox, e.g.  |

### Example

```lua
local result = app.integrations.dropbox.dropbox_download_file({
  path = ""
})
```

## dropbox_get_current_account

Get information about the currently authenticated Dropbox account, including display name, email, account type, and usage quota..

### Example

```lua
local result = app.integrations.dropbox.dropbox_get_current_account({
})
```

## dropbox_get_metadata

Get metadata for a file or folder in Dropbox. Returns name, path, size, modified time, and type. Optionally include media info for photos/videos or include deleted files..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `path` | string | yes | Path to the file or folder, e.g.  |
| `include_media_info` | boolean | no | If true, include media metadata (dimensions, GPS, etc.) for photos and videos. Default: false. |
| `include_deleted` | boolean | no | If true, include deleted files in the response. Default: false. |

### Example

```lua
local result = app.integrations.dropbox.dropbox_get_metadata({
  path = ""
  include_media_info = true
  include_deleted = true
})
```

## dropbox_get_temporary_link

Get a temporary link to stream a file from Dropbox. The link expires after a short time. Returns both the file metadata and the temporary link URL..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `path` | string | yes | Path to the file, e.g.  |

### Example

```lua
local result = app.integrations.dropbox.dropbox_get_temporary_link({
  path = ""
})
```

## dropbox_list_folder

List files and folders in a Dropbox directory. Use an empty string.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `path` | string | no | Path to the folder. Use empty string  |
| `recursive` | boolean | no | If true, list all nested content recursively. Default: false. |
| `limit` | integer | no | Maximum number of entries to return per call (1-2000). Default: 1000. |

### Example

```lua
local result = app.integrations.dropbox.dropbox_list_folder({
  path = ""
  recursive = true
  limit = 0
})
```

## dropbox_list_folder_continue

Continue listing files and folders using the cursor from a previous dropbox_list_folder or dropbox_list_folder_continue call. Use this when the previous response has has_more=true..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `cursor` | string | yes | The cursor returned by the previous list_folder or list_folder_continue call. |

### Example

```lua
local result = app.integrations.dropbox.dropbox_list_folder_continue({
  cursor = ""
})
```

## dropbox_list_revisions

List revisions of a file in Dropbox. Returns previous versions with revision IDs that can be used with dropbox_restore to recover an earlier version..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `path` | string | yes | Path to the file, e.g.  |
| `limit` | integer | no | Maximum number of revisions to return (1-100). Default: 10. |

### Example

```lua
local result = app.integrations.dropbox.dropbox_list_revisions({
  path = ""
  limit = 0
})
```

## dropbox_list_shared_links

List shared links for a specific file or folder, or list all shared links. Optionally filter by path or paginate with a cursor..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `path` | string | no | Path to a file or folder to filter links. Omit to list all shared links. |
| `cursor` | string | no | Cursor for pagination from a previous response. |

### Example

```lua
local result = app.integrations.dropbox.dropbox_list_shared_links({
  path = ""
  cursor = ""
})
```

## dropbox_move

Move a file or folder to a new location in Dropbox. Both from_path and to_path are required. Set allow_shared_folder to true to move shared folders..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `from_path` | string | yes | Current path of the file or folder, e.g.  |
| `to_path` | string | yes | Destination path, e.g.  |
| `autorename` | boolean | no | If true and a file exists at to_path, auto-rename. Default: false. |
| `allow_shared_folder` | boolean | no | If true, allows moving shared folders. Default: false. |

### Example

```lua
local result = app.integrations.dropbox.dropbox_move({
  from_path = ""
  to_path = ""
  autorename = true
})
```

## dropbox_restore

Restore a file to a specific revision in Dropbox. Use dropbox_list_revisions to find the revision ID, then restore the file to that version..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `path` | string | yes | Path to the file to restore, e.g.  |
| `rev` | string | yes | The revision ID to restore to, obtained from dropbox_list_revisions. |

### Example

```lua
local result = app.integrations.dropbox.dropbox_restore({
  path = ""
  rev = ""
})
```

## dropbox_search_continue

Continue a search using the cursor from a previous dropbox_search_files or dropbox_search_continue call. Use when the previous response has has_more=true..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `cursor` | string | yes | The cursor returned by the previous search call. |

### Example

```lua
local result = app.integrations.dropbox.dropbox_search_continue({
  cursor = ""
})
```

## dropbox_search_files

Search for files and folders in Dropbox by name or content. Returns matching entries with metadata. Optionally filter by path or file category. If has_more is true, use dropbox_search_continue with the cursor..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | The search query string. |
| `path` | string | no | Optional path to scope the search, e.g.  |
| `file_categories` | array | no | Filter by file categories, e.g. [ |
| `max_results` | integer | no | Maximum number of results to return (1-1000). Default: 100. |

### Example

```lua
local result = app.integrations.dropbox.dropbox_search_files({
  query = ""
  path = ""
  file_categories = {}
})
```

## dropbox_upload_file

Upload a file to Dropbox. The file content is sent as the request body. Supports add (default), overwrite, and update write modes. The path must start with a slash (e.g.,.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `path` | string | yes | Destination path in Dropbox, e.g.  |
| `content` | string | yes | The raw file content to upload. |
| `mode` | string | no | Write mode:  |
| `autorename` | boolean | no | If true and a file already exists, Dropbox will auto-rename. Default: false. |
| `mute` | boolean | no | If true, suppresses notifications on the file. Default: false. |

### Example

```lua
local result = app.integrations.dropbox.dropbox_upload_file({
  path = ""
  content = ""
  mode = ""
})
```
