<?php

namespace OpenCompany\Integrations\Lob;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Lob\Tools\LobListLetters;
use OpenCompany\Integrations\Lob\Tools\LobGetLetter;
use OpenCompany\Integrations\Lob\Tools\LobCreateLetter;
use OpenCompany\Integrations\Lob\Tools\LobListPostcards;
use OpenCompany\Integrations\Lob\Tools\LobGetPostcard;
use OpenCompany\Integrations\Lob\Tools\LobCreatePostcard;
use OpenCompany\Integrations\Lob\Tools\LobGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class LobToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'lob';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Lob',
            'description' => 'Print & mail automation',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:lob',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Lob',
            'description' => 'Print and mail automation — send letters and postcards, manage addresses',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:lob',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://docs.lob.com/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Lob API key',
                'hint' => 'Find your API key in the Lob Dashboard under Settings → API Keys. Use a test key (<code>test_...</code>) for development or a live key (<code>live_...</code>) for production.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Base URL',
                'placeholder' => 'https://api.lob.com',
                'hint' => 'Use <code>https://api.lob.com</code> for the Lob API. The test/live mode is determined by your API key prefix.',
                'default' => 'https://api.lob.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.lob.com', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->withBasicAuth($apiKey, '')->timeout(10)->get($baseUrl . '/v1/addresses');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Lob API at {$baseUrl}. Check the URL and API key.",
                ];
            }

            $keyType = str_starts_with($apiKey, 'test_') ? 'test' : 'live';

            return [
                'success' => true,
                'message' => "Connected to Lob API ({$keyType} mode) at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'lob_list_letters' => [
                'class' => LobListLetters::class,
                'type' => 'read',
                'name' => 'List Letters',
                'description' => 'List letters with pagination.',
                'icon' => 'ph:list',
            ],
            'lob_get_letter' => [
                'class' => LobGetLetter::class,
                'type' => 'read',
                'name' => 'Get Letter',
                'description' => 'Retrieve a letter by ID.',
                'icon' => 'ph:envelope',
            ],
            'lob_create_letter' => [
                'class' => LobCreateLetter::class,
                'type' => 'write',
                'name' => 'Create Letter',
                'description' => 'Create and send a letter via Lob.',
                'icon' => 'ph:envelope',
            ],
            'lob_list_postcards' => [
                'class' => LobListPostcards::class,
                'type' => 'read',
                'name' => 'List Postcards',
                'description' => 'List postcards with pagination.',
                'icon' => 'ph:list',
            ],
            'lob_get_postcard' => [
                'class' => LobGetPostcard::class,
                'type' => 'read',
                'name' => 'Get Postcard',
                'description' => 'Retrieve a postcard by ID.',
                'icon' => 'ph:postcard',
            ],
            'lob_create_postcard' => [
                'class' => LobCreatePostcard::class,
                'type' => 'write',
                'name' => 'Create Postcard',
                'description' => 'Create and send a postcard via Lob.',
                'icon' => 'ph:postcard',
            ],
            'lob_get_current_user' => [
                'class' => LobGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Addresses',
                'description' => 'List saved addresses in the Lob account.',
                'icon' => 'ph:map-pin',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/lob.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Base URL', 'required' => false, 'default' => 'https://api.lob.com'],
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

            $service = new LobService(
                apiKey: $creds->get('lob', 'api_key', '', $account),
                baseUrl: $creds->get('lob', 'url', 'https://api.lob.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(LobService::class));
    }
}
