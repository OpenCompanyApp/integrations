# Integration: Google Drive

> Google Drive integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list files, manage files and folders, track changes, and get user info. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Google Drive. Browse files and folders, create new documents, track changes, and retrieve user information — all through the [Google Drive v3 API](https://developers.google.com/drive/api/v3/reference).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Google Drive tool lets AI agents browse cloud files, create documents and folders, and monitor drive activity — giving agents file management capabilities in the productivity stack.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-google-drive
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Google OAuth 2.0 access token with Drive scope.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'google-drive' => [
        'access_token' => env('GOOGLE_DRIVE_ACCESS_TOKEN'),
        'url'          => env('GOOGLE_DRIVE_API_URL', 'https://www.googleapis.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `gdrive_list_files` | read | List files and folders with filtering and pagination |
| `gdrive_get_file` | read | Get metadata for a specific file by ID |
| `gdrive_create_file` | write | Create a new file (metadata) in Google Drive |
| `gdrive_create_folder` | write | Create a new folder in Google Drive |
| `gdrive_list_changes` | read | List changes to files (additions, modifications, deletions) |
| `gdrive_get_current_user` | read | Get authenticated user info and storage quota |

## Quick Start

```php
use OpenCompany\Integrations\GoogleDrive\GoogleDriveService;
use OpenCompany\Integrations\GoogleDrive\Tools\GoogleDriveListFiles;
use OpenCompany\Integrations\GoogleDrive\Tools\GoogleDriveCreateFolder;

// Create tools
$service = app(GoogleDriveService::class);
$tools = [
    new GoogleDriveListFiles($service),
    new GoogleDriveCreateFolder($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all PDF files in my Google Drive');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('google-drive');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\GoogleDrive\Tools\GoogleDriveListFiles::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\GoogleDrive\GoogleDriveService;

$service = app(GoogleDriveService::class);

// List files
$files = $service->listFiles([
    'pageSize' => 10,
    'q' => "mimeType != 'application/vnd.google-apps.folder'",
]);

// Get a specific file
$file = $service->getFile('1aBcDeFgHiJkLmNoPqRsTuVwXyZ');

// Create a folder
$folder = $service->createFolder('Project Files', 'parent-folder-id');

// List changes
$changes = $service->listChanges(['pageToken' => '12345']);

// Get current user
$about = $service->getCurrentUser();
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
- A Google account with OAuth 2.0 access token (Drive scope)

## License

MIT — see [LICENSE](LICENSE)
