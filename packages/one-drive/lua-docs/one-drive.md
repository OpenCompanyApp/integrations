# Microsoft OneDrive Lua API Reference

Namespace: `app.integrations["one-drive"]`

This integration wraps Microsoft OneDrive through Microsoft Graph v1.0. Use it to inspect the signed-in user's drive, manage DriveItems, upload and download content, create sharing links, list permissions, track changes, and call relative Graph paths when a named tool does not exist.

## Drive And Items

```lua
local drive = app.integrations["one-drive"].onedrive_get_drive({})

local root = app.integrations["one-drive"].onedrive_list_files({
  top = 50
})

local children = app.integrations["one-drive"].onedrive_list_children({
  parent_id = "01ABCDEFOLDERID",
  top = 25
})

local item = app.integrations["one-drive"].onedrive_get_file({
  id = "01ABCDEITEMID"
})
```

`list_files` is a root-folder convenience wrapper. `list_children` can list root children when `parent_id` is omitted, or children of a specific folder item when `parent_id` is provided.

## Create, Update, Copy, Delete

```lua
local folder = app.integrations["one-drive"].onedrive_create_folder({
  name = "Reports",
  conflict_behavior = "rename"
})

local renamed = app.integrations["one-drive"].onedrive_update_item({
  id = "01ABCDEITEMID",
  name = "Q4 report.xlsx"
})

local copy = app.integrations["one-drive"].onedrive_copy_item({
  id = "01ABCDEITEMID",
  name = "Q4 report copy.xlsx"
})

local deleted = app.integrations["one-drive"].onedrive_delete_item({
  id = "01ABCDEITEMID"
})
```

`update_item` also accepts `parent_reference` for Graph move operations and `payload` for official DriveItem update fields. `copy_item` is asynchronous; Microsoft Graph usually returns a monitor URL.

## Upload And Download

```lua
local uploaded = app.integrations["one-drive"].onedrive_upload_file({
  path = "Reports/summary.txt",
  content = "Quarterly summary",
  content_type = "text/plain"
})

local file = app.integrations["one-drive"].onedrive_download_file({
  id = uploaded.id
})
```

Simple upload is intended for small files. For large upload sessions, use the generic API tools with the documented Graph upload-session endpoint.

## Search, Delta, Thumbnails

```lua
local matches = app.integrations["one-drive"].onedrive_search({
  query = "quarterly report"
})

local changes = app.integrations["one-drive"].onedrive_delta({})

local thumbs = app.integrations["one-drive"].onedrive_list_thumbnails({
  id = "01ABCDEITEMID"
})
```

Delta responses may include `@odata.nextLink` or `@odata.deltaLink`. Continue by calling the relative path from those links with `api_get`.

## Sharing And Permissions

```lua
local link = app.integrations["one-drive"].onedrive_create_sharing_link({
  id = "01ABCDEITEMID",
  type = "view",
  scope = "organization"
})

local permissions = app.integrations["one-drive"].onedrive_list_permissions({
  id = "01ABCDEITEMID"
})

app.integrations["one-drive"].onedrive_delete_permission({
  item_id = "01ABCDEITEMID",
  permission_id = "perm-id"
})
```

Sharing capabilities depend on tenant policy and token scopes. Prefer organization-scoped links unless anonymous links are explicitly allowed.

## Generic Graph API Tools

Use `api_get`, `api_post`, `api_patch`, and `api_delete` for documented Microsoft Graph paths that are not wrapped yet. Absolute URLs are rejected; pass paths such as `/me/drive/root/delta`, not full URLs.

```lua
local raw = app.integrations["one-drive"].onedrive_api_get({
  path = "/me/drive/recent"
})

local created = app.integrations["one-drive"].onedrive_api_post({
  path = "/me/drive/root/children",
  payload = {
    name = "Archive",
    folder = {}
  }
})
```

## Account

`get_current_user` returns the signed-in Microsoft Graph user profile. Multi-account namespaces expose the same tools:

```lua
app.integrations["one-drive"].onedrive_list_files({})
app.integrations["one-drive"].default.onedrive_list_files({})
app.integrations["one-drive"].work.onedrive_list_files({})
```
