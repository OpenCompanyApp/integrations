<?php

namespace OpenCompany\Integrations\KoFi;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\KoFi\Tools\KoFiListSupporters;
use OpenCompany\Integrations\KoFi\Tools\KoFiGetSupporter;
use OpenCompany\Integrations\KoFi\Tools\KoFiListTransactions;
use OpenCompany\Integrations\KoFi\Tools\KoFiListCommissions;
use OpenCompany\Integrations\KoFi\Tools\KoFiGetCommission;
use OpenCompany\Integrations\KoFi\Tools\KoFiListShopItems;
use OpenCompany\Integrations\KoFi\Tools\KoFiGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class KoFiToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'ko-fi';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'supporters, transactions, commissions, shop items',
            'description' => 'Creator platform',
            'icon' => 'ph:coffee',
            'logo' => 'simple-icons:kofi',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Ko-fi',
            'description' => 'Receive support from fans, sell digital products, and offer commissions',
            'icon' => 'ph:coffee',
            'logo' => 'simple-icons:kofi',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://ko-fi.com/manage/api',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Ko-fi access token',
                'hint' => 'Generate an access token in your Ko-fi account under <strong>Settings → API</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://ko-fi.com/api/v1',
                'hint' => 'Use the default Ko-fi API URL. Only change if using a custom endpoint.',
                'default' => 'https://ko-fi.com/api/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://ko-fi.com/api/v1', '/');

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
                    'error' => "Could not reach Ko-fi API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $json['message'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Ko-fi API error: {$error}",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Ko-fi API as @" . ($json['user']['name'] ?? 'unknown') . ".",
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
            'ko-fi_list_supporters' => [
                'class' => KoFiListSupporters::class,
                'type' => 'read',
                'name' => 'List Supporters',
                'description' => 'List all supporters who have donated or subscribed.',
                'icon' => 'ph:users',
            ],
            'ko-fi_get_supporter' => [
                'class' => KoFiGetSupporter::class,
                'type' => 'read',
                'name' => 'Get Supporter',
                'description' => 'Get details for a single supporter.',
                'icon' => 'ph:user',
            ],
            'ko-fi_list_transactions' => [
                'class' => KoFiListTransactions::class,
                'type' => 'read',
                'name' => 'List Transactions',
                'description' => 'List all transactions (donations, subscriptions, shop orders).',
                'icon' => 'ph:receipt',
            ],
            'ko-fi_list_commissions' => [
                'class' => KoFiListCommissions::class,
                'type' => 'read',
                'name' => 'List Commissions',
                'description' => 'List all commission requests.',
                'icon' => 'ph:paint-brush',
            ],
            'ko-fi_get_commission' => [
                'class' => KoFiGetCommission::class,
                'type' => 'read',
                'name' => 'Get Commission',
                'description' => 'Get details for a single commission.',
                'icon' => 'ph:paint-brush',
            ],
            'ko-fi_list_shop_items' => [
                'class' => KoFiListShopItems::class,
                'type' => 'read',
                'name' => 'List Shop Items',
                'description' => 'List all items in your Ko-fi shop.',
                'icon' => 'ph:storefront',
            ],
            'ko-fi_get_current_user' => [
                'class' => KoFiGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/ko-fi.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://ko-fi.com/api/v1'],
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

            $service = new KoFiService(
                accessToken: $creds->get('ko-fi', 'access_token', '', $account),
                baseUrl: $creds->get('ko-fi', 'url', 'https://ko-fi.com/api/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(KoFiService::class));
    }
}
