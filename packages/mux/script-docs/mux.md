# Mux — Ruby API Reference

## list_assets

List video assets stored in Mux.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max assets to return (1–100, default: 25) |
| `page` | integer | no | Page offset, 0-indexed (default: 0) |

### Example

```ruby
result = app.integrations.mux.list_assets(limit: 10, page: 0)
result.data.each do |asset|
  puts((asset.id).to_s + " — " + ((asset.status || "unknown")).to_s)
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

```ruby
result = app.integrations.mux.get_asset(asset_id: "abc123xyz")
puts("Status: " + (result.data.status).to_s)
puts("Duration: " + ((result.data.duration || 0)).to_s + " seconds")
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

```ruby
result = app.integrations.mux.create_asset(input: "https://storage.example.com/video.mp4", playback_policy: ["public"])
puts("Created asset: " + (result.data.id).to_s)
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

```ruby
result = app.integrations.mux.list_live_streams(limit: 10)
result.data.each do |stream|
  puts((stream.id).to_s + " — " + ((stream.status || "unknown")).to_s)
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

```ruby
result = app.integrations.mux.get_live_stream(live_stream_id: "abc123xyz")
puts("Status: " + (result.data.status).to_s)
puts("Stream key: " + ((result.data.stream_key || "n/a")).to_s)
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

```ruby
result = app.integrations.mux.create_live_stream(playback_policy: ["public"], new_asset_settings: {playback_policy: ["public"], mp4_support: "standard"})
puts("Stream key: " + (result.data.stream_key).to_s)
puts("Stream ID: " + (result.data.id).to_s)
```
---

## get_current_user

Get realtime viewer data from Mux Data.

### Parameters

None.

### Example

```ruby
result = app.integrations.mux.get_realtime_data()
(result.data || []).each do |row|
  puts((row.view_id).to_s + ": " + (row.viewer_count).to_s + " viewers")
end
```
---

## Multi-Account Usage

If you have multiple Mux accounts configured, use account-specific namespaces:

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
