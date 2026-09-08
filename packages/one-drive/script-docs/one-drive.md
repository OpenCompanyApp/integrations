# Microsoft OneDrive Ruby API Reference

Namespace: `app.integrations["one-drive"]`

This integration wraps Microsoft OneDrive through Microsoft Graph v1.0. Use it to inspect the signed-in user's drive, manage DriveItems, upload and download content, create sharing links, list permissions, track changes, and call relative Graph paths when a named tool does not exist.

## Drive And Items

```ruby
drive = app.call("integrations.one-drive.get")
root = app.call("integrations.one-drive.list_files", top: 50)
children = app.call("integrations.one-drive.list_children", parent_id: "01ABCDEFOLDERID", top: 25)
item = app.call("integrations.one-drive.get_file", id: "01ABCDEITEMID")
```
`list_files` is a root-folder convenience wrapper. `list_children` can list root children when `parent_id` is omitted, or children of a specific folder item when `parent_id` is provided.

## Create, Update, Copy, Delete

```ruby
folder = app.call("integrations.one-drive.create_folder", name: "Reports", conflict_behavior: "rename")
renamed = app.call("integrations.one-drive.update_item", id: "01ABCDEITEMID", name: "Q4 report.xlsx")
copy = app.call("integrations.one-drive.copy_item", id: "01ABCDEITEMID", name: "Q4 report copy.xlsx")
deleted = app.call("integrations.one-drive.delete_item", id: "01ABCDEITEMID")
```
`update_item` also accepts `parent_reference` for Graph move operations and `payload` for official DriveItem update fields. `copy_item` is asynchronous; Microsoft Graph usually returns a monitor URL.

## Upload And Download

```ruby
uploaded = app.call("integrations.one-drive.upload_file", path: "Reports/summary.txt", content: "Quarterly summary", content_type: "text/plain")
file = app.call("integrations.one-drive.download_file", id: uploaded.id)
```
Simple upload is intended for small files. For large upload sessions, use the generic API tools with the documented Graph upload-session endpoint.

## Search, Delta, Thumbnails

```ruby
matches = app.call("integrations.one-drive.search", query: "quarterly report")
changes = app.call("integrations.one-drive.delta")
thumbs = app.call("integrations.one-drive.list_thumbnails", id: "01ABCDEITEMID")
```
Delta responses may include `@odata.nextLink` or `@odata.deltaLink`. Continue by calling the relative path from those links with `api_get`.

## Sharing And Permissions

```ruby
link = app.call("integrations.one-drive.create_sharing_link", id: "01ABCDEITEMID", type: "view", scope: "organization")
permissions = app.call("integrations.one-drive.list_permissions", id: "01ABCDEITEMID")
app.call("integrations.one-drive.delete_permission", item_id: "01ABCDEITEMID", permission_id: "perm-id")
```
Sharing capabilities depend on tenant policy and token scopes. Prefer organization-scoped links unless anonymous links are explicitly allowed.

## Generic Graph API Tools

Use `api_get`, `api_post`, `api_patch`, and `api_delete` for documented Microsoft Graph paths that are not wrapped yet. Absolute URLs are rejected; pass paths such as `/me/drive/root/delta`, not full URLs.

```ruby
raw = app.call("integrations.one-drive.api_get", path: "/me/drive/recent")
created = app.call("integrations.one-drive.api_post", path: "/me/drive/root/children", payload: {name: "Archive", folder: {}})
```
## Account

`get_current_user` returns the signed-in Microsoft Graph user profile. Multi-account namespaces expose the same tools:

```ruby
app.call("integrations.one-drive.list_files")
app.call("integrations.one-drive.default.list_files")
app.call("integrations.one-drive.work.list_files")
```