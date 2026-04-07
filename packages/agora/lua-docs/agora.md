# Agora — Lua API Reference

## list_projects

List all Agora projects.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| — | — | — | No parameters required |

### Example

```lua
local result = app.integrations["agora"].list_projects({})

for _, project in ipairs(result.data) do
  print(project.id .. ": " .. project.name .. " (" .. project.status .. ")")
end
```

---

## get_project

Get details of a specific project by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The project ID |

### Example

```lua
local result = app.integrations["agora"].get_project({
  project_id = "abc123"
})

print("Project: " .. result.name)
print("App ID: " .. result.app_id)
print("Status: " .. result.status)
```

---

## create_project

Create a new Agora project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | A unique name for the project |
| `recording_config` | object | no | Recording configuration (e.g., max_idle_time, stream_types) |
| `sign_key` | boolean | no | Whether to enable a signaling key (default: false) |

### Example

```lua
local result = app.integrations["agora"].create_project({
  name = "my-video-app",
  sign_key = true
})

print("Created project: " .. result.name)
print("App ID: " .. result.app_id)
```

---

## list_recordings

List cloud recordings with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `cname` | string | no | Filter by channel name |
| `resource_id` | string | no | Filter by resource ID |
| `limit` | integer | no | Maximum results (default: 20) |
| `start_ts` | integer | no | Unix timestamp to filter recordings starting after this time |
| `end_ts` | integer | no | Unix timestamp to filter recordings ending before this time |

### Example

```lua
local result = app.integrations["agora"].list_recordings({
  cname = "meeting-room",
  limit = 10
})

for _, rec in ipairs(result.data) do
  print(rec.sid .. ": " .. rec.cname .. " (" .. rec.status .. ")")
end
```

---

## get_recording

Get details of a specific recording by session ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `recording_id` | string | yes | The recording session ID (sid) |

### Example

```lua
local result = app.integrations["agora"].get_recording({
  recording_id = "sid-abc123"
})

print("SID: " .. result.sid)
print("Channel: " .. result.cname)
print("Status: " .. result.status)
if result.file_list then
  for _, file in ipairs(result.file_list) do
    print("  File: " .. file.filename .. " -> " .. file.download_url)
  end
end
```

---

## start_recording

Start a cloud recording for a channel.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `cname` | string | yes | The channel name to record |
| `uid` | string | yes | User ID of the recording client in the channel |
| `clientRequest` | object | no | Recording and storage configuration |

### clientRequest Syntax

```lua
clientRequest = {
  recordingConfig = {
    maxIdleTime = 30,
    streamTypes = 2,
    channelType = 0
  },
  storageConfig = {
    vendor = 1,
    region = 0,
    bucket = "my-bucket",
    accessKey = "...",
    secretKey = "...",
    fileNamePrefix = { "recording" }
  }
}
```

### Example

```lua
local result = app.integrations["agora"].start_recording({
  cname = "meeting-room",
  uid = "527841",
  clientRequest = {
    recordingConfig = {
      maxIdleTime = 30,
      streamTypes = 2
    },
    storageConfig = {
      vendor = 1,
      region = 0,
      bucket = "my-recordings",
      accessKey = "AKIA...",
      secretKey = "secret...",
      fileNamePrefix = { "agora", "rec" }
    }
  }
})

print("Recording started: " .. result.sid)
print("Resource ID: " .. result.resourceId)
```

---

## get_current_user

Get information about the current authenticated Agora user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| — | — | — | No parameters required |

### Example

```lua
local result = app.integrations["agora"].get_current_user({})

print("User: " .. result.user.name)
print("Email: " .. result.user.email)
```

---

## Multi-Account Usage

If you have multiple Agora accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["agora"].function_name({...})

-- Explicit default (portable across setups)
app.integrations["agora"].default.function_name({...})

-- Named accounts
app.integrations["agora"].production.function_name({...})
app.integrations["agora"].staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
