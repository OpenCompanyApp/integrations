<?php

namespace OpenCompany\Integrations\YouTube;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\YouTube\Tools\YouTubeSearchVideos;
use OpenCompany\Integrations\YouTube\Tools\YouTubeGetVideoDetails;
use OpenCompany\Integrations\YouTube\Tools\YouTubeListChannels;
use OpenCompany\Integrations\YouTube\Tools\YouTubeGetChannel;
use OpenCompany\Integrations\YouTube\Tools\YouTubeListPlaylists;
use OpenCompany\Integrations\YouTube\Tools\YouTubeGetPlaylist;
use OpenCompany\Integrations\YouTube\Tools\YouTubeGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Registers the YouTube integration and its tools with the integration platform.
 *
 * Provides video search, video details, channel, and playlist tools
 * via the YouTube Data API v3.
 */
class YouTubeToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

/**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
          'auth' => [
            'strategy' => 'api_key',
            'legacy_auth_type' => 'api_key',
            'credential_mode' => 'secret',
            'setup_flows' =>
            [
              0 => 'manual_secret',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
            ],
            'notes' =>
            [
            ],
          ],
          'host_availability' => [
            'web' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
              'runtime_mode' => 'normal',
            ],
          ],
          'runtime_requirements' => [
          ],
          'compatibility' => [
            'web_setup_supported' => true,
            'web_runtime_supported' => true,
            'cli_setup_supported' => true,
            'cli_runtime_supported' => true,
          ],
        ];
    }

    public function appName(): string
    {
        return 'youtube';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'search videos, channels, playlists',
            'description' => 'YouTube video & channel data',
            'icon' => 'mdi:youtube',
            'logo' => 'mdi:youtube',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'YouTube',
            'description' => 'Search for videos, get video details, browse channels, and explore playlists using the YouTube Data API v3.',
            'icon' => 'mdi:youtube',
            'logo' => 'mdi:youtube',
            'category' => 'data',
            'docs_url' => 'https://developers.google.com/youtube/v3/docs',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'AIza...',
                'hint' => 'Create an API key in the <a href="https://console.cloud.google.com/apis/credentials" target="_blank">Google Cloud Console</a> and enable the YouTube Data API v3.',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
            ])->timeout(10)->get('https://www.googleapis.com/youtube/v3/channels', [
                'key' => $apiKey,
                'part' => 'snippet',
                'mine' => 'true',
            ]);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => 'Connected to YouTube Data API v3.',
                ];
            }

            $body = $response->json() ?? [];
            $error = $body['error']['message'] ?? $response->body();

            return [
                'success' => false,
                'error' => 'YouTube API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'youtube_search_videos' => [
                'class' => YouTubeSearchVideos::class,
                'type' => 'read',
                'name' => 'Search Videos',
                'description' => 'Search for videos, channels, or playlists on YouTube.',
                'icon' => 'mdi:magnify',
            ],
            'youtube_get_video_details' => [
                'class' => YouTubeGetVideoDetails::class,
                'type' => 'read',
                'name' => 'Get Video Details',
                'description' => 'Get detailed information about one or more YouTube videos.',
                'icon' => 'mdi:play-circle-outline',
            ],
            'youtube_list_channels' => [
                'class' => YouTubeListChannels::class,
                'type' => 'read',
                'name' => 'List Channels',
                'description' => 'List YouTube channels by username, ID, or other filters.',
                'icon' => 'mdi:account-group-outline',
            ],
            'youtube_get_channel' => [
                'class' => YouTubeGetChannel::class,
                'type' => 'read',
                'name' => 'Get Channel',
                'description' => 'Get detailed information about a specific YouTube channel.',
                'icon' => 'mdi:account-outline',
            ],
            'youtube_list_playlists' => [
                'class' => YouTubeListPlaylists::class,
                'type' => 'read',
                'name' => 'List Playlists',
                'description' => 'List playlists for a YouTube channel.',
                'icon' => 'mdi:playlist-play',
            ],
            'youtube_get_playlist' => [
                'class' => YouTubeGetPlaylist::class,
                'type' => 'read',
                'name' => 'Get Playlist',
                'description' => 'Get details and items of a specific YouTube playlist.',
                'icon' => 'mdi:playlist-check',
            ],
            'youtube_get_current_user' => [
                'class' => YouTubeGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s YouTube channel.',
                'icon' => 'mdi:account-circle-outline',
            ],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function luaDocsPath(): ?string
    {
        return dirname(__DIR__) . '/lua-docs/youtube.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
        ];
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new YouTubeService(
                apiKey: $creds->get('youtube', 'api_key', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(YouTubeService::class));
    }
}
