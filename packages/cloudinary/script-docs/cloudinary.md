# Cloudinary Ruby API Reference

Namespace: `app.integrations.cloudinary`

Cloudinary tools cover signed uploads and Admin API operations for assets, folders, tags, transformations, upload presets, usage, and read-only long-tail endpoints.

## Uploads

```ruby
result = app.integrations.cloudinary.upload_asset(file: "https://example.test/photo.jpg", public_id: "blog/hero", folder: "blog", resource_type: "image", options: {tags: "hero,blog", context: "alt=Hero image"})
```
`resource_type` can be `image`, `video`, or `raw`. `options` accepts signed Upload API parameters.

## Assets

```ruby
resources = app.integrations.cloudinary.list_resources(type: "image", delivery_type: "upload", prefix: "blog/", max_results: 20)
search = app.integrations.cloudinary.search_resources(params: {expression: "folder=blog", max_results: 20})
asset = app.integrations.cloudinary.get_resource(type: "image", delivery_type: "upload", public_id: "blog/hero")
```
Resource detail and delete calls require the Cloudinary resource type and delivery type. The default delivery type is `upload`.

## Tags

```ruby
tags = app.integrations.cloudinary.list_tags(resource_type: "image", params: {prefix: "he"})
tagged = app.integrations.cloudinary.list_resources_by_tag(tag: "hero", resource_type: "image")
```
## Folders

```ruby
folders = app.integrations.cloudinary.list_folders()
subfolders = app.integrations.cloudinary.list_subfolders(folder: "blog")
found = app.integrations.cloudinary.search_folders(params: {expression: "name:blog"})
```
`create_folder` and `delete_folder` are write tools. `delete_folder` only deletes empty folders.

## Transformations, Presets, Usage

```ruby
transformations = app.integrations.cloudinary.list_transformations()
presets = app.integrations.cloudinary.list_upload_presets()
usage = app.integrations.cloudinary.get_usage()
ping = app.integrations.cloudinary.ping()
```
## Long-Tail GET Endpoints

```ruby
result = app.integrations.cloudinary.api_get(path: "/resources/search", params: {expression: "resource_type:image"})
```
`api_get` accepts only relative Admin API paths, not full URLs.

## Multi-Account Usage

```ruby
app.integrations.cloudinary.upload_asset()
app.integrations.cloudinary.default.upload_asset()
app.integrations.cloudinary.production.search_resources(params: {expression: "folder=blog"})
```
All functions are identical across accounts; only credentials differ.
