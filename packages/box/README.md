# Integration: Box

> Box integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage files, folders, sharing, and search via the Box API. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Box cloud content management. Upload, download, search, and share files — all through the [Box API](https://developer.box.com/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Box tool lets AI agents manage cloud files and folders, create shared links, and search content — giving agents full file management capabilities within Box.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-box
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Box access token (developer token or OAuth2 token).

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'box' => [
        'access_token' => env('BOX_ACCESS_TOKEN'),
        'url'          => env('BOX_API_URL', 'https://api.box.com/2.0'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `box_list_files` | read | List files and folders in a Box folder |
| `box_get_file` | read | Get metadata for a Box file |
| `box_upload_file` | write | Upload a file to Box |
| `box_download_file` | read | Download a file's contents from Box |
| `box_delete_file` | write | Delete a file from Box (moves to trash) |
| `box_create_folder` | write | Create a new folder in Box |
| `box_get_folder` | read | Get metadata for a Box folder |
| `box_share_file` | write | Create a shared link for a Box file |
| `box_search` | read | Search for files and folders in Box |
| `box_get_current_user` | read | Get the currently authenticated Box user |

## Quick Start

```php
use OpenCompany\Integrations\Box\BoxService;
use OpenCompany\Integrations\Box\Tools\BoxListFiles;
use OpenCompany\Integrations\Box\Tools\BoxSearch;

// Create tools
$service = app(BoxService::class);
$tools = [
    new BoxListFiles($service),
    new BoxSearch($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Find all PDF files in Box about quarterly reports');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 10 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('box');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Box\Tools\BoxSearch::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Box\BoxService;

$service = app(BoxService::class);

// List root folder
$items = $service->listFiles('0');

// Search for files
$results = $service->search('quarterly report');

// Upload a file
$result = $service->uploadFile('Hello world', 'notes.txt', '0');

// Share a file
$link = $service->shareFile('12345', ['access' => 'open']);

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
- A [Box](https://box.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
