<?php

namespace OpenCompany\Integrations\Tableau;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Tableau\Tools\TableauGetCurrentUser;
use OpenCompany\Integrations\Tableau\Tools\TableauGetWorkbook;
use OpenCompany\Integrations\Tableau\Tools\TableauGetView;
use OpenCompany\Integrations\Tableau\Tools\TableauListProjects;
use OpenCompany\Integrations\Tableau\Tools\TableauListViews;
use OpenCompany\Integrations\Tableau\Tools\TableauListWorkbooks;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class TableauToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'tableau';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Tableau',
            'description' => 'Business intelligence & dashboards',
            'icon' => 'ph:chart-bar',
            'logo' => 'simple-icons:tableau',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Tableau',
            'description' => 'Business intelligence and analytics platform — explore workbooks, views, and projects.',
            'icon' => 'ph:chart-bar',
            'logo' => 'simple-icons:tableau',
            'category' => 'analytics',
            'badge' => 'verified',
            'docs_url' => 'https://help.tableau.com/current/api/rest_api/en-us/REST/rest_api.htm',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Tableau personal access token',
                'hint' => 'Generate a personal access token in Tableau Server under <strong>My Account Settings → Personal Access Tokens</strong>, or use a signed-in token from the REST API.',
                'required' => true,
            ],
            [
                'key' => 'site_id',
                'type' => 'text',
                'label' => 'Site ID',
                'placeholder' => 'e.g., mysite',
                'hint' => 'The Tableau site content URL (the part after <code>/site/</code> in your Tableau URL). Use <code>Default</code> for the default site.',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'Server URL',
                'placeholder' => 'https://your-tableau-server.com/api/3.23',
                'hint' => 'The Tableau REST API base URL including the API version. Default: <code>https://your-tableau-server.com/api/3.23</code>',
                'default' => 'https://your-tableau-server.com/api/3.23',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://your-tableau-server.com/api/3.23', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'X-Tableau-Auth' => $accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Tableau API at {$baseUrl}. Check the URL and network access.",
                ];
            }

            if (!$response->successful()) {
                $error = $response->json('error.message') ?? $response->body();
                return [
                    'success' => false,
                    'error' => is_string($error) ? $error : json_encode($error),
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Tableau API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'site_id' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'tableau_list_workbooks' => [
                'class' => TableauListWorkbooks::class,
                'type' => 'read',
                'name' => 'List Workbooks',
                'description' => 'List workbooks on the Tableau site.',
                'icon' => 'ph:book-open',
            ],
            'tableau_get_workbook' => [
                'class' => TableauGetWorkbook::class,
                'type' => 'read',
                'name' => 'Get Workbook',
                'description' => 'Get details for a specific workbook.',
                'icon' => 'ph:book-open',
            ],
            'tableau_list_views' => [
                'class' => TableauListViews::class,
                'type' => 'read',
                'name' => 'List Views',
                'description' => 'List views on the Tableau site.',
                'icon' => 'ph:eye',
            ],
            'tableau_get_view' => [
                'class' => TableauGetView::class,
                'type' => 'read',
                'name' => 'Get View',
                'description' => 'Get details for a specific view.',
                'icon' => 'ph:eye',
            ],
            'tableau_list_projects' => [
                'class' => TableauListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List projects on the Tableau site.',
                'icon' => 'ph:folder',
            ],
            'tableau_get_current_user' => [
                'class' => TableauGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user\'s information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/tableau.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'site_id', 'type' => 'string', 'label' => 'Site ID', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'Server URL', 'required' => false, 'default' => 'https://your-tableau-server.com/api/3.23'],
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

            $service = new TableauService(
                accessToken: $creds->get('tableau', 'access_token', '', $account),
                siteId: $creds->get('tableau', 'site_id', '', $account),
                baseUrl: $creds->get('tableau', 'base_url', 'https://your-tableau-server.com/api/3.23', $account),
            );

            return new $class($service);
        }

        return new $class(app(TableauService::class));
    }
}
