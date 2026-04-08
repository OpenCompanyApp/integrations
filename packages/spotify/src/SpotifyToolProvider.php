<?php

namespace OpenCompany\Integrations\Spotify;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Spotify\Tools\SpotifySearch;
use OpenCompany\Integrations\Spotify\Tools\SpotifyGetTrack;
use OpenCompany\Integrations\Spotify\Tools\SpotifyGetArtist;
use OpenCompany\Integrations\Spotify\Tools\SpotifyListPlaylists;
use OpenCompany\Integrations\Spotify\Tools\SpotifyGetPlaylist;
use OpenCompany\Integrations\Spotify\Tools\SpotifyCreatePlaylist;
use OpenCompany\Integrations\Spotify\Tools\SpotifyListAlbums;
use OpenCompany\Integrations\Spotify\Tools\SpotifyGetCurrentUser;

class SpotifyToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Get the application name used for registration.
     */
    public function appName(): string
    {
        return 'spotify';
    }

    /**
     * Get metadata for the tool provider UI.
     *
     * @return array<string, mixed> UI metadata.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'search, tracks, artists, playlists, albums',
            'description' => 'Music streaming',
            'icon' => 'ph:music-note',
            'logo' => 'simple-icons:spotify',
        ];
    }

    /**
     * Get integration metadata for the marketplace UI.
     *
     * @return array<string, mixed> Integration metadata.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Spotify',
            'description' => 'Music streaming and playlist management',
            'icon' => 'ph:music-note',
            'logo' => 'simple-icons:spotify',
            'category' => 'media',
            'badge' => 'verified',
            'docs_url' => 'https://developer.spotify.com/documentation/web-api',
        ];
    }

    /**
     * Get the configuration schema for the integration settings UI.
     *
     * @return array<int, array<string, mixed>> The configuration fields.
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Spotify OAuth access token',
                'hint' => 'Generate an access token via the Spotify OAuth flow in your <a href="https://developer.spotify.com/dashboard" target="_blank">Spotify Developer Dashboard</a>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.spotify.com/v1',
                'hint' => 'The Spotify Web API base URL. Override only for proxying or testing.',
                'default' => 'https://api.spotify.com/v1',
            ],
        ];
    }

    /**
     * Test the connection to the Spotify API with the given credentials.
     *
     * @param  array<string, mixed>  $config  Configuration values to test.
     * @return array{success: bool, message?: string, error?: string} The test result.
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.spotify.com/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/me');

            $json = $response->json();

            if ($response->status() === 401) {
                return [
                    'success' => false,
                    'error' => 'Invalid or expired access token.',
                ];
            }

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Spotify API at {$baseUrl}. Check the URL.",
                ];
            }

            $displayName = $json['display_name'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Spotify as {$displayName}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get the validation rules for the configuration fields.
     *
     * @return array<string, mixed> Laravel validation rules.
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'spotify_search' => [
                'class' => SpotifySearch::class,
                'type' => 'read',
                'name' => 'Search',
                'description' => 'Search for tracks, artists, albums, or playlists on Spotify.',
                'icon' => 'ph:magnifying-glass',
            ],
            'spotify_get_track' => [
                'class' => SpotifyGetTrack::class,
                'type' => 'read',
                'name' => 'Get Track',
                'description' => 'Get detailed information about a specific track.',
                'icon' => 'ph:music-note',
            ],
            'spotify_get_artist' => [
                'class' => SpotifyGetArtist::class,
                'type' => 'read',
                'name' => 'Get Artist',
                'description' => 'Get detailed information about a specific artist.',
                'icon' => 'ph:microphone-stage',
            ],
            'spotify_list_playlists' => [
                'class' => SpotifyListPlaylists::class,
                'type' => 'read',
                'name' => 'List Playlists',
                'description' => 'List the current user\'s playlists.',
                'icon' => 'ph:list-music',
            ],
            'spotify_get_playlist' => [
                'class' => SpotifyGetPlaylist::class,
                'type' => 'read',
                'name' => 'Get Playlist',
                'description' => 'Get detailed information about a playlist and its tracks.',
                'icon' => 'ph:list-music',
            ],
            'spotify_create_playlist' => [
                'class' => SpotifyCreatePlaylist::class,
                'type' => 'write',
                'name' => 'Create Playlist',
                'description' => 'Create a new playlist for the current user.',
                'icon' => 'ph:plus-circle',
            ],
            'spotify_list_albums' => [
                'class' => SpotifyListAlbums::class,
                'type' => 'read',
                'name' => 'List Albums',
                'description' => 'List albums by a specific artist.',
                'icon' => 'ph:disc',
            ],
            'spotify_get_current_user' => [
                'class' => SpotifyGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s Spotify profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/spotify.md';
    }

    /**
     * Get the credential fields for the integration.
     *
     * @return array<int, array{key: string, type: string, label: string, required?: bool, default?: string}>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API URL', 'required' => false, 'default' => 'https://api.spotify.com/v1'],
        ];
    }

    /**
     * Confirm this is an integration provider.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally for a specific account.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context with optional 'account' key for multi-account support.
     * @return Tool The instantiated tool.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new SpotifyService(
                accessToken: $creds->get('spotify', 'access_token', '', $account),
                baseUrl: $creds->get('spotify', 'url', 'https://api.spotify.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(SpotifyService::class));
    }
}
