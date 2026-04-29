<?php

namespace OpenCompany\Integrations\Kajabi;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Kajabi\Tools\KajabiListOffers;
use OpenCompany\Integrations\Kajabi\Tools\KajabiGetOffer;
use OpenCompany\Integrations\Kajabi\Tools\KajabiListProducts;
use OpenCompany\Integrations\Kajabi\Tools\KajabiGetProduct;
use OpenCompany\Integrations\Kajabi\Tools\KajabiListMembers;
use OpenCompany\Integrations\Kajabi\Tools\KajabiGetMember;
use OpenCompany\Integrations\Kajabi\Tools\KajabiGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class KajabiToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'kajabi';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Kajabi',
            'description' => 'Online courses & marketing',
            'icon' => 'ph:graduation-cap',
            'logo' => 'simple-icons:kajabi',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Kajabi',
            'description' => 'Create and sell online courses, coaching programs, and membership sites',
            'icon' => 'ph:graduation-cap',
            'logo' => 'simple-icons:kajabi',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.kajabi.com/docs',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Kajabi access token',
                'hint' => 'Generate an API key in your Kajabi account under <strong>Settings → API</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://app.kajabi.com/api/v1',
                'hint' => 'Use the default Kajabi API URL. Only change if using a custom endpoint.',
                'default' => 'https://app.kajabi.com/api/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://app.kajabi.com/api/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Kajabi API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $json['message'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Kajabi API error: {$error}",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Kajabi API as " . ($json['user']['name'] ?? $json['user']['email'] ?? 'unknown') . ".",
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
            'kajabi_list_offers' => [
                'class' => KajabiListOffers::class,
                'type' => 'read',
                'name' => 'List Offers',
                'description' => 'List all offers in your Kajabi account.',
                'icon' => 'ph:tag',
            ],
            'kajabi_get_offer' => [
                'class' => KajabiGetOffer::class,
                'type' => 'read',
                'name' => 'Get Offer',
                'description' => 'Get details for a single offer.',
                'icon' => 'ph:tag',
            ],
            'kajabi_list_products' => [
                'class' => KajabiListProducts::class,
                'type' => 'read',
                'name' => 'List Products',
                'description' => 'List all products (courses, coaching, memberships).',
                'icon' => 'ph:package',
            ],
            'kajabi_get_product' => [
                'class' => KajabiGetProduct::class,
                'type' => 'read',
                'name' => 'Get Product',
                'description' => 'Get details for a single product.',
                'icon' => 'ph:package',
            ],
            'kajabi_list_members' => [
                'class' => KajabiListMembers::class,
                'type' => 'read',
                'name' => 'List Members',
                'description' => 'List all members in your Kajabi account.',
                'icon' => 'ph:users',
            ],
            'kajabi_get_member' => [
                'class' => KajabiGetMember::class,
                'type' => 'read',
                'name' => 'Get Member',
                'description' => 'Get details for a single member.',
                'icon' => 'ph:user',
            ],
            'kajabi_get_current_user' => [
                'class' => KajabiGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/kajabi.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://app.kajabi.com/api/v1'],
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

            $service = new KajabiService(
                accessToken: $creds->get('kajabi', 'access_token', '', $account),
                baseUrl: $creds->get('kajabi', 'url', 'https://app.kajabi.com/api/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(KajabiService::class));
    }
}
