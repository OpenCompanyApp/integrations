<?php

namespace OpenCompany\Integrations\BuyMeACoffee;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\BuyMeACoffee\Tools\BuyMeACoffeeListSupporters;
use OpenCompany\Integrations\BuyMeACoffee\Tools\BuyMeACoffeeGetSupporter;
use OpenCompany\Integrations\BuyMeACoffee\Tools\BuyMeACoffeeListSubscriptions;
use OpenCompany\Integrations\BuyMeACoffee\Tools\BuyMeACoffeeListExtras;
use OpenCompany\Integrations\BuyMeACoffee\Tools\BuyMeACoffeeGetExtra;
use OpenCompany\Integrations\BuyMeACoffee\Tools\BuyMeACoffeeListShops;
use OpenCompany\Integrations\BuyMeACoffee\Tools\BuyMeACoffeeGetCurrentUser;

class BuyMeACoffeeToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string { return 'buymeacoffee'; }

    public function appMeta(): array
    {
        return [
            'label' => 'supporters, subscriptions, extras, shops',
            'description' => 'Creator platform',
            'icon' => 'ph:coffee',
            'logo' => 'simple-icons:buymeacoffee',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Buy Me a Coffee',
            'description' => 'Receive support from your audience through one-time and recurring payments',
            'icon' => 'ph:coffee',
            'logo' => 'simple-icons:buymeacoffee',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.buymeacoffee.com/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Buy Me a Coffee access token',
                'hint' => 'Generate an access token in your Buy Me a Coffee dashboard under <strong>Settings → Access Tokens</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://developers.buymeacoffee.com/api/v1',
                'hint' => 'Use the default Buy Me a Coffee API URL. Only change if using a custom endpoint.',
                'default' => 'https://developers.buymeacoffee.com/api/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://developers.buymeacoffee.com/api/v1', '/');

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
                return ['success' => false, 'error' => "Could not reach Buy Me a Coffee API at {$baseUrl}. Check the URL."];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $json['message'] ?? 'Unknown error';
                return ['success' => false, 'error' => "Buy Me a Coffee API error: {$error}"];
            }

            return [
                'success' => true,
                'message' => "Connected to Buy Me a Coffee API as @" . ($json['data']['user_name'] ?? 'unknown') . ".",
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
            'buymeacoffee_list_supporters' => [
                'class' => BuyMeACoffeeListSupporters::class,
                'type' => 'read',
                'name' => 'List Supporters',
                'description' => 'List all supporters with optional filters.',
                'icon' => 'ph:users',
            ],
            'buymeacoffee_get_supporter' => [
                'class' => BuyMeACoffeeGetSupporter::class,
                'type' => 'read',
                'name' => 'Get Supporter',
                'description' => 'Get details for a single supporter.',
                'icon' => 'ph:user',
            ],
            'buymeacoffee_list_subscriptions' => [
                'class' => BuyMeACoffeeListSubscriptions::class,
                'type' => 'read',
                'name' => 'List Subscriptions',
                'description' => 'List all active subscriptions.',
                'icon' => 'ph:arrows-repeat',
            ],
            'buymeacoffee_list_extras' => [
                'class' => BuyMeACoffeeListExtras::class,
                'type' => 'read',
                'name' => 'List Extras',
                'description' => 'List all extras (additional purchase options).',
                'icon' => 'ph:star',
            ],
            'buymeacoffee_get_extra' => [
                'class' => BuyMeACoffeeGetExtra::class,
                'type' => 'read',
                'name' => 'Get Extra',
                'description' => 'Get details for a single extra.',
                'icon' => 'ph:star',
            ],
            'buymeacoffee_list_shops' => [
                'class' => BuyMeACoffeeListShops::class,
                'type' => 'read',
                'name' => 'List Shops',
                'description' => 'List all shop items.',
                'icon' => 'ph:storefront',
            ],
            'buymeacoffee_get_current_user' => [
                'class' => BuyMeACoffeeGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/buymeacoffee.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://developers.buymeacoffee.com/api/v1'],
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

            $service = new BuyMeACoffeeService(
                accessToken: $creds->get('buymeacoffee', 'access_token', '', $account),
                baseUrl: $creds->get('buymeacoffee', 'url', 'https://developers.buymeacoffee.com/api/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(BuyMeACoffeeService::class));
    }
}
