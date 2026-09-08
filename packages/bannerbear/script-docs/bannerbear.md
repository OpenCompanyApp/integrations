# Bannerbear — Ruby API Reference

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

```ruby
example = {name: "layer_name", text: "Hello World", image_url: "https://...", color: "#FF0000", barcode: "123456789"}
```
### Examples

```ruby
result = app.integrations.bannerbear.create_image(template_id: "01H8XYZ...", modifications: [{name: "title", text: "Weekly Report"}, {name: "subtitle", text: "Q1 2026"}, {name: "photo", image_url: "https://example.com/photo.jpg"}, {name: "bg_color", color: "#1a1a2e"}])
puts(result.uid)
# image UID for polling
puts(result.status)
```
---

## get_image

Retrieve the status and URL of a previously created image.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `image_id` | string | yes | Image UID from `create_image` |

### Example

```ruby
result = app.integrations.bannerbear.get_image(image_id: "01H8ABC...")
if (result.status == "completed")
  puts(result.image_url)
else
  puts("Status: " + (result.status).to_s)
end
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

```ruby
result = app.integrations.bannerbear.create_video(template_id: "01H8XYZ...", modifications: [{name: "headline", text: "Welcome!"}, {name: "background", image_url: "https://example.com/bg.jpg"}], fps: 30)
puts(result.uid)
```
---

## get_video

Retrieve the status and URL of a previously created video.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `video_id` | string | yes | Video UID from `create_video` |

### Example

```ruby
result = app.integrations.bannerbear.get_video(video_id: "01H8DEF...")
if (result.status == "completed")
  puts(result.video_url)
else
  puts("Status: " + (result.status).to_s)
end
```
---

## list_templates

List all available Bannerbear templates.

### Parameters

None.

### Example

```ruby
result = app.integrations.bannerbear.list_templates()
result.each do |tpl|
  puts((tpl.uid).to_s + " — " + (tpl.name).to_s + " (" + (tpl.width).to_s + "x" + (tpl.height).to_s + ")")
end
```
---

## get_template

Get details and modification layers for a specific template.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `template_id` | string | yes | Template UID |

### Example

```ruby
result = app.integrations.bannerbear.get_template(template_id: "01H8XYZ...")
puts("Template: " + (result.name).to_s)
(result.modification_layers || []).each do |layer|
  puts("  Layer: " + (layer.name).to_s + " (" + (layer.type).to_s + ")")
end
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

```ruby
result = app.integrations.bannerbear.create_animated_gif(template_id: "01H8XYZ...", modifications: [{name: "frame_text", text: "Frame 1"}, {name: "frame_text", text: "Frame 2"}, {name: "frame_text", text: "Frame 3"}], fps: 10)
puts(result.uid)
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

```ruby
result = app.integrations.bannerbear.list_images(page: 1, limit: 10)
result.each do |img|
  puts((img.uid).to_s + " — " + (img.status).to_s)
end
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

```ruby
result = app.integrations.bannerbear.list_collections(page: 1, limit: 10)
result.each do |col|
  puts((col.uid).to_s + " — " + ((col.name || "untitled")).to_s)
end
```
---

## get_current_user

Get the authenticated Bannerbear account details.

### Parameters

None.

### Example

```ruby
result = app.integrations.bannerbear.get_current_user()
puts("Account: " + (result.name).to_s)
puts("Email: " + (result.email).to_s)
```
---

## Multi-Account Usage

If you have multiple Bannerbear accounts configured, use account-specific namespaces:

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
