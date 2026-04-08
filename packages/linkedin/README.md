# Integration: LinkedIn

> LinkedIn integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage profiles, connections, organizations, and posts. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to LinkedIn. Retrieve profiles, list connections, look up organizations, and publish posts — all through the LinkedIn v2 REST API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This LinkedIn tool lets AI agents interact with LinkedIn profiles, connections, and organizations — enabling social selling, networking automation, and professional content publishing.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-linkedin
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a LinkedIn OAuth2 access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'linkedin' => [
        'access_token' => env('LINKEDIN_ACCESS_TOKEN'),
        'url'          => env('LINKEDIN_API_URL', 'https://api.linkedin.com/v2'),
    ],
];
```

### Required LinkedIn OAuth2 Scopes

| Scope | Purpose |
|-------|---------|
| `r_liteprofile` | Read basic profile |
| `r_emailaddress` | Read email address |
| `w_member_social` | Create posts on behalf of user |
| `r_organization_social` | Read organization data |

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `linkedin_get_profile` | read | Get the authenticated user's LinkedIn profile |
| `linkedin_get_current_user` | read | Get the authenticated user's basic identity |
| `linkedin_list_connections` | read | List 1st-degree connections |
| `linkedin_create_post` | write | Create and publish a post |
| `linkedin_get_organization` | read | Get an organization's details by ID |

## Quick Start

```php
use OpenCompany\Integrations\LinkedIn\LinkedInService;
use OpenCompany\Integrations\LinkedIn\Tools\LinkedInGetProfile;
use OpenCompany\Integrations\LinkedIn\Tools\LinkedInCreatePost;

// Create tools
$service = app(LinkedInService::class);
$tools = [
    new LinkedInGetProfile($service),
    new LinkedInCreatePost($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Post "Hello from OpenCompany!" on my LinkedIn');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 5 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('linkedin');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\LinkedIn\Tools\LinkedInGetProfile::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\LinkedIn\LinkedInService;

$service = app(LinkedInService::class);

// Get profile
$profile = $service->getProfile();

// Get current user
$user = $service->getCurrentUser();

// List connections
$connections = $service->listConnections();

// Get organization
$org = $service->getOrganization('2414183');

// Create a post
$service->createPost([
    'author' => 'urn:li:person:ABC123',
    'lifecycleState' => 'PUBLISHED',
    'specificContent' => [
        'com.linkedin.ugc.ShareContent' => [
            'shareCommentary' => ['text' => 'Hello from OpenCompany!'],
            'shareMediaCategory' => 'NONE',
        ],
    ],
    'visibility' => [
        'com.linkedin.ugc.MemberNetworkVisibility' => 'PUBLIC',
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
- A [LinkedIn](https://www.linkedin.com) account with OAuth2 access

## License

MIT — see [LICENSE](LICENSE)
