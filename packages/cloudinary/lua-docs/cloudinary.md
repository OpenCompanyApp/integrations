# Cloudinary Lua API Reference

Namespace: `app.integrations.cloudinary`

Cloudinary tools cover signed uploads and Admin API operations for assets, folders, tags, transformations, upload presets, usage, and read-only long-tail endpoints.

## Uploads

```lua
local result = app.integrations.cloudinary.upload({
  file = "https://example.test/photo.jpg",
  public_id = "blog/hero",
  folder = "blog",
  resource_type = "image",
  options = {
    tags = "hero,blog",
    context = "alt=Hero image"
  }
})
```

`resource_type` can be `image`, `video`, or `raw`. `options` accepts signed Upload API parameters.

## Assets

```lua
local resources = app.integrations.cloudinary.list_resources({
  type = "image",
  delivery_type = "upload",
  prefix = "blog/",
  max_results = 20
})

local search = app.integrations.cloudinary.search_resources({
  params = {
    expression = "folder=blog",
    max_results = 20
  }
})

local asset = app.integrations.cloudinary.get_resource({
  type = "image",
  delivery_type = "upload",
  public_id = "blog/hero"
})
```

Resource detail and delete calls require the Cloudinary resource type and delivery type. The default delivery type is `upload`.

## Tags

```lua
local tags = app.integrations.cloudinary.list_tags({
  resource_type = "image",
  params = { prefix = "he" }
})

local tagged = app.integrations.cloudinary.list_resources_by_tag({
  tag = "hero",
  resource_type = "image"
})
```

## Folders

```lua
local folders = app.integrations.cloudinary.list_folders({})
local subfolders = app.integrations.cloudinary.list_subfolders({
  folder = "blog"
})

local found = app.integrations.cloudinary.search_folders({
  params = { expression = "name:blog" }
})
```

`create_folder` and `delete_folder` are write tools. `delete_folder` only deletes empty folders.

## Transformations, Presets, Usage

```lua
local transformations = app.integrations.cloudinary.list_transformations({})
local presets = app.integrations.cloudinary.list_upload_presets({})
local usage = app.integrations.cloudinary.get_usage({})
local ping = app.integrations.cloudinary.ping({})
```

## Long-Tail GET Endpoints

```lua
local result = app.integrations.cloudinary.api_get({
  path = "/resources/search",
  params = { expression = "resource_type:image" }
})
```

`api_get` accepts only relative Admin API paths, not full URLs.

## Multi-Account Usage

```lua
app.integrations.cloudinary.upload({...})
app.integrations.cloudinary.default.upload({...})
app.integrations.cloudinary.production.search_resources({
  params = { expression = "folder=blog" }
})
```

All functions are identical across accounts; only credentials differ.
