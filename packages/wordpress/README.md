# Integration: WordPress

> WordPress REST API integration for Laravel — manage posts, pages, users, and comments. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to WordPress content management. Create and update posts, list pages, manage comments, and query users — all through the [WordPress REST API](https://developer.wordpress.org/rest-api/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This WordPress integration lets AI agents manage website content, retrieve posts and pages, and interact with comments — giving agents full content management capabilities.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-wordpress
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires a WordPress username and an application password.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'wordpress' => [
        'url'                   => env('WORDPRESS_URL', 'https://yourdomain.com/wp-json'),
        'username'              => env('WORDPRESS_USERNAME'),
        'application_password'  => env('WORDPRESS_APPLICATION_PASSWORD'),
    ],
];
```

### Generating an Application Password

1. Log in to your WordPress admin dashboard.
2. Go to **Users → Profile** (or **Users → All Users** → click your user).
3. Scroll to the **Application Passwords** section.
4. Enter a name (e.g., "OpenCompany Integration") and click **Add New Application Password**.
5. Copy the generated password and use it as the `application_password` config value.

> **Important:** Do NOT use your WordPress login password. Always use an application password.

### Requirements

- WordPress 5.6+ (application passwords support)
- Pretty permalinks must be enabled (the REST API requires them)
- The authenticated user must have appropriate capabilities (e.g., `edit_posts` to create posts)

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `wordpress_list_posts` | read | List posts with filtering by status, author, category, tag, and search |
| `wordpress_get_post` | read | Get a single post by ID with full details |
| `wordpress_create_post` | write | Create a new post (defaults to draft status) |
| `wordpress_update_post` | write | Update an existing post's title, content, status, etc. |
| `wordpress_list_pages` | read | List pages with filtering by status, author, search, and parent |
| `wordpress_list_users` | read | List registered users with role filtering |
| `wordpress_list_comments` | read | List comments with filtering by post, status, and author |
| `wordpress_get_current_user` | read | Get the currently authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\WordPress\WordPressService;
use OpenCompany\Integrations\WordPress\Tools\WordPressListPosts;
use OpenCompany\Integrations\WordPress\Tools\WordPressCreatePost;

// Create tools
$service = app(WordPressService::class);
$tools = [
    new WordPressListPosts($service),
    new WordPressCreatePost($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List the 5 most recent posts and create a draft summary post.');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 8 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('wordpress');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\WordPress\Tools\WordPressListPosts::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\WordPress\WordPressService;

$service = app(WordPressService::class);

// List recent posts
$posts = $service->listPosts(['per_page' => 5, 'status' => 'publish']);

// Get a specific post
$post = $service->getPost(123);

// Create a post (returns draft by default)
$newPost = $service->createPost([
    'title'   => 'My New Post',
    'content' => '<p>Hello world!</p>',
    'status'  => 'draft',
]);

// Update a post
$service->updatePost(123, [
    'title'  => 'Updated Title',
    'status' => 'publish',
]);

// List pages
$pages = $service->listPages(['per_page' => 10]);

// List users
$users = $service->listUsers(['roles' => 'administrator,editor']);

// List comments for a post
$comments = $service->listComments(['post' => 123]);

// Get current user
$me = $service->getCurrentUser();
```

## Multi-Account Support

The integration supports connecting to multiple WordPress sites. Each account resolves its own credentials via the `CredentialResolver`:

```php
$provider = app(ToolProviderRegistry::class)->get('wordpress');

// Create a tool for a specific account
$tool = $provider->createTool(
    WordPressListPosts::class,
    ['account' => 'blog-site']
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
- A WordPress 5.6+ site with REST API enabled and application password configured

## License

MIT — see [LICENSE](LICENSE)
