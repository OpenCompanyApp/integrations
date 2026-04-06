<?php

namespace OpenCompany\Integrations\Unbounce;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Unbounce\Tools\UnbounceListPages;
use OpenCompany\Integrations\Unbounce\Tools\UnbounceGetPage;
use OpenCompany\Integrations\Unbounce\Tools\UnbounceListLeads;
use OpenCompany\Integrations\Unbounce\Tools\UnbounceGetLead;
use OpenCompany\Integrations\Unbounce\Tools\UnbounceListSubAccounts;
use OpenCompany\Integrations\Unbounce\Tools\UnbounceGetCurrentUser;

class UnbounceToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'unbounce';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'pages, leads, sub accounts',
            'description' => 'Landing page platform',
            'icon' => 'ph:browser',
            'logo' => 'simple-icons:unbounce',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Unbounce',
            'description' => 'Landing page and conversion marketing platform',
            'icon' => 'ph:browser',
            'logo' => 'simple-icons:unbounce',
            'category' => 'marketing',
            'badge' => 'verified',
            'docs_url' => 'https://developer.unbounce.com/api_reference',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Unbounce API token',
                'hint' => 'Find your API token in Unbounce Account Settings under "API Access"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.unbounce.com',
                'hint' => 'Use <code>https://api.unbounce.com</code> for the standard API',
                'default' => 'https://api.unbounce.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.unbounce.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            if ($response->successful()) {
                $data = $response->json();
                $name = trim(($data['first_name'] ?? '') . ' ' . ($data['last_name'] ?? ''));

                return [
                    'success' => true,
                    'message' => "Connected to Unbounce as {$name}.",
                ];
            }

            return [
                'success' => false,
                'error' => "Unbounce API returned HTTP {$response->status()}.",
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
            'unbounce_list_pages' => [
                'class' => UnbounceListPages::class,
                'type' => 'read',
                'name' => 'List Pages',
                'description' => 'List landing pages in Unbounce.',
                'icon' => 'ph:browser',
            ],
            'unbounce_get_page' => [
                'class' => UnbounceGetPage::class,
                'type' => 'read',
                'name' => 'Get Page',
                'description' => 'Get details of a specific landing page.',
                'icon' => 'ph:browser',
            ],
            'unbounce_list_leads' => [
                'class' => UnbounceListLeads::class,
                'type' => 'read',
                'name' => 'List Leads',
                'description' => 'List form submissions (leads) for a page.',
                'icon' => 'ph:users',
            ],
            'unbounce_get_lead' => [
                'class' => UnbounceGetLead::class,
                'type' => 'read',
                'name' => 'Get Lead',
                'description' => 'Get details of a specific lead.',
                'icon' => 'ph:user',
            ],
            'unbounce_list_sub_accounts' => [
                'class' => UnbounceListSubAccounts::class,
                'type' => 'read',
                'name' => 'List Sub Accounts',
                'description' => 'List sub-accounts in Unbounce.',
                'icon' => 'ph:folders',
            ],
            'unbounce_get_current_user' => [
                'class' => UnbounceGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Unbounce user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/unbounce.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.unbounce.com'],
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

            $service = new UnbounceService(
                accessToken: $creds->get('unbounce', 'access_token', '', $account),
                baseUrl: $creds->get('unbounce', 'url', 'https://api.unbounce.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(UnbounceService::class));
    }
}
