<?php

namespace OpenCompany\Integrations\PowerBi;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\PowerBi\Tools\PowerBiGetDataset;
use OpenCompany\Integrations\PowerBi\Tools\PowerBiGetReport;
use OpenCompany\Integrations\PowerBi\Tools\PowerBiGetWorkspace;
use OpenCompany\Integrations\PowerBi\Tools\PowerBiListDatasets;
use OpenCompany\Integrations\PowerBi\Tools\PowerBiListReports;
use OpenCompany\Integrations\PowerBi\Tools\PowerBiListWorkspaces;

/**
 * Tool catalog and configuration surface for Microsoft Power BI.
 *
 * Exposes workspace, dataset, and report read operations backed by the Power BI
 * REST API and supports host-managed multi-account credentials.
 */
class PowerBiToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'powerbi';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Microsoft Power BI',
            'description' => 'Business intelligence & analytics',
            'icon' => 'ph:chart-bar',
            'logo' => 'simple-icons:powerbi',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Microsoft Power BI',
            'description' => 'Business analytics service by Microsoft for interactive visualizations and BI reports',
            'icon' => 'ph:chart-bar',
            'logo' => 'simple-icons:powerbi',
            'category' => 'analytics',
            'badge' => 'verified',
            'docs_url' => 'https://learn.microsoft.com/en-us/rest/api/power-bi/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Power BI access token',
                'hint' => 'Provide a valid Azure AD access token for the Power BI REST API. Tokens can be obtained via OAuth2 client credentials or delegated flow.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.powerbi.com',
                'hint' => 'The Power BI REST API base URL. Use <code>https://api.powerbi.com</code> for global, or a regional endpoint if applicable.',
                'default' => 'https://api.powerbi.com',
            ],
        ];
    }

    /**
     * Verify credentials with a lightweight Power BI workspace-list request.
     *
     * @param  array<string, mixed>  $config  Integration configuration values.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = $this->normalizeBaseUrl((string) ($config['url'] ?? 'https://api.powerbi.com'));

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v1.0/myorg/groups', [
                '$top' => 1,
            ]);

            if (!$response->successful()) {
                $error = $response->json('error.message') ?? $response->body();

                return [
                    'success' => false,
                    'error' => 'Power BI API returned an error: ' . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            $workspaceCount = count((array) ($response->json('value') ?? []));

            return [
                'success' => true,
                'message' => "Connected to Power BI API. Workspace probe returned {$workspaceCount} item(s).",
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
            'powerbi_list_workspaces' => [
                'class' => PowerBiListWorkspaces::class,
                'type' => 'read',
                'name' => 'List Workspaces',
                'description' => 'List Power BI workspaces (groups) the user has access to.',
                'icon' => 'ph:folders',
            ],
            'powerbi_get_workspace' => [
                'class' => PowerBiGetWorkspace::class,
                'type' => 'read',
                'name' => 'Get Workspace',
                'description' => 'Get details for a specific Power BI workspace.',
                'icon' => 'ph:folder',
            ],
            'powerbi_list_datasets' => [
                'class' => PowerBiListDatasets::class,
                'type' => 'read',
                'name' => 'List Datasets',
                'description' => 'List datasets within a Power BI workspace.',
                'icon' => 'ph:database',
            ],
            'powerbi_get_dataset' => [
                'class' => PowerBiGetDataset::class,
                'type' => 'read',
                'name' => 'Get Dataset',
                'description' => 'Get details for a specific Power BI dataset.',
                'icon' => 'ph:database',
            ],
            'powerbi_list_reports' => [
                'class' => PowerBiListReports::class,
                'type' => 'read',
                'name' => 'List Reports',
                'description' => 'List reports within a Power BI workspace.',
                'icon' => 'ph:file-text',
            ],
            'powerbi_get_report' => [
                'class' => PowerBiGetReport::class,
                'type' => 'read',
                'name' => 'Get Report',
                'description' => 'Get details for a specific Power BI report.',
                'icon' => 'ph:file-text',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/powerbi.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.powerbi.com'],
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
            $accessToken = $creds->get('powerbi', 'access_token', '', $account)
                ?: $creds->get('microsoft_powerbi', 'access_token', '', $account);
            $baseUrl = $creds->get('powerbi', 'url', '', $account)
                ?: $creds->get('microsoft_powerbi', 'url', 'https://api.powerbi.com', $account);

            $service = new PowerBiService(
                accessToken: $accessToken,
                baseUrl: $baseUrl,
            );

            return new $class($service);
        }

        return new $class(app(PowerBiService::class));
    }

    /**
     * Normalize legacy full API URLs to the root host expected by request paths.
     */
    private function normalizeBaseUrl(string $baseUrl): string
    {
        $baseUrl = rtrim($baseUrl, '/');

        return preg_replace('#/v1\.0/myorg$#', '', $baseUrl) ?: $baseUrl;
    }
}
