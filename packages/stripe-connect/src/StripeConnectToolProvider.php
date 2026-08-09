<?php

namespace OpenCompany\Integrations\StripeConnect;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\StripeConnect\Tools\StripeConnectListAccounts;
use OpenCompany\Integrations\StripeConnect\Tools\StripeConnectGetAccount;
use OpenCompany\Integrations\StripeConnect\Tools\StripeConnectListPayouts;
use OpenCompany\Integrations\StripeConnect\Tools\StripeConnectGetPayout;
use OpenCompany\Integrations\StripeConnect\Tools\StripeConnectListBalances;
use OpenCompany\Integrations\StripeConnect\Tools\StripeConnectListCapabilities;
use OpenCompany\Integrations\StripeConnect\Tools\StripeConnectGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Registers all Stripe Connect tools and provides integration metadata.
 */
class StripeConnectToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

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
        return 'stripe-connect';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Stripe Connect',
            'description' => 'Stripe Connect platform management',
            'icon' => 'ph:credit-card',
            'logo' => 'simple-icons:stripe',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Stripe Connect',
            'description' => 'Manage Stripe Connect accounts, payouts, balance transactions, and capabilities',
            'icon' => 'ph:credit-card',
            'logo' => 'simple-icons:stripe',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://docs.stripe.com/connect',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'sk_live_... or sk_test_...',
                'hint' => 'Your Stripe API key used as a Bearer token. Find in Stripe Dashboard → Developers → API keys.',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'Base URL',
                'placeholder' => 'https://api.stripe.com',
                'hint' => 'Stripe API base URL. Use <code>https://api.stripe.com</code> for production.',
                'default' => 'https://api.stripe.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://api.stripe.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided. Find yours at Stripe Dashboard → Developers → API keys.'];
        }

        try {
            $response = Http::withToken($accessToken)
                ->timeout(10)
                ->get($baseUrl . '/v1/accounts', ['limit' => 1]);

            if ($response->successful()) {
                $data = $response->json() ?? [];

                return [
                    'success' => true,
                    'message' => 'Connected to Stripe Connect.',
                ];
            }

            $error = $response->json('error.message') ?? $response->body();

            return [
                'success' => false,
                'error' => 'Stripe Connect API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'stripe_connect_list_accounts' => [
                'class' => StripeConnectListAccounts::class,
                'type' => 'read',
                'name' => 'List Accounts',
                'description' => 'List Stripe Connect accounts.',
                'icon' => 'ph:users',
            ],
            'stripe_connect_get_account' => [
                'class' => StripeConnectGetAccount::class,
                'type' => 'read',
                'name' => 'Get Account',
                'description' => 'Retrieve a Stripe Connect account by ID.',
                'icon' => 'ph:user',
            ],
            'stripe_connect_list_payouts' => [
                'class' => StripeConnectListPayouts::class,
                'type' => 'read',
                'name' => 'List Payouts',
                'description' => 'List Stripe Connect payouts with optional filtering.',
                'icon' => 'ph:money',
            ],
            'stripe_connect_get_payout' => [
                'class' => StripeConnectGetPayout::class,
                'type' => 'read',
                'name' => 'Get Payout',
                'description' => 'Retrieve a Stripe Connect payout by ID.',
                'icon' => 'ph:money',
            ],
            'stripe_connect_list_balances' => [
                'class' => StripeConnectListBalances::class,
                'type' => 'read',
                'name' => 'List Balances',
                'description' => 'List Stripe Connect balance transactions.',
                'icon' => 'ph:wallet',
            ],
            'stripe_connect_list_capabilities' => [
                'class' => StripeConnectListCapabilities::class,
                'type' => 'read',
                'name' => 'List Capabilities',
                'description' => 'List Stripe Connect account capabilities.',
                'icon' => 'ph:check-circle',
            ],
            'stripe_connect_get_current_user' => [
                'class' => StripeConnectGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Stripe Connect user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/stripe-connect.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'Base URL', 'required' => false, 'default' => 'https://api.stripe.com'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new StripeConnectService(
                accessToken: $creds->get('stripe-connect', 'access_token', '', $account),
                baseUrl: $creds->get('stripe-connect', 'base_url', 'https://api.stripe.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(StripeConnectService::class));
    }
}
