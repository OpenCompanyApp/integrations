<?php

namespace OpenCompany\Integrations\ServiceM8;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ServiceM8\Tools\ServiceM8ListJobs;
use OpenCompany\Integrations\ServiceM8\Tools\ServiceM8GetJob;
use OpenCompany\Integrations\ServiceM8\Tools\ServiceM8ListClients;
use OpenCompany\Integrations\ServiceM8\Tools\ServiceM8GetClient;
use OpenCompany\Integrations\ServiceM8\Tools\ServiceM8CreateJob;
use OpenCompany\Integrations\ServiceM8\Tools\ServiceM8ListActivities;
use OpenCompany\Integrations\ServiceM8\Tools\ServiceM8GetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Provides ServiceM8 tools and configuration metadata for integration hosts.
 */
class ServiceM8ToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'service-m8';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'ServiceM8',
            'description' => 'Field service management',
            'icon' => 'ph:wrench',
            'logo' => 'simple-icons:servicem8',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'ServiceM8',
            'description' => 'Job management and field service software for small businesses',
            'icon' => 'ph:wrench',
            'logo' => 'simple-icons:servicem8',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.servicem8.com/docs',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your ServiceM8 API access token',
                'hint' => 'Generate an access token from the ServiceM8 developer portal or OAuth flow',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.servicem8.com/api_1.0',
                'hint' => 'Use <code>https://api.servicem8.com/api_1.0</code> for the standard API, or override for testing',
                'default' => 'https://api.servicem8.com/api_1.0',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.servicem8.com/api_1.0', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/staff.json');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach ServiceM8 API at {$baseUrl}. Check the URL.",
                ];
            }

            $staff = is_array($json) && array_is_list($json) ? ($json[0] ?? []) : $json;
            $userName = ($staff['first'] ?? $staff['first_name'] ?? '') . ' ' . ($staff['last'] ?? $staff['last_name'] ?? '');
            $userName = trim($userName) ?: 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to ServiceM8 API as {$userName}.",
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
            'servicem8_list_jobs' => [
                'class' => ServiceM8ListJobs::class,
                'type' => 'read',
                'name' => 'List Jobs',
                'description' => 'List jobs from ServiceM8.',
                'icon' => 'ph:briefcase',
            ],
            'servicem8_get_job' => [
                'class' => ServiceM8GetJob::class,
                'type' => 'read',
                'name' => 'Get Job',
                'description' => 'Get details of a specific ServiceM8 job.',
                'icon' => 'ph:briefcase',
            ],
            'servicem8_list_clients' => [
                'class' => ServiceM8ListClients::class,
                'type' => 'read',
                'name' => 'List Clients',
                'description' => 'List clients from ServiceM8.',
                'icon' => 'ph:users',
            ],
            'servicem8_get_client' => [
                'class' => ServiceM8GetClient::class,
                'type' => 'read',
                'name' => 'Get Client',
                'description' => 'Get details of a specific ServiceM8 client.',
                'icon' => 'ph:user',
            ],
            'servicem8_create_job' => [
                'class' => ServiceM8CreateJob::class,
                'type' => 'write',
                'name' => 'Create Job',
                'description' => 'Create a new job in ServiceM8.',
                'icon' => 'ph:plus-circle',
            ],
            'servicem8_list_activities' => [
                'class' => ServiceM8ListActivities::class,
                'type' => 'read',
                'name' => 'List Activities',
                'description' => 'List activities from ServiceM8.',
                'icon' => 'ph:clock-counter-clockwise',
            ],
            'servicem8_get_current_user' => [
                'class' => ServiceM8GetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'List staff members visible to the authenticated ServiceM8 token.',
                'icon' => 'ph:identification-card',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/servicem8.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.servicem8.com/api_1.0'],
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

            $service = new ServiceM8Service(
                accessToken: $creds->get('service-m8', 'access_token', '', $account) ?: $creds->get('service_m8', 'access_token', '', $account),
                baseUrl: $creds->get('service-m8', 'url', '', $account) ?: $creds->get('service_m8', 'url', 'https://api.servicem8.com/api_1.0', $account),
            );

            return new $class($service);
        }

        return new $class(app(ServiceM8Service::class));
    }
}
