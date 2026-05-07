<?php

namespace OpenCompany\Integrations\Fathom;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Fathom\Tools\FathomCreateEvent;
use OpenCompany\Integrations\Fathom\Tools\FathomCreateMilestone;
use OpenCompany\Integrations\Fathom\Tools\FathomCreateSite;
use OpenCompany\Integrations\Fathom\Tools\FathomDeleteEvent;
use OpenCompany\Integrations\Fathom\Tools\FathomDeleteMilestone;
use OpenCompany\Integrations\Fathom\Tools\FathomDeleteSite;
use OpenCompany\Integrations\Fathom\Tools\FathomGetAccount;
use OpenCompany\Integrations\Fathom\Tools\FathomGetAggregate;
use OpenCompany\Integrations\Fathom\Tools\FathomGetCurrentUser;
use OpenCompany\Integrations\Fathom\Tools\FathomGetCurrentVisitors;
use OpenCompany\Integrations\Fathom\Tools\FathomGetEvent;
use OpenCompany\Integrations\Fathom\Tools\FathomGetMilestone;
use OpenCompany\Integrations\Fathom\Tools\FathomGetSite;
use OpenCompany\Integrations\Fathom\Tools\FathomListEvents;
use OpenCompany\Integrations\Fathom\Tools\FathomListMilestones;
use OpenCompany\Integrations\Fathom\Tools\FathomListSites;
use OpenCompany\Integrations\Fathom\Tools\FathomUpdateEvent;
use OpenCompany\Integrations\Fathom\Tools\FathomUpdateMilestone;
use OpenCompany\Integrations\Fathom\Tools\FathomUpdateSite;
use OpenCompany\Integrations\Fathom\Tools\FathomWipeEvent;
use OpenCompany\Integrations\Fathom\Tools\FathomWipeSite;

/**
 * Exposes Fathom Analytics API tools.
 *
 * Covers the documented account, sites, events, milestones, reports, and current visitor endpoints.
 */
class FathomToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'setup_flows' => ['manual_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['access_token'],
                'notes' => [],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_token',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_token',
                    'runtime_mode' => 'normal',
                ],
            ],
            'runtime_requirements' => [],
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
        return 'fathom';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Fathom Analytics',
            'description' => 'Privacy-first website analytics',
            'icon' => 'ph:chart-line-up',
            'logo' => 'simple-icons:fathomanalytics',
        ];
    }

    /**
     * Canonical integration metadata used by settings and generated catalogs.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Fathom Analytics',
            'description' => 'Fathom Analytics API for sites, events, milestones, reports, and current visitors',
            'icon' => 'ph:chart-line-up',
            'logo' => 'simple-icons:fathomanalytics',
            'category' => 'analytics',
            'badge' => 'verified',
            'docs_url' => 'https://usefathom.com/api',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Fathom API access token',
                'hint' => 'Generate an access token in Fathom under Settings > API.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.usefathom.com/v1',
                'default' => 'https://api.usefathom.com/v1',
                'required' => false,
            ],
        ];
    }

    /**
     * Test the connection to the Fathom API using the provided configuration.
     *
     * @param  array<string, mixed>  $config  Configuration values to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.usefathom.com/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/account');

            if (! $response->successful()) {
                $error = $response->json('error') ?? $response->json('message') ?? $response->body();

                return [
                    'success' => false,
                    'error' => 'Fathom API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            $json = $response->json() ?? [];
            $name = $json['name'] ?? $json['email'] ?? 'Fathom account';

            return ['success' => true, 'message' => "Connected to {$name}."];
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
            'fathom_get_account' => ['class' => FathomGetAccount::class, 'type' => 'read', 'name' => 'Get Account', 'description' => 'Get the authenticated Fathom account profile.', 'icon' => 'ph:user'],
            'fathom_get_current_user' => ['class' => FathomGetCurrentUser::class, 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Backward-compatible account profile tool using the documented /account endpoint.', 'icon' => 'ph:user'],
            'fathom_list_sites' => ['class' => FathomListSites::class, 'type' => 'read', 'name' => 'List Sites', 'description' => 'List all websites tracked in Fathom Analytics.', 'icon' => 'ph:globe'],
            'fathom_get_site' => ['class' => FathomGetSite::class, 'type' => 'read', 'name' => 'Get Site', 'description' => 'Get details for a specific Fathom site.', 'icon' => 'ph:globe'],
            'fathom_create_site' => ['class' => FathomCreateSite::class, 'type' => 'write', 'name' => 'Create Site', 'description' => 'Create a Fathom site.', 'icon' => 'ph:plus-circle'],
            'fathom_update_site' => ['class' => FathomUpdateSite::class, 'type' => 'write', 'name' => 'Update Site', 'description' => 'Update a Fathom site.', 'icon' => 'ph:pencil'],
            'fathom_wipe_site' => ['class' => FathomWipeSite::class, 'type' => 'write', 'name' => 'Wipe Site', 'description' => 'Wipe all analytics data from a Fathom site.', 'icon' => 'ph:eraser'],
            'fathom_delete_site' => ['class' => FathomDeleteSite::class, 'type' => 'write', 'name' => 'Delete Site', 'description' => 'Delete a Fathom site.', 'icon' => 'ph:trash'],
            'fathom_list_events' => ['class' => FathomListEvents::class, 'type' => 'read', 'name' => 'List Events', 'description' => 'List events for a Fathom site.', 'icon' => 'ph:lightning'],
            'fathom_get_event' => ['class' => FathomGetEvent::class, 'type' => 'read', 'name' => 'Get Event', 'description' => 'Get a Fathom event.', 'icon' => 'ph:lightning'],
            'fathom_create_event' => ['class' => FathomCreateEvent::class, 'type' => 'write', 'name' => 'Create Event', 'description' => 'Create a Fathom event.', 'icon' => 'ph:plus-circle'],
            'fathom_update_event' => ['class' => FathomUpdateEvent::class, 'type' => 'write', 'name' => 'Update Event', 'description' => 'Update a Fathom event.', 'icon' => 'ph:pencil'],
            'fathom_wipe_event' => ['class' => FathomWipeEvent::class, 'type' => 'write', 'name' => 'Wipe Event', 'description' => 'Wipe Fathom event completion data.', 'icon' => 'ph:eraser'],
            'fathom_delete_event' => ['class' => FathomDeleteEvent::class, 'type' => 'write', 'name' => 'Delete Event', 'description' => 'Delete a Fathom event.', 'icon' => 'ph:trash'],
            'fathom_list_milestones' => ['class' => FathomListMilestones::class, 'type' => 'read', 'name' => 'List Milestones', 'description' => 'List Fathom milestones for a site.', 'icon' => 'ph:flag'],
            'fathom_get_milestone' => ['class' => FathomGetMilestone::class, 'type' => 'read', 'name' => 'Get Milestone', 'description' => 'Get a Fathom milestone.', 'icon' => 'ph:flag'],
            'fathom_create_milestone' => ['class' => FathomCreateMilestone::class, 'type' => 'write', 'name' => 'Create Milestone', 'description' => 'Create a Fathom milestone.', 'icon' => 'ph:plus-circle'],
            'fathom_update_milestone' => ['class' => FathomUpdateMilestone::class, 'type' => 'write', 'name' => 'Update Milestone', 'description' => 'Update a Fathom milestone.', 'icon' => 'ph:pencil'],
            'fathom_delete_milestone' => ['class' => FathomDeleteMilestone::class, 'type' => 'write', 'name' => 'Delete Milestone', 'description' => 'Delete a Fathom milestone.', 'icon' => 'ph:trash'],
            'fathom_get_aggregate' => ['class' => FathomGetAggregate::class, 'type' => 'read', 'name' => 'Get Aggregation', 'description' => 'Generate a Fathom aggregation report.', 'icon' => 'ph:chart-bar'],
            'fathom_get_current_visitors' => ['class' => FathomGetCurrentVisitors::class, 'type' => 'read', 'name' => 'Current Visitors', 'description' => 'Get current visitors for a Fathom site.', 'icon' => 'ph:users-three'],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/fathom.md';
    }

    public function credentialFields(): array
    {
        return $this->configSchema();
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with optional account-specific credentials.
     *
     * @param  class-string<Tool>  $class  The fully-qualified tool class name.
     * @param  array<string, mixed>  $context  Optional context with an account key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the Fathom service for default or account-scoped credentials.
     *
     * @param  array<string, mixed>  $context  Optional context with an account key.
     */
    private function resolveService(array $context = []): FathomService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new FathomService(
                accessToken: $creds->get('fathom', 'access_token', '', $account),
                baseUrl: $creds->get('fathom', 'url', 'https://api.usefathom.com/v1', $account),
            );
        }

        return app(FathomService::class);
    }
}
