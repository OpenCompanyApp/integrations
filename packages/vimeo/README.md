# Integration: Vimeo

> Vimeo API integration for Laravel agents. Manage videos, uploads, albums/showcases, folders/projects, comments, text tracks, pictures, channels, categories, and documented API endpoints.

This package exposes common Vimeo API operations as first-class tools and includes guarded generic helpers for documented endpoints that are not yet promoted to dedicated wrappers.

## Installation

```console
composer require opencompanyapp/integration-vimeo
```

Laravel auto-discovers the service provider.

## Configuration

```php
return [
    'vimeo' => [
        'access_token' => env('VIMEO_ACCESS_TOKEN'),
        'base_url' => env('VIMEO_BASE_URL', 'https://api.vimeo.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `vimeo_list_videos` | read | List videos for the authenticated user. |
| `vimeo_get_video` | read | Get a video by ID. |
| `vimeo_create_video` | write | Create a video upload resource. |
| `vimeo_upload_video` | write | Create an upload ticket. |
| `vimeo_update_video` | write | Update video metadata/settings. |
| `vimeo_delete_video` | write | Delete a video. |
| `vimeo_list_video_comments` | read | List comments for a video. |
| `vimeo_create_video_comment` | write | Create a comment on a video. |
| `vimeo_list_video_text_tracks` | read | List captions/subtitles for a video. |
| `vimeo_create_video_text_track` | write | Create a text-track resource. |
| `vimeo_list_video_pictures` | read | List thumbnails/pictures for a video. |
| `vimeo_list_albums` | read | List albums/showcases. |
| `vimeo_get_album` | read | Get an album/showcase. |
| `vimeo_create_album` | write | Create an album/showcase. |
| `vimeo_update_album` | write | Update an album/showcase. |
| `vimeo_list_album_videos` | read | List videos in an album/showcase. |
| `vimeo_add_video_to_album` | write | Add a video to an album/showcase. |
| `vimeo_list_folders` | read | List folders/projects. |
| `vimeo_create_folder` | write | Create a folder/project. |
| `vimeo_update_folder` | write | Update a folder/project. |
| `vimeo_list_channels` | read | List public channels. |
| `vimeo_list_categories` | read | List Vimeo categories. |
| `vimeo_get_current_user` | read | Get the authenticated user. |
| `vimeo_api_get` | read | Call a documented GET endpoint. |
| `vimeo_api_post` | write | Call a documented POST endpoint. |
| `vimeo_api_patch` | write | Call a documented PATCH endpoint. |
| `vimeo_api_delete` | write | Call a documented DELETE endpoint. |

## Service Usage

```php
use OpenCompany\Integrations\Vimeo\VimeoService;

$service = app(VimeoService::class);

$videos = $service->listVideos(['per_page' => 25, 'query' => 'launch']);
$video = $service->getVideo('123456789');

$upload = $service->createVideo([
    'upload' => [
        'approach' => 'pull',
        'link' => 'https://example.test/video.mp4',
    ],
    'name' => 'Launch demo',
]);

$service->updateVideo('123456789', [
    'name' => 'Updated launch demo',
    'privacy' => ['view' => 'unlisted'],
]);

$albums = $service->listAlbums();
$folders = $service->listFolders();
```

## Generic Helpers

Use generic helpers for documented Vimeo endpoints that do not yet have named wrappers:

```php
$team = $service->apiGet('/me/team_members');
$patched = $service->apiPatch('/videos/123456789', ['name' => 'Updated']);
```

Absolute URLs are rejected so agents cannot bypass the configured Vimeo API host.

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- `opencompanyapp/integration-core`
- Vimeo OAuth access token or personal access token with the scopes required by the tools used

## License

MIT - see [LICENSE](LICENSE).
