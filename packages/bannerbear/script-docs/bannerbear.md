# Bannerbear — JavaScript API Reference

## create_image

Generate an image from a Bannerbear template with custom modifications.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `template_id` | string | yes | Template UID (use `list_templates` to find) |
| `modifications` | array | yes | Array of modification objects (see below) |
| `width` | integer | no | Override template width (pixels) |
| `height` | integer | no | Override template height (pixels) |
| `transparent` | boolean | no | Render with transparent background (PNG only) |
| `metadata` | string | no | Custom metadata string (max 500 chars) |

### Modification Object

Each modification targets a named layer in the template:

```js
const example = {
  name: "layer_name",
  text: "Hello World", // for text layers,
  image_url: "https://...", // for image layers,
  color: "#FF0000", // for shape/color layers,
  barcode: "123456789" // for barcode layers,
}
```
### Examples

```js
var result = app.integrations.bannerbear.create_image({
  template_id: "01H8XYZ...",
  modifications: [
    { name: "title", text: "Weekly Report" },
    { name: "subtitle", text: "Q1 2026" },
    { name: "photo", image_url: "https://example.com/photo.jpg" },
    { name: "bg_color", color: "#1a1a2e" }
  ]
})

console.log(result.uid) // image UID for polling
console.log(result.status) // "pending", "in_progress", || "completed"
```
---

## get_image

Retrieve the status and URL of a previously created image.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `image_id` | string | yes | Image UID from `create_image` |

### Example

```js
var result = app.integrations.bannerbear.get_image({
  image_id: "01H8ABC...",
})

if (result.status === "completed") {
  console.log(result.image_url) // download URL for the generated image
} else {
  console.log("Status: " + result.status) // "pending" || "in_progress"
}
```
---

## create_video

Generate a video from a Bannerbear template.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `template_id` | string | yes | Template UID |
| `modifications` | array | yes | Array of modification objects per scene |
| `fps` | integer | no | Frames per second |
| `trim` | string | no | Trim as "start,end" in seconds (e.g., "0,5") |
| `metadata` | string | no | Custom metadata string (max 500 chars) |

### Example

```js
var result = app.integrations.bannerbear.create_video({
  template_id: "01H8XYZ...",
  modifications: [
    { name: "headline", text: "Welcome!" },
    { name: "background", image_url: "https://example.com/bg.jpg" }
  ],
  fps: 30,
})

console.log(result.uid)
```
---

## get_video

Retrieve the status and URL of a previously created video.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `video_id` | string | yes | Video UID from `create_video` |

### Example

```js
var result = app.integrations.bannerbear.get_video({
  video_id: "01H8DEF...",
})

if (result.status === "completed") {
  console.log(result.video_url)
} else {
  console.log("Status: " + result.status)
}
```
---

## list_templates

List all available Bannerbear templates.

### Parameters

None.

### Example

```js
var result = app.integrations.bannerbear.list_templates()

for (const tpl of (result)) {
  console.log(tpl.uid + " — " + tpl.name + " (" + tpl.width + "x" + tpl.height + ")")
}
```
---

## get_template

Get details and modification layers for a specific template.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `template_id` | string | yes | Template UID |

### Example

```js
var result = app.integrations.bannerbear.get_template({
  template_id: "01H8XYZ...",
})

console.log("Template: " + result.name)
for (const layer of (result.modification_layers || [])) {
  console.log("  Layer: " + layer.name + " (" + layer.type + ")")
}
```
---

## create_animated_gif

Generate an animated GIF from a Bannerbear template.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `template_id` | string | yes | Template UID |
| `modifications` | array | yes | Array of modification objects per frame |
| `fps` | integer | no | Frames per second |
| `metadata` | string | no | Custom metadata string (max 500 chars) |

### Example

```js
var result = app.integrations.bannerbear.create_animated_gif({
  template_id: "01H8XYZ...",
  modifications: [
    { name: "frame_text", text: "Frame 1" },
    { name: "frame_text", text: "Frame 2" },
    { name: "frame_text", text: "Frame 3" }
  ],
  fps: 10,
})

console.log(result.uid)
```
---

## list_images

List previously created Bannerbear images with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (1-based, defaults to 1) |
| `limit` | integer | no | Results per page (defaults to 20) |

### Example

```js
var result = app.integrations.bannerbear.list_images({
  page: 1,
  limit: 10,
})

for (const img of (result)) {
  console.log(img.uid + " — " + img.status)
}
```
---

## list_collections

List Bannerbear collections with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (1-based, defaults to 1) |
| `limit` | integer | no | Results per page (defaults to 20) |

### Example

```js
var result = app.integrations.bannerbear.list_collections({
  page: 1,
  limit: 10,
})

for (const col of (result)) {
  console.log(col.uid + " — " + (col.name || "untitled"))
}
```
---

## get_current_user

Get the authenticated Bannerbear account details.

### Parameters

None.

### Example

```js
var result = app.integrations.bannerbear.get_current_user({})

console.log("Account: " + result.name)
console.log("Email: " + result.email)
```
---

## Multi-Account Usage

If you have multiple Bannerbear accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.bannerbear.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.bannerbear.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.bannerbear.production.function_name({ /* parameters */ })
app.integrations.bannerbear.staging.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
