<?php

namespace OpenCompany\Integrations\NewRelic;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\NewRelic\Tools\NewRelicListApplications;
use OpenCompany\Integrations\NewRelic\Tools\NewRelicGetApplication;
use OpenCompany\Integrations\NewRelic\Tools\NewRelicListDeployments;
use OpenCompany\Integrations\NewRelic\Tools\NewRelicCreateDeployment;
use OpenCompany\Integrations\NewRelic\Tools\NewRelicListAlertPolicies;
use OpenCompany\Integrations\NewRelic\Tools\NewRelicListDashboards;
use OpenCompany\Integrations\NewRelic\Tools\NewRelicGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class NewRelicToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'api_key',
            'legacy_auth_type' => 'api_key',
            'credential_mode' => 'secret',
            'setup_flows' =>
            [
              0 => 'manual_secret',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
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
              'setup_mode' => 'manual_secret',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
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
        return 'newrelic';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'New Relic',
            'description' => 'Application performance monitoring',
            'icon' => 'ph:chart-line-up',
            'logo' => 'simple-icons:newrelic',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'New Relic',
            'description' => 'Application performance monitoring and observability platform',
            'icon' => 'ph:chart-line-up',
            'logo' => 'simple-icons:newrelic',
            'category' => 'analytics',
            'badge' => 'verified',
            'docs_url' => 'https://docs.newrelic.com/docs/apis/nerdgraph/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your New Relic API key',
                'hint' => 'Find your API key in New Relic under <strong>User menu → API keys</strong>',
                'required' => true,
            ],
            [
                'key' => 'account_id',
                'type' => 'string',
                'label' => 'Account ID',
                'placeholder' => 'Enter your New Relic account ID',
                'hint' => 'Found in New Relic under <strong>Account settings → Account</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'NerdGraph Endpoint',
                'placeholder' => 'https://api.newrelic.com/graphql',
                'hint' => 'Defaults to <code>https://api.newrelic.com/graphql</code>. Change for EU accounts or custom endpoints.',
                'default' => 'https://api.newrelic.com/graphql',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.newrelic.com/graphql', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->post($baseUrl, [
                'query' => '{ actor { user { email name } } }',
            ]);

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach New Relic API at {$baseUrl}. Check the URL.",
                ];
            }

            if (isset($json['errors'])) {
                $messages = array_map(fn ($e) => $e['message'] ?? 'Unknown error', $json['errors']);
                return [
                    'success' => false,
                    'error' => 'New Relic API error: ' . implode('; ', $messages),
                ];
            }

            $user = $json['data']['actor']['user'] ?? [];
            $name = $user['name'] ?? 'Unknown';
            $email = $user['email'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to New Relic as {$name} ({$email}).",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'account_id' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'newrelic_list_applications' => [
                'class' => NewRelicListApplications::class,
                'type' => 'read',
                'name' => 'List Applications',
                'description' => 'List APM applications in the New Relic account.',
                'icon' => 'ph:app-window',
            ],
            'newrelic_get_application' => [
                'class' => NewRelicGetApplication::class,
                'type' => 'read',
                'name' => 'Get Application',
                'description' => 'Get details of a specific APM application.',
                'icon' => 'ph:app-window',
            ],
            'newrelic_list_deployments' => [
                'class' => NewRelicListDeployments::class,
                'type' => 'read',
                'name' => 'List Deployments',
                'description' => 'List deployment markers for an application.',
                'icon' => 'ph:rocket',
            ],
            'newrelic_create_deployment' => [
                'class' => NewRelicCreateDeployment::class,
                'type' => 'write',
                'name' => 'Create Deployment',
                'description' => 'Record a new deployment marker in New Relic.',
                'icon' => 'ph:rocket-launch',
            ],
            'newrelic_list_alert_policies' => [
                'class' => NewRelicListAlertPolicies::class,
                'type' => 'read',
                'name' => 'List Alert Policies',
                'description' => 'List alert policies in the New Relic account.',
                'icon' => 'ph:bell',
            ],
            'newrelic_list_dashboards' => [
                'class' => NewRelicListDashboards::class,
                'type' => 'read',
                'name' => 'List Dashboards',
                'description' => 'List dashboards in the New Relic account.',
                'icon' => 'ph:chart-bar',
            ],
            'newrelic_get_current_user' => [
                'class' => NewRelicGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated New Relic user profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/newrelic.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'account_id', 'type' => 'string', 'label' => 'Account ID', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'NerdGraph Endpoint', 'required' => false, 'default' => 'https://api.newrelic.com/graphql'],
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

            $service = new NewRelicService(
                apiKey: $creds->get('newrelic', 'api_key', '', $account),
                accountId: $creds->get('newrelic', 'account_id', '', $account),
                baseUrl: $creds->get('newrelic', 'url', 'https://api.newrelic.com/graphql', $account),
            );

            return new $class($service);
        }

        return new $class(app(NewRelicService::class));
    }
}
