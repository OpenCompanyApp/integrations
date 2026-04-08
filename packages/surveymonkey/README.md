# Integration: SurveyMonkey

> SurveyMonkey integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage surveys, responses, and collectors. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to SurveyMonkey surveys. Create and manage surveys, collect and review responses, and manage survey collectors — all through the [SurveyMonkey API v3](https://developer.surveymonkey.com/api/v3/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This SurveyMonkey tool lets AI agents manage surveys, retrieve response data, and distribute surveys via collectors — giving agents the ability to interact with survey data and workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-surveymonkey
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a SurveyMonkey access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'surveymonkey' => [
        'access_token' => env('SURVEYMONKEY_ACCESS_TOKEN'),
        'url'          => env('SURVEYMONKEY_URL', 'https://api.surveymonkey.com/v3'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `surveymonkey_list_surveys` | read | List all surveys in your account |
| `surveymonkey_get_survey` | read | Get details of a specific survey |
| `surveymonkey_create_survey` | write | Create a new blank survey |
| `surveymonkey_list_responses` | read | List all bulk responses for a survey |
| `surveymonkey_get_response` | read | Get a single response by ID |
| `surveymonkey_list_collectors` | read | List all collectors for a survey |
| `surveymonkey_create_collector` | write | Create a collector for distributing a survey |
| `surveymonkey_get_current_user` | read | Get details of the authenticated user |

## Quick Start

```php
use OpenCompany\Integrations\SurveyMonkey\SurveyMonkeyService;
use OpenCompany\Integrations\SurveyMonkey\Tools\SurveyMonkeyListSurveys;
use OpenCompany\Integrations\SurveyMonkey\Tools\SurveyMonkeyCreateSurvey;

// Create tools
$service = app(SurveyMonkeyService::class);
$tools = [
    new SurveyMonkeyListSurveys($service),
    new SurveyMonkeyCreateSurvey($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Create a customer satisfaction survey and list all existing surveys');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 8 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('surveymonkey');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\SurveyMonkey\Tools\SurveyMonkeyListSurveys::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\SurveyMonkey\SurveyMonkeyService;

$service = app(SurveyMonkeyService::class);

// List surveys
$surveys = $service->listSurveys(page: 1, perPage: 10);

// Create a survey
$survey = $service->createSurvey('Customer Feedback Q1');

// Get survey details
$details = $service->getSurvey('123456789');

// List responses
$responses = $service->listResponses('123456789');

// Get a specific response
$response = $service->getResponse('123456789', '987654321');

// Manage collectors
$collectors = $service->listCollectors('123456789');
$collector = $service->createCollector('123456789', 'weblink', 'Website Link');

// Get current user info
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
- A [SurveyMonkey](https://www.surveymonkey.com/) account with API access

## License

MIT — see [LICENSE](LICENSE)
