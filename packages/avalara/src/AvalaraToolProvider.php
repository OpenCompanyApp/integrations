<?php

namespace OpenCompany\Integrations\Avalara;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Avalara\Tools\AvalaraListTransactions;
use OpenCompany\Integrations\Avalara\Tools\AvalaraGetTransaction;
use OpenCompany\Integrations\Avalara\Tools\AvalaraCreateTransaction;
use OpenCompany\Integrations\Avalara\Tools\AvalaraListCompanies;
use OpenCompany\Integrations\Avalara\Tools\AvalaraGetCompany;
use OpenCompany\Integrations\Avalara\Tools\AvalaraListTaxCodes;
use OpenCompany\Integrations\Avalara\Tools\AvalaraGetCurrentUser;

class AvalaraToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string { return 'avalara'; }

    public function appMeta(): array
    {
        return [
            'label' => 'transactions, companies, tax codes',
            'description' => 'Tax automation & compliance',
            'icon' => 'ph:receipt',
            'logo' => 'simple-icons:avalara',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Avalara',
            'description' => 'Automated tax calculation, reporting, and compliance',
            'icon' => 'ph:receipt',
            'logo' => 'simple-icons:avalara',
            'category' => 'sales',
            'badge' => 'verified',
            'docs_url' => 'https://developer.avalara.com/api-reference/avatax/rest/v2/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Avalara API access token',
                'hint' => 'Generate a bearer token from your Avalara account under Settings > License and API Keys.',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $baseUrl = 'https://api.avalara.com/v2';
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/me');

            if ($response->successful()) {
                return ['success' => true, 'message' => 'Connected to Avalara successfully.'];
            }
            return ['success' => false, 'error' => "Authentication failed (HTTP {$response->status()}). Check your access token."];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'avalara_list_transactions' => [
                'class' => AvalaraListTransactions::class,
                'type' => 'read', 'name' => 'List Transactions',
                'description' => 'List transactions with optional filtering and pagination.',
                'icon' => 'ph:list',
            ],
            'avalara_get_transaction' => [
                'class' => AvalaraGetTransaction::class,
                'type' => 'read', 'name' => 'Get Transaction',
                'description' => 'Retrieve details of a single transaction.',
                'icon' => 'ph:eye',
            ],
            'avalara_create_transaction' => [
                'class' => AvalaraCreateTransaction::class,
                'type' => 'write', 'name' => 'Create Transaction',
                'description' => 'Create a new transaction (sales order or invoice) for tax calculation.',
                'icon' => 'ph:plus',
            ],
            'avalara_list_companies' => [
                'class' => AvalaraListCompanies::class,
                'type' => 'read', 'name' => 'List Companies',
                'description' => 'List companies configured in Avalara.',
                'icon' => 'ph:buildings',
            ],
            'avalara_get_company' => [
                'class' => AvalaraGetCompany::class,
                'type' => 'read', 'name' => 'Get Company',
                'description' => 'Retrieve details of a single company.',
                'icon' => 'ph:building',
            ],
            'avalara_list_tax_codes' => [
                'class' => AvalaraListTaxCodes::class,
                'type' => 'read', 'name' => 'List Tax Codes',
                'description' => 'List tax codes available in Avalara.',
                'icon' => 'ph:tag',
            ],
            'avalara_get_current_user' => [
                'class' => AvalaraGetCurrentUser::class,
                'type' => 'read', 'name' => 'Get Current User',
                'description' => 'Retrieve the current authenticated user information.',
                'icon' => 'ph:info',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/avalara.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
        ];
    }

    public function isIntegration(): bool { return true; }

    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);
            $service = new AvalaraService(
                accessToken: $creds->get('avalara', 'access_token', '', $account),
            );
            return new $class($service);
        }

        return new $class(app(AvalaraService::class));
    }
}
