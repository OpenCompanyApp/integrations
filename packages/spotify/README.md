# Integration: Spotify

> Spotify integration for the [Laravel AI SDK](https://github.com/laravel/ai) — search tracks, manage playlists, browse artists and albums. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to the [Spotify Web API](https://developer.spotify.com/documentation/web-api). Search for music, get track and artist details, manage playlists, and browse discographies — all through a clean tool interface.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Spotify tool lets AI agents search for music, retrieve detailed track and artist information, and manage playlists — enabling music-aware agents in your workspace.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-spotify
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Spotify OAuth access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'spotify' => [
        'access_token' => env('SPOTIFY_ACCESS_TOKEN'),
        'url'          => env('SPOTIFY_API_URL', 'https://api.spotify.com/v1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `spotify_search` | read | Search for tracks, artists, albums, or playlists |
| `spotify_get_track` | read | Get detailed information about a specific track |
| `spotify_get_artist` | read | Get detailed information about a specific artist |
| `spotify_list_playlists` | read | List the current user's playlists |
| `spotify_get_playlist` | read | Get playlist details with tracks |
| `spotify_create_playlist` | write | Create a new playlist for the current user |
| `spotify_list_albums` | read | List albums by a specific artist |
| `spotify_get_current_user` | read | Get the authenticated user's Spotify profile |

## Quick Start

```php
use OpenCompany\Integrations\Spotify\SpotifyService;
use OpenCompany\Integrations\Spotify\Tools\SpotifySearch;
use OpenCompany\Integrations\Spotify\Tools\SpotifyGetTrack;

// Create tools
$service = app(SpotifyService::class);
$tools = [
    new SpotifySearch($service),
    new SpotifyGetTrack($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Search for Bohemian Rhapsody and tell me the album name');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 8 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('spotify');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Spotify\Tools\SpotifySearch::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Spotify\SpotifyService;

$service = app(SpotifyService::class);

// Search
$results = $service->search('Bohemian Rhapsody', 'track');

// Get track
$track = $service->getTrack('4cOdK2wGLETKBW3PvgPWqT');

// Get artist
$artist = $service->getArtist('1dfeR4HaWDbWqFHLkxsg1d');

// List playlists
$playlists = $service->listPlaylists();

// Get playlist with tracks
$playlist = $service->getPlaylist('37i9dQZF1DXcBWIGoYBM5M');

// Create playlist
$user = $service->getCurrentUser();
$newPlaylist = $service->createPlaylist($user['id'], 'My New Playlist', 'A description');

// List artist albums
$albums = $service->listAlbums('1dfeR4HaWDbWqFHLkxsg1d');

// Get current user profile
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
- A [Spotify](https://developer.spotify.com) developer account with an OAuth access token

## License

MIT — see [LICENSE](LICENSE)
