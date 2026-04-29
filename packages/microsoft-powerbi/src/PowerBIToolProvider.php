<?php

namespace OpenCompany\Integrations\MicrosoftPowerBI;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\MicrosoftPowerBI\Tools\PowerBIListReports;
use OpenCompany\Integrations\MicrosoftPowerBI\Tools\PowerBIGetReport;
use OpenCompany\Integrations\MicrosoftPowerBI\Tools\PowerBIListDatasets;
use OpenCompany\Integrations\MicrosoftPowerBI\Tools\PowerBIGetDataset;
use OpenCompany\Integrations\MicrosoftPowerBI\Tools\PowerBIListWorkspaces;
use OpenCompany\Integrations\MicrosoftPowerBI\Tools\PowerBIGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class PowerBIToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'microsoft_powerbi';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Microsoft Power BI',
            'description' => 'Business intelligence & analytics',
            'icon' => 'ph:chart-bar',
            'logo' => 'logos:microsoft-power-bi',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Microsoft Power BI',
            'description' => 'Business intelligence and analytics platform by Microsoft',
            'icon' => 'ph:chart-bar',
            'logo' => 'logos:microsoft-power-bi',
            'category' => 'analytics',
            'badge' => 'New',
            'docs_url' => 'https://learn.microsoft.com/en-us/rest/api/power-bi/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Power BI access token',
                'hint' => 'Use an Azure AD access token with Power BI API permissions. Generate one via the <a href="https://learn.microsoft.com/en-us/rest/api/power-bi/" target="_blank">Power BI REST API docs</a>.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.powerbi.com/v1.0/myorg',
                'hint' => 'Defaults to the global Power BI API. Change only for sovereign cloud deployments.',
                'default' => 'https://api.powerbi.com/v1.0/myorg',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.powerbi.com/v1.0/myorg', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Power BI API at {$baseUrl}. Check the URL and access token.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error']['message'] ?? $json['error'] ?? 'Unknown error';
                return ['success' => false, 'error' => "Authentication failed: {$error}"];
            }

            $displayName = $json['displayName'] ?? 'Unknown user';

            return [
                'success' => true,
                'message' => "Connected to Power BI as {$displayName}.",
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
            'powerbi_list_reports' => [
                'class' => PowerBIListReports::class,
                'type' => 'read',
                'name' => 'List Reports',
                'description' => 'List all Power BI reports the authenticated user has access to.',
                'icon' => 'ph:files',
            ],
            'powerbi_get_report' => [
                'class' => PowerBIGetReport::class,
                'type' => 'read',
                'name' => 'Get Report',
                'description' => 'Get details of a specific Power BI report by ID.',
                'icon' => 'ph:file',
            ],
            'powerbi_list_datasets' => [
                'class' => PowerBIListDatasets::class,
                'type' => 'read',
                'name' => 'List Datasets',
                'description' => 'List all Power BI datasets the authenticated user has access to.',
                'icon' => 'ph:database',
            ],
            'powerbi_get_dataset' => [
                'class' => PowerBIGetDataset::class,
                'type' => 'read',
                'name' => 'Get Dataset',
                'description' => 'Get details of a specific Power BI dataset by ID.',
                'icon' => 'ph:database',
            ],
            'powerbi_list_workspaces' => [
                'class' => PowerBIListWorkspaces::class,
                'type' => 'read',
                'name' => 'List Workspaces',
                'description' => 'List all Power BI workspaces (groups) the authenticated user has access to.',
                'icon' => 'ph:folders',
            ],
            'powerbi_get_current_user' => [
                'class' => PowerBIGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the profile of the currently authenticated Power BI user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/microsoft-powerbi.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.powerbi.com/v1.0/myorg'],
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

            $service = new PowerBIService(
                accessToken: $creds->get('microsoft_powerbi', 'access_token', '', $account),
                baseUrl: $creds->get('microsoft_powerbi', 'url', 'https://api.powerbi.com/v1.0/myorg', $account),
            );

            return new $class($service);
        }

        return new $class(app(PowerBIService::class));
    }
}
