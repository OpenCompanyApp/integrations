# Integration: Figma

> Figma integration for the [Laravel AI SDK](https://github.com/laravel/ai) — files, images, comments, projects, components, and styles. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your Figma design workspace. Browse files, retrieve document trees, list components, manage comments, and explore team projects — all through the [Figma REST API](https://www.figma.com/developers/api).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Figma tool lets AI agents browse design files, retrieve component metadata, manage comments, and explore team structure — giving agents visibility into your design system.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-figma
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Figma Personal Access Token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'figma' => [
        'access_token' => env('FIGMA_ACCESS_TOKEN'),
        'url'          => env('FIGMA_API_URL', 'https://api.figma.com'),
    ],
];
```

### Generating a Personal Access Token

1. Open Figma and go to **Settings → Personal access tokens**
2. Click **Generate new token**
3. Give it a descriptive name and copy the token

## Available Tools

### Primary Tools

| Tool | Type | Description |
|------|------|-------------|
| `figma_list_files` | read | List files accessible to the authenticated user (with pagination) |
| `figma_get_file` | read | Get a Figma file document by key (with depth control) |
| `figma_list_projects` | read | List projects in a Figma team |
| `figma_list_components` | read | List components in a Figma file |
| `figma_get_component` | read | Get a single component by key |
| `figma_list_comments` | read | List comments on a Figma file |
| `figma_get_current_user` | read | Get the authenticated user profile |

### Extended Tools

| Tool | Type | Description |
|------|------|-------------|
| `figma_get_file_nodes` | read | Get specific nodes from a file |
| `figma_get_file_images` | read | Export images from Figma nodes |
| `figma_get_image_fills` | read | Get image fill metadata |
| `figma_post_comment` | write | Post a comment on a file |
| `figma_delete_comment` | write | Delete a comment |
| `figma_get_project_files` | read | List files in a project |
| `figma_get_styles` | read | List styles in a file |
| `figma_get_style` | read | Get a style by key |
| `figma_list_team_components` | read | List published components across a team |

## Quick Start

```php
use OpenCompany\Integrations\Figma\FigmaService;
use OpenCompany\Integrations\Figma\Tools\FigmaGetFile;
use OpenCompany\Integrations\Figma\Tools\FigmaListFiles;

// Create tools
$service = app(FigmaService::class);
$tools = [
    new FigmaListFiles($service),
    new FigmaGetFile($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all Figma files and get the document tree for the main design system file.');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 19 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('figma');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Figma\Tools\FigmaListFiles::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Figma\FigmaService;

$service = app(FigmaService::class);

// List files
$files = $service->listFiles(limit: 10, page: 1);

// Get a file
$file = $service->getFile('abc123def456', ['depth' => 2]);

// List team projects
$projects = $service->getTeamProjects('team-id-here');

// List components
$components = $service->getComponents('abc123def456');

// Get a specific component
$component = $service->getComponent('component-key-here');

// List comments
$comments = $service->getComments('abc123def456');

// Get current user
$user = $service->getMe();
```

## Multi-Account Support

The Figma integration supports multiple accounts. Each account can have its own Personal Access Token and API URL:

```php
$provider = $registry->get('figma');

// Create a tool for a specific account
$tool = $provider->createTool(
    FigmaListFiles::class,
    ['account' => 'design-team']
);
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
- A [Figma](https://www.figma.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
