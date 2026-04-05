<?php

namespace OpenCompany\Integrations\Copper;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Copper\Tools\CopperListContacts;
use OpenCompany\Integrations\Copper\Tools\CopperGetContact;
use OpenCompany\Integrations\Copper\Tools\CopperCreateContact;
use OpenCompany\Integrations\Copper\Tools\CopperUpdateContact;
use OpenCompany\Integrations\Copper\Tools\CopperDeleteContact;
use OpenCompany\Integrations\Copper\Tools\CopperListCompanies;
use OpenCompany\Integrations\Copper\Tools\CopperGetCompany;
use OpenCompany\Integrations\Copper\Tools\CopperCreateCompany;
use OpenCompany\Integrations\Copper\Tools\CopperListOpportunities;
use OpenCompany\Integrations\Copper\Tools\CopperGetOpportunity;
use OpenCompany\Integrations\Copper\Tools\CopperCreateOpportunity;
use OpenCompany\Integrations\Copper\Tools\CopperListPipelines;
use OpenCompany\Integrations\Copper\Tools\CopperGetCurrentUser;

class CopperToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'copper';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'contacts, companies, opportunities',
            'description' => 'CRM',
            'icon' => 'ph:users',
            'logo' => 'simple-icons:copper',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Copper CRM',
            'description' => 'CRM for Google Workspace — manage contacts, companies, and opportunities',
            'icon' => 'ph:users',
            'logo' => 'simple-icons:copper',
            'category' => 'crm',
            'badge' => 'verified',
            'docs_url' => 'https://developer.copper.com/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Copper API key',
                'hint' => 'Generate an API key in Copper Settings > Integrations > API Keys',
                'required' => true,
            ],
            [
                'key' => 'email',
                'type' => 'email',
                'label' => 'Account Email',
                'placeholder' => 'you@company.com',
                'hint' => 'The email address associated with your Copper account',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $email = $config['email'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.copper.com/developer_api/v1', '/');

        if (empty($apiKey) || empty($email)) {
            return ['success' => false, 'error' => 'API key and email are required'];
        }

        try {
            $response = Http::withHeaders([
                'X-PW-AccessToken' => $apiKey,
                'X-PW-Application' => 'developer_api',
                'X-PW-UserEmail' => $email,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users');

            if ($response->successful()) {
                $user = $response->json();
                $name = ($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? '');
                $name = trim($name) ?: $email;

                return [
                    'success' => true,
                    'message' => "Connected to Copper as {$name}.",
                ];
            }

            return [
                'success' => false,
                'error' => "Copper API returned HTTP {$response->status()}. Check your credentials.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'email' => 'nullable|email',
        ];
    }

    public function tools(): array
    {
        return [
            'copper_list_contacts' => [
                'class' => CopperListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'Search and list contacts in Copper CRM.',
                'icon' => 'ph:address-book',
            ],
            'copper_get_contact' => [
                'class' => CopperGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Get details of a specific contact.',
                'icon' => 'ph:address-book',
            ],
            'copper_create_contact' => [
                'class' => CopperCreateContact::class,
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Create a new contact in Copper CRM.',
                'icon' => 'ph:user-plus',
            ],
            'copper_update_contact' => [
                'class' => CopperUpdateContact::class,
                'type' => 'write',
                'name' => 'Update Contact',
                'description' => 'Update an existing contact in Copper CRM.',
                'icon' => 'ph:pencil-simple',
            ],
            'copper_delete_contact' => [
                'class' => CopperDeleteContact::class,
                'type' => 'write',
                'name' => 'Delete Contact',
                'description' => 'Delete a contact from Copper CRM.',
                'icon' => 'ph:trash',
            ],
            'copper_list_companies' => [
                'class' => CopperListCompanies::class,
                'type' => 'read',
                'name' => 'List Companies',
                'description' => 'Search and list companies in Copper CRM.',
                'icon' => 'ph:buildings',
            ],
            'copper_get_company' => [
                'class' => CopperGetCompany::class,
                'type' => 'read',
                'name' => 'Get Company',
                'description' => 'Get details of a specific company.',
                'icon' => 'ph:buildings',
            ],
            'copper_create_company' => [
                'class' => CopperCreateCompany::class,
                'type' => 'write',
                'name' => 'Create Company',
                'description' => 'Create a new company in Copper CRM.',
                'icon' => 'ph:building-office',
            ],
            'copper_list_opportunities' => [
                'class' => CopperListOpportunities::class,
                'type' => 'read',
                'name' => 'List Opportunities',
                'description' => 'Search and list opportunities in Copper CRM.',
                'icon' => 'ph:currency-dollar',
            ],
            'copper_get_opportunity' => [
                'class' => CopperGetOpportunity::class,
                'type' => 'read',
                'name' => 'Get Opportunity',
                'description' => 'Get details of a specific opportunity.',
                'icon' => 'ph:currency-dollar',
            ],
            'copper_create_opportunity' => [
                'class' => CopperCreateOpportunity::class,
                'type' => 'write',
                'name' => 'Create Opportunity',
                'description' => 'Create a new opportunity in Copper CRM.',
                'icon' => 'ph:plus-circle',
            ],
            'copper_list_pipelines' => [
                'class' => CopperListPipelines::class,
                'type' => 'read',
                'name' => 'List Pipelines',
                'description' => 'List all sales pipelines.',
                'icon' => 'ph:pipeline',
            ],
            'copper_get_current_user' => [
                'class' => CopperGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Copper user.',
                'icon' => 'ph:identification-badge',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/copper.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'email', 'type' => 'email', 'label' => 'Account Email', 'required' => true],
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

            $service = new CopperService(
                apiKey: $creds->get('copper', 'api_key', '', $account),
                email: $creds->get('copper', 'email', '', $account),
                baseUrl: $creds->get('copper', 'url', 'https://api.copper.com/developer_api/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(CopperService::class));
    }
}
