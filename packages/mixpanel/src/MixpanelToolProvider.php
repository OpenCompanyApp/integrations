<?php

namespace OpenCompany\Integrations\Mixpanel;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Mixpanel\Tools\MixpanelListEvents;
use OpenCompany\Integrations\Mixpanel\Tools\MixpanelGetEvent;
use OpenCompany\Integrations\Mixpanel\Tools\MixpanelListFunnels;
use OpenCompany\Integrations\Mixpanel\Tools\MixpanelGetFunnel;
use OpenCompany\Integrations\Mixpanel\Tools\MixpanelListCohorts;
use OpenCompany\Integrations\Mixpanel\Tools\MixpanelGetCohort;
use OpenCompany\Integrations\Mixpanel\Tools\MixpanelGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\Integrations\Mixpanel\Tools\MixpanelFunnel;
use OpenCompany\Integrations\Mixpanel\Tools\MixpanelGetExport;
use OpenCompany\Integrations\Mixpanel\Tools\MixpanelProfile;
use OpenCompany\Integrations\Mixpanel\Tools\MixpanelQuery;
use OpenCompany\Integrations\Mixpanel\Tools\MixpanelQueryJql;
use OpenCompany\Integrations\Mixpanel\Tools\MixpanelRetention;
use OpenCompany\Integrations\Mixpanel\Tools\MixpanelTrackEvent;
/**
 * MixpanelToolProvider — registers Mixpanel analytics tools with the integration core.
 *
 * Implements ConfigurableIntegration for multi-account support, config schema
 * definition, connection testing, and credential field declaration.
 */
class MixpanelToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

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
        return 'mixpanel';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Mixpanel Analytics',
            'description' => 'Product analytics',
            'icon' => 'ph:chart-pie',
            'logo' => 'simple-icons:mixpanel',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Mixpanel Analytics',
            'description' => 'Product analytics platform for tracking user behavior, funnels, and cohorts',
            'icon' => 'ph:chart-pie',
            'logo' => 'simple-icons:mixpanel',
            'category' => 'analytics',
            'badge' => 'verified',
            'docs_url' => 'https://developer.mixpanel.com/reference/overview',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Mixpanel API key',
                'hint' => 'Find your API key in Mixpanel account settings under "Project Settings"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Instance URL',
                'placeholder' => 'https://api.mixpanel.com/v1',
                'hint' => 'Use <code>https://api.mixpanel.com/v1</code> for the standard cloud, or your custom domain',
                'default' => 'https://api.mixpanel.com/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.mixpanel.com/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Mixpanel API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $json['message'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Mixpanel API returned an error: {$error}",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Mixpanel API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url'     => 'nullable|url',
        ];
    }

        public function tools(): array
    {
        return [
            'mixpanel_funnel' => [
                'class' => MixpanelFunnel::class,
                'type' => 'read',
                'name' => 'Funnel',
                'description' => 'Get conversion funnel results for a specific funnel.',
                'icon' => 'ph:wrench',
            ],
            'mixpanel_get_cohort' => [
                'class' => MixpanelGetCohort::class,
                'type' => 'read',
                'name' => 'Get Cohort',
                'description' => 'Retrieve detailed information for a Mixpanel cohort by its ID. Returns cohort membership data and behavioral criteria.',
                'icon' => 'ph:wrench',
            ],
            'mixpanel_get_current_user' => [
                'class' => MixpanelGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Mixpanel user. Returns account details for the API key owner â useful for verifying credentials and checking permissions.',
                'icon' => 'ph:wrench',
            ],
            'mixpanel_get_event' => [
                'class' => MixpanelGetEvent::class,
                'type' => 'read',
                'name' => 'Get Event',
                'description' => 'Retrieve analytics data for a specific Mixpanel event by name. Returns event counts and breakdowns over time.',
                'icon' => 'ph:wrench',
            ],
            'mixpanel_get_export' => [
                'class' => MixpanelGetExport::class,
                'type' => 'read',
                'name' => 'Get Export',
                'description' => 'Export raw event data from Mixpanel for a date range.',
                'icon' => 'ph:wrench',
            ],
            'mixpanel_get_funnel' => [
                'class' => MixpanelGetFunnel::class,
                'type' => 'read',
                'name' => 'Get Funnel',
                'description' => 'Retrieve detailed conversion data for a Mixpanel funnel by its ID. Returns step-by-step conversion rates and drop-off analytics.',
                'icon' => 'ph:wrench',
            ],
            'mixpanel_list_cohorts' => [
                'class' => MixpanelListCohorts::class,
                'type' => 'read',
                'name' => 'List Cohorts',
                'description' => 'List all behavioral cohorts in the Mixpanel project. Returns cohort names, IDs, and sizes.',
                'icon' => 'ph:wrench',
            ],
            'mixpanel_list_events' => [
                'class' => MixpanelListEvents::class,
                'type' => 'read',
                'name' => 'List Events',
                'description' => 'List events from Mixpanel Analytics. Optionally filter by event type, time unit, or date range. Returns the most recent events matching the criteria.',
                'icon' => 'ph:wrench',
            ],
            'mixpanel_list_funnels' => [
                'class' => MixpanelListFunnels::class,
                'type' => 'read',
                'name' => 'List Funnels',
                'description' => 'List all funnels configured in the Mixpanel project. Returns funnel names, IDs, and basic configuration.',
                'icon' => 'ph:wrench',
            ],
            'mixpanel_profile' => [
                'class' => MixpanelProfile::class,
                'type' => 'read',
                'name' => 'Profile',
                'description' => 'Set or update a Mixpanel user profile with properties.',
                'icon' => 'ph:wrench',
            ],
            'mixpanel_query' => [
                'class' => MixpanelQuery::class,
                'type' => 'read',
                'name' => 'Query',
                'description' => 'Query Mixpanel event data with date range, type, and time unit.',
                'icon' => 'ph:wrench',
            ],
            'mixpanel_query_jql' => [
                'class' => MixpanelQueryJql::class,
                'type' => 'read',
                'name' => 'Query Jql',
                'description' => 'Execute a JQL (JavaScript Query Language) script against Mixpanel data.',
                'icon' => 'ph:wrench',
            ],
            'mixpanel_retention' => [
                'class' => MixpanelRetention::class,
                'type' => 'read',
                'name' => 'Retention',
                'description' => 'Get retention data for a cohort of users over time.',
                'icon' => 'ph:wrench',
            ],
            'mixpanel_track_event' => [
                'class' => MixpanelTrackEvent::class,
                'type' => 'write',
                'name' => 'Track Event',
                'description' => 'Track an event in Mixpanel with optional properties and user identity.',
                'icon' => 'ph:wrench',
            ],
        ];
    }


    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/mixpanel.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Mixpanel URL', 'required' => false, 'default' => 'https://api.mixpanel.com/v1'],
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

            $service = new MixpanelService(
                apiKey: $creds->get('mixpanel', 'api_key', '', $account),
                baseUrl: $creds->get('mixpanel', 'url', 'https://api.mixpanel.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(MixpanelService::class));
    }
}
