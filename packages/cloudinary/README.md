# Integration: Cloudinary

> Cloudinary integration for the [Laravel AI SDK](https://github.com/laravel/ai) — upload, list, get, and delete media resources and folders. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to media management. Upload images, browse folders, retrieve asset metadata, and delete resources — all through the [Cloudinary](https://cloudinary.com) Admin API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Cloudinary tool lets AI agents manage media assets — upload files, organize them in folders, retrieve metadata, and clean up old resources — giving agents full control over your media library.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-cloudinary
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Cloudinary OAuth access token and your cloud name.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'cloudinary' => [
        'access_token' => env('CLOUDINARY_ACCESS_TOKEN'),
        'cloud_name'   => env('CLOUDINARY_CLOUD_NAME'),
        'base_url'     => env('CLOUDINARY_BASE_URL', 'https://api.cloudinary.com/v1_1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `cloudinary_upload` | write | Upload an image to Cloudinary |
| `cloudinary_list_resources` | read | List media resources with pagination and filtering |
| `cloudinary_get_resource` | read | Get details of a specific resource |
| `cloudinary_delete_resource` | write | Delete a resource permanently |
| `cloudinary_list_folders` | read | List all folders in the cloud |
| `cloudinary_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Cloudinary\CloudinaryService;
use OpenCompany\Integrations\Cloudinary\Tools\CloudinaryUpload;
use OpenCompany\Integrations\Cloudinary\Tools\CloudinaryListResources;

// Create tools
$service = app(CloudinaryService::class);
$tools = [
    new CloudinaryUpload($service),
    new CloudinaryListResources($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Upload this image to the blog folder: https://example.com/photo.jpg');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('cloudinary');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Cloudinary\Tools\CloudinaryUpload::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Cloudinary\CloudinaryService;

$service = app(CloudinaryService::class);

// Upload an image
$result = $service->upload('https://example.com/photo.jpg', 'blog/hero', 'blog');

// List image resources
$resources = $service->listResources('image', maxResults: 20, prefix: 'blog/');

// Get a specific resource
$resource = $service->getResource('image', 'blog/hero');

// Delete a resource
$service->deleteResource('image', 'blog/old-photo');

// List folders
$folders = $service->listFolders();

// Get current user
$user = $service->getCurrentUser();
```

## Dependencies

| Package | Purpose |
|---------|---------|
| [opencompanyapp/integration-core](https://github.com/OpenCompanyApp/integration-core) | ToolProvider contract and registry |
| [laravel/ai](https://github.com/laravel/ai) | Laravel AI SDK Tool contract |

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- [Laravel AI SDK](https://github.com/laravel/ai) ^0.1
- A [Cloudinary](https://cloudinary.com) account with OAuth access

## License

MIT — see [LICENSE](LICENSE)
