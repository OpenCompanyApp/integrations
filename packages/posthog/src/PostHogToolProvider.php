<?php

namespace OpenCompany\Integrations\PostHog;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\PostHog\Tools\PostHogCaptureEvent;
use OpenCompany\Integrations\PostHog\Tools\PostHogListEvents;
use OpenCompany\Integrations\PostHog\Tools\PostHogGetEvent;
use OpenCompany\Integrations\PostHog\Tools\PostHogListPersons;
use OpenCompany\Integrations\PostHog\Tools\PostHogGetPerson;
use OpenCompany\Integrations\PostHog\Tools\PostHogListFeatureFlags;
use OpenCompany\Integrations\PostHog\Tools\PostHogGetFeatureFlag;
use OpenCompany\Integrations\PostHog\Tools\PostHogCreateFeatureFlag;
use OpenCompany\Integrations\PostHog\Tools\PostHogUpdateFeatureFlag;
use OpenCompany\Integrations\PostHog\Tools\PostHogDeleteFeatureFlag;
use OpenCompany\Integrations\PostHog\Tools\PostHogListInsights;
use OpenCompany\Integrations\PostHog\Tools\PostHogGetInsight;
use OpenCompany\Integrations\PostHog\Tools\PostHogListDashboards;
use OpenCompany\Integrations\PostHog\Tools\PostHogGetDashboard;
use OpenCompany\Integrations\PostHog\Tools\PostHogListCohorts;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class PostHogToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'api_token',
            'legacy_auth_type' => 'api_token',
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




/**
     * Get the application name identifier.
     *
     * @return string The app name used internally.
     */
    public function appName(): string
    {
        return 'posthog';
    }

/**
     * Get metadata for tool display and categorization.
     *
     * @return array<string, mixed> App-level metadata with label, description, and icons.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'events, feature flags, insights, dashboards',
            'description' => 'Product analytics & feature management',
            'icon' => 'ph:chart-bar',
            'logo' => 'simple-icons:posthog',
        ];
    }

/**
     * Get integration-level metadata for marketplace display.
     *
     * @return array<string, mixed> Integration metadata including name, category, and docs URL.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'PostHog',
            'description' => 'Product analytics, session replay, feature flags, and A/B testing',
            'icon' => 'ph:chart-bar',
            'logo' => 'simple-icons:posthog',
            'category' => 'analytics',
            'badge' => 'verified',
            'docs_url' => 'https://posthog.com/docs/api',
        ];
    }/**
     * Get the configuration schema for the PostHog integration.
     *
     * @return array<int, array<string, mixed>> The config field definitions.
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your PostHog Personal Access Token',
                'hint' => 'Generate a Personal Access Token in PostHog under Settings → User → Personal API Keys, or use your Project API Key.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'PostHog URL',
                'placeholder' => 'https://us.posthog.com',
                'hint' => 'Use <code>https://us.posthog.com</code> (US region), <code>https://eu.posthog.com</code> (EU region), or your self-hosted URL.',
                'default' => 'https://us.posthog.com',
            ],
        ];
    }

    /**
     * Test the connection to the PostHog API.
     *
     * @param  array<string, mixed>  $config  The configuration containing api_token and url.
     * @return array{success: bool, message?: string, email?: string, error?: string} The test result.
     */
    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://us.posthog.com', '/');

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/api/users/@me');

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => "PostHog API returned HTTP {$response->status()}.",
                ];
            }

            $data = $response->json();
            $email = $data['email'] ?? ($data['first_name'] ?? 'Unknown user');

            return [
                'success' => true,
                'message' => "Connected to PostHog as {$email}.",
                'email' => $email,
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get the validation rules for the PostHog configuration fields.
     *
     * @return array<string, string|array<int, string>> Laravel validation rules.
     */
    public function validationRules(): array
    {
        return [
            'api_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get the list of all PostHog tools and their metadata.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}> Tool definitions keyed by tool name.
     */
    public function tools(): array
    {
        return [
            'posthog_capture_event' => [
                'class' => PostHogCaptureEvent::class,
                'type' => 'write',
                'name' => 'Capture Event',
                'description' => 'Send (capture) a custom event to PostHog.',
                'icon' => 'ph:lightning',
            ],
            'posthog_list_events' => [
                'class' => PostHogListEvents::class,
                'type' => 'read',
                'name' => 'List Events',
                'description' => 'List events with optional filtering and pagination.',
                'icon' => 'ph:list',
            ],
            'posthog_get_event' => [
                'class' => PostHogGetEvent::class,
                'type' => 'read',
                'name' => 'Get Event',
                'description' => 'Get details of a specific event by ID.',
                'icon' => 'ph:eye',
            ],
            'posthog_list_persons' => [
                'class' => PostHogListPersons::class,
                'type' => 'read',
                'name' => 'List Persons',
                'description' => 'List persons (users) with optional search.',
                'icon' => 'ph:users',
            ],
            'posthog_get_person' => [
                'class' => PostHogGetPerson::class,
                'type' => 'read',
                'name' => 'Get Person',
                'description' => 'Get details of a specific person by ID.',
                'icon' => 'ph:user',
            ],
            'posthog_list_feature_flags' => [
                'class' => PostHogListFeatureFlags::class,
                'type' => 'read',
                'name' => 'List Feature Flags',
                'description' => 'List all feature flags in the project.',
                'icon' => 'ph:flag',
            ],
            'posthog_get_feature_flag' => [
                'class' => PostHogGetFeatureFlag::class,
                'type' => 'read',
                'name' => 'Get Feature Flag',
                'description' => 'Get details of a specific feature flag.',
                'icon' => 'ph:flag',
            ],
            'posthog_create_feature_flag' => [
                'class' => PostHogCreateFeatureFlag::class,
                'type' => 'write',
                'name' => 'Create Feature Flag',
                'description' => 'Create a new feature flag.',
                'icon' => 'ph:plus',
            ],
            'posthog_update_feature_flag' => [
                'class' => PostHogUpdateFeatureFlag::class,
                'type' => 'write',
                'name' => 'Update Feature Flag',
                'description' => 'Update an existing feature flag.',
                'icon' => 'ph:pencil',
            ],
            'posthog_delete_feature_flag' => [
                'class' => PostHogDeleteFeatureFlag::class,
                'type' => 'write',
                'name' => 'Delete Feature Flag',
                'description' => 'Delete a feature flag.',
                'icon' => 'ph:trash',
            ],
            'posthog_list_insights' => [
                'class' => PostHogListInsights::class,
                'type' => 'read',
                'name' => 'List Insights',
                'description' => 'List saved insights in the project.',
                'icon' => 'ph:chart-line-up',
            ],
            'posthog_get_insight' => [
                'class' => PostHogGetInsight::class,
                'type' => 'read',
                'name' => 'Get Insight',
                'description' => 'Get details of a specific insight by ID.',
                'icon' => 'ph:chart-line-up',
            ],
            'posthog_list_dashboards' => [
                'class' => PostHogListDashboards::class,
                'type' => 'read',
                'name' => 'List Dashboards',
                'description' => 'List dashboards in the project.',
                'icon' => 'ph:squares-four',
            ],
            'posthog_get_dashboard' => [
                'class' => PostHogGetDashboard::class,
                'type' => 'read',
                'name' => 'Get Dashboard',
                'description' => 'Get details of a specific dashboard by ID.',
                'icon' => 'ph:squares-four',
            ],
            'posthog_list_cohorts' => [
                'class' => PostHogListCohorts::class,
                'type' => 'read',
                'name' => 'List Cohorts',
                'description' => 'List cohorts in the project.',
                'icon' => 'ph:users-three',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file for this integration.
     *
     * @return string|null The absolute path to the docs file, or null if not available.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/posthog.md';
    }

    /**
     * Get the credential field definitions for the PostHog integration.
     *
     * @return array<int, array<string, mixed>> Credential field definitions.
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'PostHog URL', 'required' => false, 'default' => 'https://us.posthog.com'],
        ];
    }

    /**
     * Confirm this is an integration provider.
     *
     * @return bool Always true.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally scoped to a specific account.
     *
     * @param  class-string<Tool>  $class   The tool class to instantiate.
     * @param  array<string, mixed>  $context  Optional context with 'account' for multi-tenant resolution.
     * @return Tool The instantiated tool with the appropriate service.
     */
    public function createTool(string $class, array $context = []): Tool
    {        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new PostHogService(
                apiToken: $creds->get('posthog', 'api_token', '', $account),
                baseUrl: $creds->get('posthog', 'url', 'https://us.posthog.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(PostHogService::class));
    }
}
