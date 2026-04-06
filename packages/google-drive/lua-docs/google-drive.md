# Google Drive — Lua API Reference

## list_files

List files and folders in Google Drive. Supports filtering, pagination, and spaces.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `pageSize` | integer | no | Max files per page (default: 100, max: 1000) |
| `pageToken` | string | no | Token from previous response for pagination |
| `q` | string | no | Query string for filtering files |
| `spaces` | string | no | Comma-separated spaces: "drive", "appDataFolder", "photos" |
| `trashed` | boolean | no | Include trashed files (true/false) |
| `corpora` | string | no | Source: "user", "domain", "allDrives", or "drive" |
| `fields` | string | no | Fields to include in partial response |

### Query Examples

```
name = 'hello'                           -- exact name match
name contains 'report'                   -- name contains substring
mimeType = 'application/vnd.google-apps.folder'  -- folders only
mimeType != 'application/vnd.google-apps.folder' -- files only (no folders)
fullText contains 'invoice'              -- full-text search
modifiedTime > '2025-01-01T00:00:00'     -- modified after date
'parentId' in parents                    -- files in a specific folder
```

## Examples

### List recent files

```lua
local result = app.integrations.google_drive.list_files({
  pageSize = 20,
  fields = "files(id,name,mimeType,modifiedTime,size)"
})

for _, file in ipairs(result.files) do
  print(file.name .. " (" .. file.mimeType .. ")")
end
```

### List only folders

```lua
local result = app.integrations.google_drive.list_files({
  q = "mimeType = 'application/vnd.google-apps.folder'",
  fields = "files(id,name)"
})
```

### Paginate through results

```lua
local page = app.integrations.google_drive.list_files({ pageSize = 50 })

while page.files do
  for _, file in ipairs(page.files) do
    print(file.name)
  end

  if page.nextPageToken then
    page = app.integrations.google_drive.list_files({
      pageSize = 50,
      pageToken = page.nextPageToken
    })
  else
    break
  end
end
```

---

## get_file

Get metadata for a specific file or folder by its Google Drive file ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `fileId` | string | yes | The Google Drive file ID |
| `fields` | string | no | Fields to include in response |

### Example

```lua
local file = app.integrations.google_drive.get_file({
  fileId = "1aBcDeFgHiJkLmNoPqRsTuVwXyZ",
  fields = "id,name,mimeType,size,modifiedTime,webViewLink"
})

print(file.name .. " — " .. file.webViewLink)
```

---

## create_file

Create a new file metadata entry in Google Drive.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | File name (e.g., "Report.pdf") |
| `mimeType` | string | no | MIME type (e.g., "text/plain", "application/pdf") |
| `parents` | array | no | List of parent folder IDs |
| `description` | string | no | Short file description |

### Example

```lua
local file = app.integrations.google_drive.create_file({
  name = "Meeting Notes.txt",
  mimeType = "text/plain",
  parents = { "1aBcDeFgHiJkLmNoPqRsTuVwXyZ" }
})

print("Created: " .. file.id .. " — " .. file.name)
```

---

## create_folder

Create a new folder in Google Drive.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Folder name |
| `parentId` | string | no | Parent folder ID (root if omitted) |

### Example

```lua
local folder = app.integrations.google_drive.create_folder({
  name = "Project 2026",
  parentId = "1aBcDeFgHiJkLmNoPqRsTuVwXyZ"
})

print("Folder created: " .. folder.id .. " — " .. folder.name)
```

---

## list_changes

List changes to files in Google Drive. Used for detecting file additions, modifications, and deletions.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `pageSize` | integer | no | Max changes per page (default: 100, max: 1000) |
| `pageToken` | string | no | Token from previous response or startPageToken |
| `fields` | string | no | Fields to include in response |

### Example

```lua
local result = app.integrations.google_drive.list_changes({
  pageToken = "12345",
  pageSize = 50,
  fields = "changes(fileId,file(name,mimeType)),nextPageToken,newStartPageToken"
})

for _, change in ipairs(result.changes) do
  print(change.fileId .. ": " .. (change.file and change.file.name or "removed"))
end
```

---

## get_current_user

Get information about the authenticated user and their Drive storage quota.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `fields` | string | no | Fields to include (default: "user,storageQuota") |

### Example

```lua
local info = app.integrations.google_drive.get_current_user({})

print("User: " .. info.user.displayName)
print("Email: " .. info.user.emailAddress)
print("Storage: " .. (info.storageQuota.usage / 1073741824) .. " GB used of " .. (info.storageQuota.limit / 1073741824) .. " GB")
```

---

## Multi-Account Usage

If you have multiple Google Drive accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.google_drive.list_files({...})

-- Explicit default (portable across setups)
app.integrations.google_drive.default.list_files({...})

-- Named accounts
app.integrations.google_drive.work.list_files({...})
app.integrations.google_drive.personal.list_files({...})
```

All functions are identical across accounts — only the credentials differ.
