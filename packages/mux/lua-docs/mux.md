# Mux — Lua API Reference

## list_assets

List video assets stored in Mux.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max assets to return (1–100, default: 25) |
| `page` | integer | no | Page offset, 0-indexed (default: 0) |

### Example

```lua
local result = app.integrations.mux.list_assets({
  limit = 10,
  page = 0
})

for _, asset in ipairs(result.data) do
  print(asset.id .. " — " .. (asset.status or "unknown"))
end
```

---

## get_asset

Retrieve details of a specific video asset.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `asset_id` | string | yes | The ID of the asset to retrieve |

### Example

```lua
local result = app.integrations.mux.get_asset({
  asset_id = "abc123xyz"
})

print("Status: " .. result.data.status)
print("Duration: " .. (result.data.duration or 0) .. " seconds")
```

---

## create_asset

Create a new video asset from an input URL.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `input` | string | yes | URL of the video file to ingest |
| `playback_policy` | array | no | Playback policy: `["public"]` or `["signed"]` |

### Example

```lua
local result = app.integrations.mux.create_asset({
  input = "https://storage.example.com/video.mp4",
  playback_policy = { "public" }
})

print("Created asset: " .. result.data.id)
```

---

## list_live_streams

List live streams in Mux.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max live streams to return (1–100, default: 25) |
| `page` | integer | no | Page offset, 0-indexed (default: 0) |

### Example

```lua
local result = app.integrations.mux.list_live_streams({
  limit = 10
})

for _, stream in ipairs(result.data) do
  print(stream.id .. " — " .. (stream.status or "unknown"))
end
```

---

## get_live_stream

Retrieve details of a specific live stream.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `live_stream_id` | string | yes | The ID of the live stream to retrieve |

### Example

```lua
local result = app.integrations.mux.get_live_stream({
  live_stream_id = "abc123xyz"
})

print("Status: " .. result.data.status)
print("Stream key: " .. (result.data.stream_key or "n/a"))
```

---

## create_live_stream

Create a new live stream.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `playback_policy` | array | no | Playback policy: `["public"]` or `["signed"]` |
| `new_asset_settings` | object | no | Settings for assets created from this stream |

### Example

```lua
local result = app.integrations.mux.create_live_stream({
  playback_policy = { "public" },
  new_asset_settings = {
    playback_policy = { "public" },
    mp4_support = "standard"
  }
})

print("Stream key: " .. result.data.stream_key)
print("Stream ID: " .. result.data.id)
```

---

## get_current_user

Get realtime viewer data from Mux Data.

### Parameters

None.

### Example

```lua
local result = app.integrations.mux.get_current_user({})

for _, row in ipairs(result.data or {}) do
  print(row.view_id .. ": " .. row.viewer_count .. " viewers")
end
```

---

## Multi-Account Usage

If you have multiple Mux accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.mux.function_name({...})

-- Explicit default (portable across setups)
app.integrations.mux.default.function_name({...})

-- Named accounts
app.integrations.mux.production.function_name({...})
app.integrations.mux.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
