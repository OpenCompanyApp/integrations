# Bluesky Integration

Bluesky social integration for Laravel — post, search, manage followers and profiles via the AT Protocol API.

## Tools

| Tool | Type | Description |
|------|------|-------------|
| `bluesky_create_post` | write | Create a new post on Bluesky |
| `bluesky_get_profile` | read | Get the profile of a Bluesky user |
| `bluesky_list_followers` | read | List followers of a Bluesky account |
| `bluesky_list_following` | read | List accounts a Bluesky user follows |
| `bluesky_search_posts` | read | Search for posts on Bluesky |
| `bluesky_get_current_user` | read | Get the authenticated user's own profile |

## Configuration

| Key | Type | Required | Description |
|-----|------|----------|-------------|
| `access_token` | secret | yes | Bluesky access token (Bearer) |
| `did` | string | yes | Your Decentralised Identifier (DID) |
| `url` | url | no | PDS URL (default: `https://bsky.social`) |

## Installation

```bash
composer require opencompanyapp/integration-bluesky
```

The service provider is auto-discovered via Laravel's package discovery.

## License

MIT
