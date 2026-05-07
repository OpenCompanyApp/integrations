# Integration: Cloudinary

Cloudinary media management for AI agents: signed uploads, Admin API asset listing, search, resource detail, deletion, folders, tags, transformations, upload presets, usage, and a read-only Admin API escape hatch.

## Installation

```console
composer require opencompanyapp/integration-cloudinary
```

Laravel auto-discovers the service provider.

## Configuration

Cloudinary's Admin API uses your cloud name plus API key and API secret with HTTP Basic authentication. Signed uploads use the same API key and secret to generate the Upload API signature. The older `access_token` setting remains accepted for backward compatibility, but API key/secret is the documented path.

```php
return [
    'cloudinary' => [
        'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
        'api_key' => env('CLOUDINARY_API_KEY'),
        'api_secret' => env('CLOUDINARY_API_SECRET'),
        'base_url' => env('CLOUDINARY_BASE_URL', 'https://api.cloudinary.com/v1_1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `cloudinary_upload` | write | Upload an asset with the Upload API |
| `cloudinary_list_resources` | read | List resources by resource and delivery type |
| `cloudinary_search_resources` | read | Search assets with Admin API expressions |
| `cloudinary_get_resource` | read | Get details for a specific asset |
| `cloudinary_delete_resource` | write | Delete an asset by public ID |
| `cloudinary_list_resources_by_tag` | read | List assets by tag |
| `cloudinary_list_tags` | read | List tags by resource type |
| `cloudinary_list_folders` | read | List root folders |
| `cloudinary_list_subfolders` | read | List subfolders under a parent folder |
| `cloudinary_search_folders` | read | Search folders |
| `cloudinary_create_folder` | write | Create an asset folder |
| `cloudinary_delete_folder` | write | Delete an empty asset folder |
| `cloudinary_list_transformations` | read | List named transformations |
| `cloudinary_list_upload_presets` | read | List upload presets |
| `cloudinary_get_usage` | read | Get usage details |
| `cloudinary_ping` | read | Ping Cloudinary servers |
| `cloudinary_api_get` | read | Call a read-only Admin API endpoint |

## Service Usage

```php
use OpenCompany\Integrations\Cloudinary\CloudinaryService;

$service = app(CloudinaryService::class);

$upload = $service->upload('https://example.test/photo.jpg', 'blog/hero', 'blog');
$resources = $service->listResources('image', maxResults: 20, prefix: 'blog/');
$search = $service->searchResources(['expression' => 'folder=blog']);
$asset = $service->getResource('image', 'blog/hero');
$tags = $service->listTags('image');
$usage = $service->getUsage();
```

## Notes

- Resource detail paths include the delivery type segment, for example `/resources/image/upload/{public_id}`.
- Resource deletion by public ID uses `DELETE /resources/{resource_type}/{delivery_type}` with a `public_ids` array.
- `cloudinary_api_get` accepts only relative Admin API paths, not full URLs.
- The former current-user tool was removed because the documented Cloudinary Admin and Upload APIs do not expose an account-profile endpoint.

## Dependencies

| Package | Purpose |
|---------|---------|
| `opencompanyapp/integration-core` | ToolProvider contract and registry |

## License

MIT
