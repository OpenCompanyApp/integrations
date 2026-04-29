<?php

namespace OpenCompany\Integrations\Venmo;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Venmo\Tools\VenmoListPayments;
use OpenCompany\Integrations\Venmo\Tools\VenmoGetPayment;
use OpenCompany\Integrations\Venmo\Tools\VenmoCreatePayment;
use OpenCompany\Integrations\Venmo\Tools\VenmoListUsers;
use OpenCompany\Integrations\Venmo\Tools\VenmoGetUser;
use OpenCompany\Integrations\Venmo\Tools\VenmoListTransactions;
use OpenCompany\Integrations\Venmo\Tools\VenmoGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Registers all Venmo tools and provides integration metadata.
 */
class VenmoToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

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
        return 'venmo';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Venmo',
            'description' => 'Peer-to-peer payments',
            'icon' => 'ph:money',
            'logo' => 'simple-icons:venmo',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Venmo',
            'description' => 'Peer-to-peer payments, transfers, and transaction management',
            'icon' => 'ph:money',
            'logo' => 'simple-icons:venmo',
            'category' => 'finance',
            'badge' => 'verified',
            'docs_url' => 'https://developer.venmo.com',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'your-venmo-access-token',
                'hint' => 'Obtain via Venmo OAuth flow. See Venmo developer documentation for details.',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided. Obtain one via the Venmo OAuth flow.'];
        }

        try {
            $response = Http::withToken($accessToken)
                ->timeout(10)
                ->get('https://api.venmo.com/v1/me');

            if ($response->successful()) {
                $data = $response->json() ?? [];
                $username = $data['data']['user']['username'] ?? 'unknown';

                return [
                    'success' => true,
                    'message' => "Connected to Venmo as @{$username}.",
                ];
            }

            $error = $response->json('error.message') ?? $response->body();

            return [
                'success' => false,
                'error' => 'Venmo API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
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
        ];
    }

    public function tools(): array
    {
        return [
            // Payments
            'venmo_list_payments' => [
                'class' => VenmoListPayments::class,
                'type' => 'read',
                'name' => 'List Payments',
                'description' => 'List Venmo payments.',
                'icon' => 'ph:list-bullets',
            ],
            'venmo_get_payment' => [
                'class' => VenmoGetPayment::class,
                'type' => 'read',
                'name' => 'Get Payment',
                'description' => 'Retrieve a Venmo payment by ID.',
                'icon' => 'ph:money',
            ],
            'venmo_create_payment' => [
                'class' => VenmoCreatePayment::class,
                'type' => 'write',
                'name' => 'Create Payment',
                'description' => 'Create a Venmo payment.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            // Users
            'venmo_list_users' => [
                'class' => VenmoListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List Venmo users.',
                'icon' => 'ph:users',
            ],
            'venmo_get_user' => [
                'class' => VenmoGetUser::class,
                'type' => 'read',
                'name' => 'Get User',
                'description' => 'Retrieve a Venmo user by ID.',
                'icon' => 'ph:user',
            ],
            // Transactions
            'venmo_list_transactions' => [
                'class' => VenmoListTransactions::class,
                'type' => 'read',
                'name' => 'List Transactions',
                'description' => 'List Venmo transactions.',
                'icon' => 'ph:arrows-left-right',
            ],
            // Current User
            'venmo_get_current_user' => [
                'class' => VenmoGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Venmo user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/venmo.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the VenmoService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): VenmoService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new VenmoService(
                accessToken: $creds->get('venmo', 'access_token', '', $account),
            );
        }

        return app(VenmoService::class);
    }
}
