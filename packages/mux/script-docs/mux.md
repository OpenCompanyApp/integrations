# Mux — JavaScript API Reference

## list_assets

List video assets stored in Mux.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max assets to return (1–100, default: 25) |
| `page` | integer | no | Page offset, 0-indexed (default: 0) |

### Example

```js
var result = app.integrations.mux.list_assets({
  limit: 10,
  page: 0,
})

for (const asset of (result.data)) {
  console.log(asset.id + " — " + (asset.status || "unknown"))
}
```
---

## get_asset

Retrieve details of a specific video asset.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `asset_id` | string | yes | The ID of the asset to retrieve |

### Example

```js
var result = app.integrations.mux.get_asset({
  asset_id: "abc123xyz",
})

console.log("Status: " + result.data.status)
console.log("Duration: " + (result.data.duration || 0) + " seconds")
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

```js
var result = app.integrations.mux.create_asset({
  input: "https://storage.example.com/video.mp4",
  playback_policy: [ "public" ],
})

console.log("Created asset: " + result.data.id)
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

```js
var result = app.integrations.mux.list_live_streams({
  limit: 10,
})

for (const stream of (result.data)) {
  console.log(stream.id + " — " + (stream.status || "unknown"))
}
```
---

## get_live_stream

Retrieve details of a specific live stream.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `live_stream_id` | string | yes | The ID of the live stream to retrieve |

### Example

```js
var result = app.integrations.mux.get_live_stream({
  live_stream_id: "abc123xyz",
})

console.log("Status: " + result.data.status)
console.log("Stream key: " + (result.data.stream_key || "n/a"))
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

```js
var result = app.integrations.mux.create_live_stream({
  playback_policy: [ "public" ],
  new_asset_settings: {
    playback_policy: [ "public" ],
    mp4_support: "standard",
  }
})

console.log("Stream key: " + result.data.stream_key)
console.log("Stream ID: " + result.data.id)
```
---

## get_current_user

Get realtime viewer data from Mux Data.

### Parameters

None.

### Example

```js
var result = app.integrations.mux.get_current_user({})

for (const row of (result.data || [])) {
  console.log(row.view_id + ": " + row.viewer_count + " viewers")
}
```
---

## Multi-Account Usage

If you have multiple Mux accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.mux.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.mux.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.mux.production.function_name({ /* parameters */ })
app.integrations.mux.staging.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
