# Box — Lua API Reference

## list_files

List files and folders in a Box folder.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `folder_id` | string | no | The folder ID to list. Use `"0"` for root. Default: `"0"` |
| `limit` | integer | no | Max items to return (1–1000, default: 100) |
| `offset` | integer | no | Zero-based offset for pagination (default: 0) |

### Examples

```lua
-- List root folder contents
local result = app.integrations.box.list_files({ folder_id = "0" })

for _, item in ipairs(result.items) do
  print(item.type .. ": " .. item.name .. " (id=" .. item.id .. ")")
end
```

```lua
-- Paginate through a large folder
local result = app.integrations.box.list_files({
  folder_id = "12345",
  limit = 50,
  offset = 0
})

print("Total: " .. result.total_count)
print("Has more: " .. tostring(result.has_more))
```

---

## get_file

Get metadata for a Box file by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file_id` | string | yes | The Box file ID |

### Examples

```lua
local result = app.integrations.box.get_file({ file_id = "12345" })
print("Name: " .. result.name)
print("Size: " .. result.size .. " bytes")
print("Modified: " .. result.modified_at)
```

---

## upload_file

Upload a file to Box.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file_name` | string | yes | File name including extension (e.g., `"report.pdf"`) |
| `content` | string | yes | File contents as a string |
| `parent_folder_id` | string | no | Parent folder ID. Default: `"0"` (root) |

### Examples

```lua
local result = app.integrations.box.upload_file({
  file_name = "notes.txt",
  content = "Hello, this is a test file.",
  parent_folder_id = "0"
})

print("Uploaded: " .. result.name .. " (id=" .. result.id .. ")")
```

---

## download_file

Download a file's contents from Box.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file_id` | string | yes | The Box file ID to download |

### Examples

```lua
local result = app.integrations.box.download_file({ file_id = "12345" })
print("Downloaded " .. result.size .. " bytes")
-- result.content contains the raw file contents
```

---

## delete_file

Delete a file from Box (moves to trash).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file_id` | string | yes | The Box file ID to delete |

### Examples

```lua
local result = app.integrations.box.delete_file({ file_id = "12345" })
print(result.message) -- "File '12345' has been deleted..."
```

---

## create_folder

Create a new folder in Box.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The folder name |
| `parent_folder_id` | string | no | Parent folder ID. Default: `"0"` (root) |

### Examples

```lua
local result = app.integrations.box.create_folder({
  name = "Project Documents",
  parent_folder_id = "0"
})

print("Created folder: " .. result.name .. " (id=" .. result.id .. ")")
```

---

## get_folder

Get metadata for a Box folder.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `folder_id` | string | yes | The Box folder ID. Use `"0"` for root |

### Examples

```lua
local result = app.integrations.box.get_folder({ folder_id = "12345" })
print("Folder: " .. result.name)
print("Size: " .. result.size .. " bytes")
```

---

## share_file

Create a shared link for a Box file.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file_id` | string | yes | The Box file ID to share |
| `access` | string | no | Access level: `"open"`, `"company"`, or `"collaborators"` |
| `password` | string | no | Optional password to protect the link |
| `expires_at` | string | no | Expiration timestamp (ISO 8601, e.g., `"2026-12-31T23:59:59Z"`) |

### Examples

```lua
-- Create an open shared link
local result = app.integrations.box.share_file({ file_id = "12345" })
print("Shared link: " .. result.shared_link)
```

```lua
-- Create a password-protected link with expiration
local result = app.integrations.box.share_file({
  file_id = "12345",
  access = "open",
  password = "s3cret!",
  expires_at = "2026-12-31T23:59:59Z"
})

print("Shared link: " .. result.shared_link)
```

---

## search

Search for files and folders in Box.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | The search query string |
| `limit` | integer | no | Max results (1–200, default: 50) |
| `offset` | integer | no | Zero-based offset for pagination (default: 0) |

### Examples

```lua
local result = app.integrations.box.search({ query = "quarterly report" })

for _, item in ipairs(result.items) do
  print(item.type .. ": " .. item.name .. " (id=" .. item.id .. ")")
end

print("Total matches: " .. result.total_count)
```

---

## get_current_user

Get the currently authenticated Box user.

### Parameters

None.

### Examples

```lua
local result = app.integrations.box.get_current_user({})
print("User: " .. result.name .. " (" .. result.login .. ")")
print("Enterprise: " .. tostring(result.enterprise))
```

---

## Multi-Account Usage

If you have multiple Box accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.box.list_files({ folder_id = "0" })

-- Explicit default (portable across setups)
app.integrations.box.default.list_files({ folder_id = "0" })

-- Named accounts
app.integrations.box.work.list_files({ folder_id = "0" })
app.integrations.box.personal.upload_file({
  file_name = "notes.txt",
  content = "Hello"
})
```

All functions are identical across accounts — only the credentials differ.
