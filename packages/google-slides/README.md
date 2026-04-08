# Integration: Google Slides

> Google Slides integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list, get, and create presentations and slides. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Google Slides. Browse presentations, inspect slides, create new decks, and add content — all through the [Google Slides API](https://developers.google.com/slides/api/reference/rest).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Google Slides tool lets AI agents read and create presentations and slides — giving agents the ability to work with visual content in Google Workspace.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-google-slides
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Google OAuth 2.0 access token with Slides and Drive scopes.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'google-slides' => [
        'access_token' => env('GOOGLE_SLIDES_ACCESS_TOKEN'),
        'url'          => env('GOOGLE_SLIDES_URL', 'https://slides.googleapis.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `gslides_list_presentations` | read | List presentations from the user's Google Drive |
| `gslides_get_presentation` | read | Get full details of a presentation |
| `gslides_create_presentation` | write | Create a new blank presentation |
| `gslides_list_slides` | read | List all slides in a presentation |
| `gslides_get_slide` | read | Get details of a specific slide |
| `gslides_create_slide` | write | Add a new slide to a presentation |
| `gslides_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\GoogleSlides\GoogleSlidesService;
use OpenCompany\Integrations\GoogleSlides\Tools\GoogleSlidesListPresentations;
use OpenCompany\Integrations\GoogleSlides\Tools\GoogleSlidesCreatePresentation;

// Create tools
$service = app(GoogleSlidesService::class);
$tools = [
    new GoogleSlidesListPresentations($service),
    new GoogleSlidesCreatePresentation($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Create a presentation called "Q1 Review" and list my existing decks');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('google-slides');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\GoogleSlides\Tools\GoogleSlidesListPresentations::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\GoogleSlides\GoogleSlidesService;

$service = app(GoogleSlidesService::class);

// List presentations
$presentations = $service->listPresentations(20);

// Get a presentation
$presentation = $service->getPresentation('PRESENTATION_ID');

// Create a new presentation
$newPresentation = $service->createPresentation('My New Deck');

// List slides
$slides = $service->listSlides('PRESENTATION_ID');

// Create a slide with text
$service->createSlide('PRESENTATION_ID', null, true, [
    'elements' => [
        ['type' => 'text', 'text' => 'Hello World'],
    ],
]);
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
- A Google account with OAuth 2.0 access token (Slides and Drive scopes)

## License

MIT — see [LICENSE](LICENSE)
