<?php

namespace OpenCompany\Integrations\Revolut;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Revolut\Tools\RevolutListAccounts;
use OpenCompany\Integrations\Revolut\Tools\RevolutGetAccount;
use OpenCompany\Integrations\Revolut\Tools\RevolutListTransactions;
use OpenCompany\Integrations\Revolut\Tools\RevolutGetTransaction;
use OpenCompany\Integrations\Revolut\Tools\RevolutListCards;
use OpenCompany\Integrations\Revolut\Tools\RevolutGetCard;
use OpenCompany\Integrations\Revolut\Tools\RevolutGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Registers all Revolut tools and provides integration metadata.
 */
class RevolutToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

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
        return 'revolut';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Revolut',
            'description' => 'Revolut Business Banking',
            'icon' => 'ph:bank',
            'logo' => 'simple-icons:revolut',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Revolut',
            'description' => 'Business banking — accounts, transactions, and card management',
            'icon' => 'ph:bank',
            'logo' => 'simple-icons:revolut',
            'category' => 'sales',
            'badge' => 'verified',
            'docs_url' => 'https://developer.revolut.com/docs/business-api',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'oa_prod_xxx...',
                'hint' => 'Generate an access token in the Revolut Business Developer Portal. Use a token with the permissions you need.',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided. Generate one in the Revolut Business Developer Portal.'];
        }

        try {
            $response = Http::withToken($accessToken)
                ->timeout(10)
                ->get('https://api.revolut.com/v1/accounts');

            if ($response->successful()) {
                $accounts = $response->json() ?? [];
                $count = is_array($accounts) ? count($accounts) : 0;

                return [
                    'success' => true,
                    'message' => "Connected to Revolut. Found {$count} account(s).",
                ];
            }

            $error = $response->json('message') ?? $response->json('error') ?? $response->body();

            return [
                'success' => false,
                'error' => 'Revolut API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
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
            // Accounts
            'revolut_list_accounts' => [
                'class' => RevolutListAccounts::class,
                'type' => 'read',
                'name' => 'List Accounts',
                'description' => 'List all Revolut business accounts.',
                'icon' => 'ph:bank',
            ],
            'revolut_get_account' => [
                'class' => RevolutGetAccount::class,
                'type' => 'read',
                'name' => 'Get Account',
                'description' => 'Retrieve a Revolut account by ID.',
                'icon' => 'ph:bank',
            ],
            // Transactions
            'revolut_list_transactions' => [
                'class' => RevolutListTransactions::class,
                'type' => 'read',
                'name' => 'List Transactions',
                'description' => 'List Revolut transactions with optional filters.',
                'icon' => 'ph:list-bullets',
            ],
            'revolut_get_transaction' => [
                'class' => RevolutGetTransaction::class,
                'type' => 'read',
                'name' => 'Get Transaction',
                'description' => 'Retrieve a Revolut transaction by ID.',
                'icon' => 'ph:receipt',
            ],
            // Cards
            'revolut_list_cards' => [
                'class' => RevolutListCards::class,
                'type' => 'read',
                'name' => 'List Cards',
                'description' => 'List all Revolut business cards.',
                'icon' => 'ph:credit-card',
            ],
            'revolut_get_card' => [
                'class' => RevolutGetCard::class,
                'type' => 'read',
                'name' => 'Get Card',
                'description' => 'Retrieve a Revolut card by ID.',
                'icon' => 'ph:credit-card',
            ],
            // User
            'revolut_get_current_user' => [
                'class' => RevolutGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Revolut user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/revolut.md';
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
     * Resolve the RevolutService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): RevolutService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new RevolutService(
                accessToken: $creds->get('revolut', 'access_token', '', $account),
            );
        }

        return app(RevolutService::class);
    }
}
