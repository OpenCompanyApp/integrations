# Integration: Bannerbear

> Bannerbear integration for the [Laravel AI SDK](https://github.com/laravel/ai) — generate images, videos, and animated GIFs from templates. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents the ability to generate branded images, videos, and animated GIFs from templates using the [Bannerbear](https://bannerbear.com) API. Create social media graphics, certificates, thumbnails, and more — all through template-driven automation.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Bannerbear tool lets AI agents generate dynamic media assets on demand — producing personalized images, videos, and GIFs from pre-designed templates without manual design work.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-bannerbear
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Bannerbear API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'bannerbear' => [
        'api_key' => env('BANNERBEAR_API_KEY'),
        'url'     => env('BANNERBEAR_URL', 'https://api.bannerbear.com/v2'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `bannerbear_create_image` | write | Generate an image from a template with custom modifications |
| `bannerbear_get_image` | read | Check image status and get download URL |
| `bannerbear_list_images` | read | List previously created images with pagination |
| `bannerbear_list_collections` | read | List Bannerbear collections with pagination |
| `bannerbear_create_video` | write | Generate a video from a template |
| `bannerbear_get_video` | read | Check video status and get download URL |
| `bannerbear_list_templates` | read | List all available templates |
| `bannerbear_get_template` | read | Get template details and modification layers |
| `bannerbear_create_animated_gif` | write | Generate an animated GIF from a template |
| `bannerbear_get_current_user` | read | Get authenticated account details |

## Quick Start

```php
use OpenCompany\Integrations\Bannerbear\BannerbearService;
use OpenCompany\Integrations\Bannerbear\Tools\BannerbearCreateImage;
use OpenCompany\Integrations\Bannerbear\Tools\BannerbearGetImage;

// Create tools
$service = app(BannerbearService::class);
$tools = [
    new BannerbearCreateImage($service),
    new BannerbearGetImage($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Generate a social media image from template 01H8XYZ with the text "Hello World"');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 8 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('bannerbear');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Bannerbear\Tools\BannerbearCreateImage::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Bannerbear\BannerbearService;

$service = app(BannerbearService::class);

// List templates
$templates = $service->listTemplates();

// Create an image
$image = $service->createImage('01H8XYZ...', [
    ['name' => 'title', 'text' => 'Hello World'],
    ['name' => 'photo', 'image_url' => 'https://example.com/photo.jpg'],
]);

// Poll for completion
$status = $service->getImage($image['uid']);
if ($status['status'] === 'completed') {
    echo $status['image_url'];
}

// Create a video
$video = $service->createVideo('01H8XYZ...', [
    ['name' => 'headline', 'text' => 'Welcome!'],
]);

// Create an animated GIF
$gif = $service->createAnimatedGif('01H8XYZ...', [
    ['name' => 'frame_text', 'text' => 'Frame 1'],
    ['name' => 'frame_text', 'text' => 'Frame 2'],
]);

// Account info
$account = $service->getCurrentUser();
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
- A [Bannerbear](https://bannerbear.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
