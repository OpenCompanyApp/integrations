<?php

namespace OpenCompany\Integrations\Mux;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Mux\Tools\MuxListAssets;
use OpenCompany\Integrations\Mux\Tools\MuxGetAsset;
use OpenCompany\Integrations\Mux\Tools\MuxCreateAsset;
use OpenCompany\Integrations\Mux\Tools\MuxListLiveStreams;
use OpenCompany\Integrations\Mux\Tools\MuxGetLiveStream;
use OpenCompany\Integrations\Mux\Tools\MuxCreateLiveStream;
use OpenCompany\Integrations\Mux\Tools\MuxGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Tool provider for the Mux video integration.
 *
 * Implements ConfigurableIntegration for multi-account support and
 * registers all 7 Mux tools with the integration framework.
 */
class MuxToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

/**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
          'auth' => [
            'strategy' => 'bearer_token',
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
        return 'mux';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Mux',
            'description' => 'Video infrastructure',
            'icon' => 'ph:video-camera',
            'logo' => 'simple-icons:mux',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Mux',
            'description' => 'Video streaming infrastructure — manage on-demand assets, live streams, and realtime viewer data.',
            'icon' => 'ph:video-camera',
            'logo' => 'simple-icons:mux',
            'category' => 'media',
            'badge' => 'verified',
            'docs_url' => 'https://docs.mux.com/api-reference',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Mux access token',
                'hint' => 'Generate an access token in the Mux dashboard under "Settings → API Access Tokens". Use a token with appropriate permissions.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.mux.com',
                'hint' => 'Use <code>https://api.mux.com</code> for production, or override for a custom endpoint.',
                'default' => 'https://api.mux.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.mux.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/data/v1/realtime');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Mux API at {$baseUrl}. Check the URL and access token.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Mux API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'mux_list_assets' => [
                'class' => MuxListAssets::class,
                'type' => 'read',
                'name' => 'List Assets',
                'description' => 'List video assets stored in Mux.',
                'icon' => 'ph:film-strip',
            ],
            'mux_get_asset' => [
                'class' => MuxGetAsset::class,
                'type' => 'read',
                'name' => 'Get Asset',
                'description' => 'Retrieve details of a specific video asset.',
                'icon' => 'ph:film-strip',
            ],
            'mux_create_asset' => [
                'class' => MuxCreateAsset::class,
                'type' => 'write',
                'name' => 'Create Asset',
                'description' => 'Create a new video asset from an input URL.',
                'icon' => 'ph:plus-circle',
            ],
            'mux_list_live_streams' => [
                'class' => MuxListLiveStreams::class,
                'type' => 'read',
                'name' => 'List Live Streams',
                'description' => 'List live streams in Mux.',
                'icon' => 'ph:broadcast',
            ],
            'mux_get_live_stream' => [
                'class' => MuxGetLiveStream::class,
                'type' => 'read',
                'name' => 'Get Live Stream',
                'description' => 'Retrieve details of a specific live stream.',
                'icon' => 'ph:broadcast',
            ],
            'mux_create_live_stream' => [
                'class' => MuxCreateLiveStream::class,
                'type' => 'write',
                'name' => 'Create Live Stream',
                'description' => 'Create a new live stream.',
                'icon' => 'ph:plus-circle',
            ],
            'mux_get_current_user' => [
                'class' => MuxGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Realtime Data',
                'description' => 'Get realtime viewer data from Mux Data.',
                'icon' => 'ph:chart-bar',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/mux.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Mux API URL', 'required' => false, 'default' => 'https://api.mux.com'],
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

            $service = new MuxService(
                accessToken: $creds->get('mux', 'access_token', '', $account),
                baseUrl: $creds->get('mux', 'url', 'https://api.mux.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(MuxService::class));
    }
}
