# Beamer Integration

Beamer API tools for product changelog, notifications, comments, categories,
and generic API calls.

Beamer API requests must include the `Beamer-Api-Key` header.

## Tools

| Tool | Type | Notes |
|------|------|-------|
| `beamer_list_posts` | read | List changelog posts with pagination and status filters. |
| `beamer_get_post` | read | Retrieve a post by ID. |
| `beamer_create_post` | write | Create a post or announcement. |
| `beamer_list_comments` | read | List comments for a post. |
| `beamer_get_current_user` | read | Authenticated Beamer profile. |
| `beamer_list_categories` | read | List post categories. |
| `beamer_api_get` | read | Generic Beamer GET endpoint. |
| `beamer_api_post` | write | Generic Beamer POST endpoint. |
| `beamer_api_put` | write | Generic Beamer PUT endpoint. |
| `beamer_api_delete` | write | Generic Beamer DELETE endpoint. |

## Configuration

```php
return [
    'beamer' => [
        'api_key' => env('BEAMER_API_KEY'),
        'url' => env('BEAMER_URL', 'https://api.getbeamer.com/v0'),
    ],
];
```

## Generic API

Generic tools accept paths relative to the configured v0 base URL:

```php
$unread = $service->apiGet('/unread/count', [
    'userId' => 'user_123',
]);

$comment = $service->apiPost('/posts/123/comments', [
    'userEmail' => 'user@example.test',
    'comment' => 'Looks useful',
]);
```
