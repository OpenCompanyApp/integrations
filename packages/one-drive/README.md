# Integration: OneDrive

> Microsoft OneDrive integration for the [Laravel AI SDK](https://github.com/laravel/ai) - manage files, folders, sharing, and delta sync via Microsoft Graph API. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to cloud file storage. Browse, upload, download, share, and track changes in Microsoft OneDrive - all through the [Microsoft Graph API](https://learn.microsoft.com/en-us/graph/api/resources/driveitem).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace - with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This OneDrive tool lets AI agents browse files, upload documents, download content, manage folders, create sharing links, and inspect changes in a user's OneDrive storage.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-one-drive
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires a Microsoft Graph API access token with the appropriate permissions (`Files.ReadWrite.All`, `User.Read`).

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'one_drive' => [
        'access_token' => env('ONEDRIVE_ACCESS_TOKEN'),
        'url'          => env('ONEDRIVE_GRAPH_URL', 'https://graph.microsoft.com/v1.0'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `onedrive_list_files` | read | List files and folders in the root of the user's OneDrive |
| `onedrive_get_file` | read | Get metadata for a specific file or folder by its ID |
| `onedrive_get_drive` | read | Get metadata for the signed-in user's default drive |
| `onedrive_list_children` | read | List files and folders under root or a parent folder |
| `onedrive_create_folder` | write | Create a folder under root or a parent folder |
| `onedrive_update_item` | write | Rename, move, or update file/folder metadata |
| `onedrive_delete_item` | write | Delete a file or folder by ID |
| `onedrive_copy_item` | write | Copy a file or folder asynchronously |
| `onedrive_upload_file` | write | Upload a file to OneDrive by specifying a destination path |
| `onedrive_download_file` | read | Download a file's content by its drive item ID |
| `onedrive_list_shared` | read | List files and folders shared with the current user |
| `onedrive_search` | read | Search files and folders |
| `onedrive_delta` | read | Track drive changes |
| `onedrive_list_thumbnails` | read | List item thumbnail sets |
| `onedrive_create_sharing_link` | write | Create or return a sharing link |
| `onedrive_list_permissions` | read | List item sharing permissions |
| `onedrive_delete_permission` | write | Delete an item permission |
| `onedrive_get_current_user` | read | Get the profile of the currently authenticated Microsoft user |
| `onedrive_api_get` | read | Call a relative Microsoft Graph GET endpoint |
| `onedrive_api_post` | write | Call a relative Microsoft Graph POST endpoint |
| `onedrive_api_patch` | write | Call a relative Microsoft Graph PATCH endpoint |
| `onedrive_api_delete` | write | Call a relative Microsoft Graph DELETE endpoint |

## Quick Start

```php
use OpenCompany\Integrations\OneDrive\OneDriveService;
use OpenCompany\Integrations\OneDrive\Tools\OneDriveListFiles;
use OpenCompany\Integrations\OneDrive\Tools\OneDriveGetFile;

// Create tools
$service = app(OneDriveService::class);
$tools = [
    new OneDriveListFiles($service),
    new OneDriveGetFile($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all files in my OneDrive and show me the largest ones');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 22 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('one_drive');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\OneDrive\Tools\OneDriveListFiles::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\OneDrive\OneDriveService;

$service = app(OneDriveService::class);

// List files in root
$files = $service->listFiles();

// Get file metadata
$file = $service->getFile('01ABCD1234...');

// Upload a file
$result = $service->uploadFile('Documents/report.txt', 'Hello, World!', 'text/plain');

// Download a file
$content = $service->downloadFile('01ABCD1234...');

// List shared files
$shared = $service->listShared();

// Create a folder and sharing link
$folder = $service->createFolder('Reports');
$link = $service->createSharingLink($folder['id'], ['type' => 'view', 'scope' => 'organization']);

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
- A Microsoft account with OneDrive and a Graph API access token

## License

MIT - see [LICENSE](LICENSE)
