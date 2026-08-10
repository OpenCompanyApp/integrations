<?php

namespace OpenCompany\Integrations\Twitch;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Twitch\Tools\TwitchListStreams;
use OpenCompany\Integrations\Twitch\Tools\TwitchGetUser;
use OpenCompany\Integrations\Twitch\Tools\TwitchListGames;
use OpenCompany\Integrations\Twitch\Tools\TwitchGetGame;
use OpenCompany\Integrations\Twitch\Tools\TwitchListChannels;
use OpenCompany\Integrations\Twitch\Tools\TwitchGetChannel;
use OpenCompany\Integrations\Twitch\Tools\TwitchSearchCategories;
use OpenCompany\Integrations\Twitch\Tools\TwitchGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class TwitchToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{

/**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
          'auth' => [
            'strategy' => 'oauth2_manual_token',
            'legacy_auth_type' => 'oauth',
            'credential_mode' => 'stored_token',
            'setup_flows' =>
            [
              0 => 'manual_token',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
              0 => 'access_token',
            ],
            'notes' =>
            [
              0 => 'Token acquisition may happen outside this package, but the host only needs to store the resulting token.',
            ],
          ],
          'host_availability' => [
            'web' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_token',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_token',
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
        return 'twitch';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Twitch',
            'description' => 'Live streaming platform',
            'icon' => 'ph:tv',
            'logo' => 'simple-icons:twitch',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Twitch',
            'description' => 'Live streaming platform for gamers and creators',
            'icon' => 'ph:tv',
            'logo' => 'simple-icons:twitch',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://dev.twitch.tv/docs/api/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Twitch access token',
                'hint' => 'Generate an access token in the Twitch Developer Console or via OAuth',
                'required' => true,
            ],
            [
                'key' => 'client_id',
                'type' => 'string',
                'label' => 'Client ID',
                'placeholder' => 'Enter your Twitch client ID',
                'hint' => 'Found in your Twitch Developer Console application settings',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.twitch.tv/helix',
                'hint' => 'Twitch Helix API base URL. Change only if using a proxy.',
                'default' => 'https://api.twitch.tv/helix',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $clientId = $config['client_id'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://api.twitch.tv/helix', '/');

        if (empty($accessToken) || empty($clientId)) {
            return ['success' => false, 'error' => 'Access token and client ID are required'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Client-Id' => $clientId,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Twitch API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $message = $json['message'] ?? $response->body();
                return [
                    'success' => false,
                    'error' => "Twitch API error: {$message}",
                ];
            }

            $login = $json['data'][0]['login'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Twitch API as {$login}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'client_id' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'twitch_list_streams' => [
                'class' => TwitchListStreams::class,
                'type' => 'read',
                'name' => 'List Streams',
                'description' => 'List live streams, optionally filtered by game or language.',
                'icon' => 'ph:broadcast',
            ],
            'twitch_get_user' => [
                'class' => TwitchGetUser::class,
                'type' => 'read',
                'name' => 'Get User',
                'description' => 'Get information about a Twitch user by ID or login name.',
                'icon' => 'ph:user',
            ],
            'twitch_list_games' => [
                'class' => TwitchListGames::class,
                'type' => 'read',
                'name' => 'List Games',
                'description' => 'Get information about one or more games.',
                'icon' => 'ph:game-controller',
            ],
            'twitch_get_game' => [
                'class' => TwitchGetGame::class,
                'type' => 'read',
                'name' => 'Get Game',
                'description' => 'Get information about a specific game by ID.',
                'icon' => 'ph:game-controller',
            ],
            'twitch_list_channels' => [
                'class' => TwitchListChannels::class,
                'type' => 'read',
                'name' => 'List Channels',
                'description' => 'List channel information.',
                'icon' => 'ph:channels',
            ],
            'twitch_get_channel' => [
                'class' => TwitchGetChannel::class,
                'type' => 'read',
                'name' => 'Get Channel',
                'description' => 'Get channel information for a specific broadcaster.',
                'icon' => 'ph:channels',
            ],
            'twitch_search_categories' => [
                'class' => TwitchSearchCategories::class,
                'type' => 'read',
                'name' => 'Search Categories',
                'description' => 'Search for games/categories on Twitch.',
                'icon' => 'ph:magnifying-glass',
            ],
            'twitch_get_current_user' => [
                'class' => TwitchGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s information.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/twitch.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'client_id', 'type' => 'string', 'label' => 'Client ID', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.twitch.tv/helix'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new TwitchService(
                accessToken: $creds->get('twitch', 'access_token', '', $account),
                clientId: $creds->get('twitch', 'client_id', '', $account),
                baseUrl: $creds->get('twitch', 'base_url', 'https://api.twitch.tv/helix', $account),
            );

            return new $class($service);
        }

        return new $class(app(TwitchService::class));
    }
}
