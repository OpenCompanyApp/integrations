# Microsoft OneDrive — Lua API Reference

## list_files

List files and folders in the root of the user's OneDrive.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `top` | integer | no | Maximum number of items to return (default: 100, max: 999) |
| `skip_token` | string | no | Pagination token from a previous response |

### Response

Returns an object with `items`, `count`, and optionally `next_link` and `has_more`.

Each item contains:
- `id` — Drive item ID (use with get_file / download_file)
- `name` — File or folder name
- `type` — `"file"` or `"folder"`
- `size` — Size in bytes
- `created_at` — ISO 8601 creation date
- `modified_at` — ISO 8601 last modified date
- `web_url` — URL to view in browser
- `mime_type` — MIME type (files only)

### Examples

```lua
-- List all files in root
local result = app.integrations.one_drive.list_files({})

for _, item in ipairs(result.items) do
  print(item.name .. " (" .. item.type .. ", " .. item.size .. " bytes)")
end

-- Paginate through results
local result = app.integrations.one_drive.list_files({ top = 50 })

if result.has_more then
  -- Extract skip token from next_link and fetch more
  local next = app.integrations.one_drive.list_files({
    top = 50,
    skip_token = "extracted_token"
  })
end
```

---

## get_file

Get detailed metadata for a specific file or folder.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The unique drive item ID |

### Response

Returns detailed item metadata including download URL, parent reference, file hashes, and folder child count.

### Examples

```lua
local result = app.integrations.one_drive.get_file({ id = "01ABCD1234..." })

print("Name: " .. result.name)
print("Size: " .. result.size .. " bytes")
print("Type: " .. result.mime_type)
print("Download URL: " .. (result.download_url or "none"))
```

---

## upload_file

Upload a file to OneDrive. Creates or replaces the file at the specified path.

> Supports files up to 4 MB via the simple upload API.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `path` | string | yes | Destination path relative to root (e.g., `"Documents/report.txt"`) |
| `content` | string | yes | The file content to upload |
| `content_type` | string | no | MIME type (default: `"application/octet-stream"`) |

### Examples

```lua
-- Upload a text file
local result = app.integrations.one_drive.upload_file({
  path = "Documents/hello.txt",
  content = "Hello from the AI agent!",
  content_type = "text/plain"
})

print("Uploaded: " .. result.name .. " (" .. result.size .. " bytes)")

-- Upload JSON data
local result = app.integrations.one_drive.upload_file({
  path = "Data/output.json",
  content = '{"status": "ok", "count": 42}',
  content_type = "application/json"
})
```

---

## download_file

Download a file's content by its drive item ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The unique drive item ID |

### Response

Returns an object with:
- `content` — The raw file content as a string
- `size` — Content length in bytes
- `item_id` — The requested item ID

### Examples

```lua
local result = app.integrations.one_drive.download_file({ id = "01ABCD1234..." })

print("Downloaded " .. result.size .. " bytes")
print("Content: " .. result.content)
```

---

## list_shared

List files and folders shared with the current user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `top` | integer | no | Maximum number of items to return (default: 100, max: 999) |
| `skip_token` | string | no | Pagination token from a previous response |

### Examples

```lua
local result = app.integrations.one_drive.list_shared({})

for _, item in ipairs(result.items) do
  print("Shared: " .. item.name .. " (" .. item.type .. ")")
end
```

---

## get_current_user

Get the profile of the currently authenticated Microsoft user.

### Parameters

None.

### Response

Returns user profile information:
- `id` — Microsoft user ID
- `display_name` — Full name
- `email` — Email address
- `job_title` — Job title
- `office_location` — Office location
- `phone` — Business phone number

### Examples

```lua
local result = app.integrations.one_drive.get_current_user({})

print("User: " .. result.display_name)
print("Email: " .. result.email)
print("Title: " .. (result.job_title or "N/A"))
```

---

## Multi-Account Usage

If you have multiple OneDrive accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.one_drive.list_files({})

-- Explicit default (portable across setups)
app.integrations.one_drive.default.list_files({})

-- Named accounts
app.integrations.one_drive.work.list_files({})
app.integrations.one_drive.personal.list_files({})
```

All functions are identical across accounts — only the credentials differ.
