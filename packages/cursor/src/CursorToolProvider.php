<?php

namespace OpenCompany\Integrations\Cursor;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Cursor\Tools\CursorDeleteRepoBlocklist;
use OpenCompany\Integrations\Cursor\Tools\CursorGetDailyUsageData;
use OpenCompany\Integrations\Cursor\Tools\CursorGetSpend;
use OpenCompany\Integrations\Cursor\Tools\CursorGetUsageEvents;
use OpenCompany\Integrations\Cursor\Tools\CursorListRepoBlocklists;
use OpenCompany\Integrations\Cursor\Tools\CursorListTeamMembers;
use OpenCompany\Integrations\Cursor\Tools\CursorSetUserSpendLimit;
use OpenCompany\Integrations\Cursor\Tools\CursorUpsertRepoBlocklists;

/**
 * Exposes Cursor Admin API tools.
 *
 * Covers team members, usage, spending, spend limits, and repository blocklists.
 */
class CursorToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'strategy' => 'api_key_basic_auth',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => ['Cursor Admin API keys are sent as the Basic auth username with an empty password.'],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
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
        return 'cursor';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Cursor',
            'description' => 'Cursor team administration, usage, spending, and repo blocklists',
            'icon' => 'ph:code',
            'logo' => 'ph:code',
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
            'name' => 'Cursor',
            'description' => 'Cursor Admin API for team members, usage, spend, limits, and repo blocklists',
            'icon' => 'ph:code',
            'logo' => 'ph:code',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.cursor.com/account/teams/admin-api',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'Admin API Key',
                'placeholder' => 'key_...',
                'hint' => 'Generate an Admin API key in Cursor Dashboard > Settings > Cursor Admin API Keys.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.cursor.com',
                'hint' => 'Use https://api.cursor.com for the Cursor Admin API.',
                'default' => 'https://api.cursor.com',
            ],
        ];
    }

    /**
     * Test the connection to the Cursor Admin API using the provided configuration.
     *
     * @param  array<string, mixed>  $config  Configuration values to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.cursor.com', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Basic ' . base64_encode($apiKey . ':'),
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/teams/members');

            if (! $response->successful()) {
                $error = $response->json('error') ?? $response->json('message') ?? $response->body();

                return [
                    'success' => false,
                    'error' => 'Cursor API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            $members = $response->json('teamMembers') ?? [];

            return [
                'success' => true,
                'message' => 'Connected to Cursor Admin API. ' . count($members) . ' team members available.',
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'cursor_list_team_members' => ['class' => CursorListTeamMembers::class, 'type' => 'read', 'name' => 'List Team Members', 'description' => 'List all Cursor team members and roles.', 'icon' => 'ph:users'],
            'cursor_get_daily_usage_data' => ['class' => CursorGetDailyUsageData::class, 'type' => 'read', 'name' => 'Get Daily Usage Data', 'description' => 'Get Cursor team daily usage data for a date range.', 'icon' => 'ph:calendar-dots'],
            'cursor_get_spend' => ['class' => CursorGetSpend::class, 'type' => 'read', 'name' => 'Get Spend', 'description' => 'Get Cursor team spending data with search, sorting, and pagination.', 'icon' => 'ph:currency-dollar'],
            'cursor_get_usage_events' => ['class' => CursorGetUsageEvents::class, 'type' => 'read', 'name' => 'Get Usage Events', 'description' => 'Get detailed Cursor usage events with filters and pagination.', 'icon' => 'ph:activity'],
            'cursor_set_user_spend_limit' => ['class' => CursorSetUserSpendLimit::class, 'type' => 'write', 'name' => 'Set User Spend Limit', 'description' => 'Set a whole-dollar spend limit for a Cursor team member.', 'icon' => 'ph:gauge'],
            'cursor_list_repo_blocklists' => ['class' => CursorListRepoBlocklists::class, 'type' => 'read', 'name' => 'List Repo Blocklists', 'description' => 'List Cursor repository blocklists.', 'icon' => 'ph:git-branch'],
            'cursor_upsert_repo_blocklists' => ['class' => CursorUpsertRepoBlocklists::class, 'type' => 'write', 'name' => 'Upsert Repo Blocklists', 'description' => 'Replace blocklist patterns for one or more repositories.', 'icon' => 'ph:git-pull-request'],
            'cursor_delete_repo_blocklist' => ['class' => CursorDeleteRepoBlocklist::class, 'type' => 'write', 'name' => 'Delete Repo Blocklist', 'description' => 'Delete a Cursor repository blocklist entry.', 'icon' => 'ph:trash'],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/cursor.md';
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
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  class-string<Tool>  $class  The fully-qualified tool class name.
     * @param  array<string, mixed>  $context  Optional context with an account key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the Cursor service for default or account-scoped credentials.
     *
     * @param  array<string, mixed>  $context  Optional context with an account key.
     */
    private function resolveService(array $context = []): CursorService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new CursorService(
                apiKey: $creds->get('cursor', 'api_key', '', $account),
                baseUrl: $creds->get('cursor', 'url', 'https://api.cursor.com', $account),
            );
        }

        return app(CursorService::class);
    }
}
