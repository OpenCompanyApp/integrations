<?php

namespace OpenCompany\Integrations\Mixpanel;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Mixpanel\Tools\MixpanelTrackEvent;
use OpenCompany\Integrations\Mixpanel\Tools\MixpanelQuery;
use OpenCompany\Integrations\Mixpanel\Tools\MixpanelFunnel;
use OpenCompany\Integrations\Mixpanel\Tools\MixpanelRetention;
use OpenCompany\Integrations\Mixpanel\Tools\MixpanelProfile;
use OpenCompany\Integrations\Mixpanel\Tools\MixpanelListFunnels;
use OpenCompany\Integrations\Mixpanel\Tools\MixpanelGetExport;
use OpenCompany\Integrations\Mixpanel\Tools\MixpanelListCohorts;
use OpenCompany\Integrations\Mixpanel\Tools\MixpanelQueryJql;
use OpenCompany\Integrations\Mixpanel\Tools\MixpanelGetCurrentUser;

/**
 * Registers all Mixpanel tools and provides integration metadata.
 *
 * Exposes 10 tools covering event tracking, queries, funnels,
 * retention, profiles, exports, cohorts, and JQL via the ToolProvider contract.
 */
class MixpanelToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'mixpanel';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'events, funnels, retention, cohorts',
            'description' => 'Product Analytics',
            'icon' => 'ph:chart-line',
            'logo' => 'simple-icons:mixpanel',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Mixpanel',
            'description' => 'Event tracking, analytics queries, funnels, retention, profiles, and cohorts',
            'icon' => 'ph:chart-line',
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
                'key' => 'username',
                'type' => 'text',
                'label' => 'Service Account Username',
                'placeholder' => 'service-account-...',
                'hint' => 'Mixpanel service-account username (found in Organization Settings → Service Accounts).',
                'required' => true,
            ],
            [
                'key' => 'secret',
                'type' => 'secret',
                'label' => 'Service Account Secret',
                'placeholder' => '...',
                'hint' => 'Mixpanel service-account secret (or API secret for older accounts).',
                'required' => true,
            ],
            [
                'key' => 'project_id',
                'type' => 'text',
                'label' => 'Project ID',
                'placeholder' => '1234567',
                'hint' => 'Mixpanel project ID (found in Project Settings).',
                'required' => false,
            ],
        ];
    }

    /**
     * Test the Mixpanel connection using the provided credentials.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'username' and 'secret'
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $username = $config['username'] ?? '';
        $secret = $config['secret'] ?? '';

        if (empty($username) || empty($secret)) {
            return ['success' => false, 'error' => 'Service-account username and secret are required.'];
        }

        try {
            $response = Http::withBasicAuth($username, $secret)
                ->timeout(10)
                ->get('https://mixpanel.com/api/2.0/query', [
                    'from_date' => date('Y-m-d', strtotime('-1 day')),
                    'to_date'   => date('Y-m-d'),
                    'event'     => '[]',
                ]);

            if ($response->failed()) {
                $body = $response->json() ?? [];
                $error = is_string($body) ? $body : ($body['error'] ?? $response->body());

                return [
                    'success' => false,
                    'error' => 'Mixpanel API error: ' . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            return [
                'success' => true,
                'message' => 'Connected to Mixpanel API successfully.',
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return [
            'username'   => 'nullable|string',
            'secret'     => 'nullable|string',
            'project_id' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'mixpanel_track_event' => [
                'class' => MixpanelTrackEvent::class,
                'type' => 'write',
                'name' => 'Track Event',
                'description' => 'Track an event in Mixpanel with optional properties and user identity.',
                'icon' => 'ph:rocket',
            ],
            'mixpanel_query' => [
                'class' => MixpanelQuery::class,
                'type' => 'read',
                'name' => 'Query Events',
                'description' => 'Query Mixpanel event data with date range, type, and time unit.',
                'icon' => 'ph:magnifying-glass',
            ],
            'mixpanel_funnel' => [
                'class' => MixpanelFunnel::class,
                'type' => 'read',
                'name' => 'Get Funnel',
                'description' => 'Get conversion funnel results for a specific funnel.',
                'icon' => 'ph:funnel',
            ],
            'mixpanel_retention' => [
                'class' => MixpanelRetention::class,
                'type' => 'read',
                'name' => 'Get Retention',
                'description' => 'Get retention data for a cohort of users over time.',
                'icon' => 'ph:clock-clockwise',
            ],
            'mixpanel_profile' => [
                'class' => MixpanelProfile::class,
                'type' => 'write',
                'name' => 'Update Profile',
                'description' => 'Set or update a Mixpanel user profile with properties.',
                'icon' => 'ph:user-circle',
            ],
            'mixpanel_list_funnels' => [
                'class' => MixpanelListFunnels::class,
                'type' => 'read',
                'name' => 'List Funnels',
                'description' => 'List all funnels in the Mixpanel project.',
                'icon' => 'ph:list-funnels',
            ],
            'mixpanel_get_export' => [
                'class' => MixpanelGetExport::class,
                'type' => 'read',
                'name' => 'Export Data',
                'description' => 'Export raw event data from Mixpanel for a date range.',
                'icon' => 'ph:download',
            ],
            'mixpanel_list_cohorts' => [
                'class' => MixpanelListCohorts::class,
                'type' => 'read',
                'name' => 'List Cohorts',
                'description' => 'List all behavioural cohorts in the Mixpanel project.',
                'icon' => 'ph:users-three',
            ],
            'mixpanel_query_jql' => [
                'class' => MixpanelQueryJql::class,
                'type' => 'read',
                'name' => 'Query JQL',
                'description' => 'Execute a JQL (JavaScript Query Language) script against Mixpanel data.',
                'icon' => 'ph:code',
            ],
            'mixpanel_get_current_user' => [
                'class' => MixpanelGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Verify the authenticated user and retrieve basic project info.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/mixpanel.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'username', 'type' => 'text', 'label' => 'Service Account Username', 'required' => true],
            ['key' => 'secret', 'type' => 'secret', 'label' => 'Service Account Secret', 'required' => true],
            ['key' => 'project_id', 'type' => 'text', 'label' => 'Project ID', 'required' => false],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the MixpanelService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): MixpanelService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new MixpanelService(
                username: $creds->get('mixpanel', 'username', '', $account),
                secret: $creds->get('mixpanel', 'secret', '', $account),
                projectId: $creds->get('mixpanel', 'project_id', '', $account),
            );
        }

        return app(MixpanelService::class);
    }
}
