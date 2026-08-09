# Cloudinary JavaScript API Reference

Namespace: `app.integrations.cloudinary`

Cloudinary tools cover signed uploads and Admin API operations for assets, folders, tags, transformations, upload presets, usage, and read-only long-tail endpoints.

## Uploads

```js
var result = app.integrations.cloudinary.upload({
  file: "https://example.test/photo.jpg",
  public_id: "blog/hero",
  folder: "blog",
  resource_type: "image",
  options: {
    tags: "hero,blog",
    context: "alt=Hero image",
  }
})
```
`resource_type` can be `image`, `video`, or `raw`. `options` accepts signed Upload API parameters.

## Assets

```js
var resources = app.integrations.cloudinary.list_resources({
  type: "image",
  delivery_type: "upload",
  prefix: "blog/",
  max_results: 20,
})

var search = app.integrations.cloudinary.search_resources({
  params: {
    expression: "folder=blog",
    max_results: 20,
  }
})

var asset = app.integrations.cloudinary.get_resource({
  type: "image",
  delivery_type: "upload",
  public_id: "blog/hero",
})
```
Resource detail and delete calls require the Cloudinary resource type and delivery type. The default delivery type is `upload`.

## Tags

```js
var tags = app.integrations.cloudinary.list_tags({
  resource_type: "image",
  params: { prefix: "he" },
})

var tagged = app.integrations.cloudinary.list_resources_by_tag({
  tag: "hero",
  resource_type: "image",
})
```
## Folders

```js
var folders = app.integrations.cloudinary.list_folders({})
var subfolders = app.integrations.cloudinary.list_subfolders({
  folder: "blog",
})

var found = app.integrations.cloudinary.search_folders({
  params: { expression: "name:blog" },
})
```
`create_folder` and `delete_folder` are write tools. `delete_folder` only deletes empty folders.

## Transformations, Presets, Usage

```js
var transformations = app.integrations.cloudinary.list_transformations({})
var presets = app.integrations.cloudinary.list_upload_presets({})
var usage = app.integrations.cloudinary.get_usage({})
var ping = app.integrations.cloudinary.ping({})
```
## Long-Tail GET Endpoints

```js
var result = app.integrations.cloudinary.api_get({
  path: "/resources/search",
  params: { expression: "resource_type:image" },
})
```
`api_get` accepts only relative Admin API paths, not full URLs.

## Multi-Account Usage

```js
app.integrations.cloudinary.upload({ /* parameters */ })
app.integrations.cloudinary.default.upload({ /* parameters */ })
app.integrations.cloudinary.production.search_resources({
  params: { expression: "folder=blog" },
})
```
All functions are identical across accounts; only credentials differ.
