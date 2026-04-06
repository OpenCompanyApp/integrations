# Cloudinary — Lua API Reference

## upload

Upload an image to Cloudinary.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file` | string | yes | File to upload — a remote URL or base64 data URI |
| `public_id` | string | no | Public ID to assign (auto-generated if omitted) |
| `folder` | string | no | Folder path (e.g. `"blog/images"`) |

### Example

```lua
local result = app.integrations.cloudinary.upload({
  file = "https://example.com/photo.jpg",
  public_id = "blog/hero",
  folder = "blog"
})

print("Uploaded: " .. result.secure_url)
print("Dimensions: " .. result.width .. "x" .. result.height)
```

---

## list_resources

List media resources in your Cloudinary cloud.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type` | string | no | Resource type: `"image"`, `"video"`, or `"raw"` (default: `"image"`) |
| `max_results` | integer | no | Max resources to return (max 500) |
| `next_cursor` | string | no | Pagination cursor from a previous response |
| `prefix` | string | no | Only resources whose public ID starts with this prefix |

### Example

```lua
local result = app.integrations.cloudinary.list_resources({
  type = "image",
  prefix = "blog/",
  max_results = 20
})

for _, resource in ipairs(result.resources) do
  print(resource.public_id .. " (" .. resource.format .. ")")
end
```

---

## get_resource

Get details of a specific Cloudinary resource.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type` | string | yes | Resource type: `"image"`, `"video"`, or `"raw"` |
| `public_id` | string | yes | Public ID of the resource |

### Example

```lua
local result = app.integrations.cloudinary.get_resource({
  type = "image",
  public_id = "blog/hero"
})

print(result.secure_url)
print("Size: " .. result.bytes .. " bytes")
```

---

## delete_resource

Delete a media resource from Cloudinary. **This action is irreversible.**

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type` | string | yes | Resource type: `"image"`, `"video"`, or `"raw"` |
| `public_id` | string | yes | Public ID of the resource to delete |

### Example

```lua
local result = app.integrations.cloudinary.delete_resource({
  type = "image",
  public_id = "blog/old-photo"
})

print(result.message)
```

---

## list_folders

List all folders in your Cloudinary cloud.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `max_results` | integer | no | Max folders to return |
| `next_cursor` | string | no | Pagination cursor from a previous response |

### Example

```lua
local result = app.integrations.cloudinary.list_folders({})

for _, folder in ipairs(result.folders) do
  print(folder.name .. " (" .. folder.path .. ")")
end
```

---

## get_current_user

Get the currently authenticated Cloudinary user profile.

### Parameters

None.

### Example

```lua
local result = app.integrations.cloudinary.get_current_user({})
print("Connected as: " .. result.name .. " (" .. result.email .. ")")
```

---

## Multi-Account Usage

If you have multiple Cloudinary accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.cloudinary.upload({...})

-- Explicit default (portable across setups)
app.integrations.cloudinary.default.upload({...})

-- Named accounts
app.integrations.cloudinary.production.upload({...})
app.integrations.cloudinary.staging.upload({...})
```

All functions are identical across accounts — only the credentials differ.
