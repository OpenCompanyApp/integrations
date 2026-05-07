<?php

namespace OpenCompany\Integrations\Supabase;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Supabase\Tools\SupabaseCreateProject;
use OpenCompany\Integrations\Supabase\Tools\SupabaseDeleteProject;
use OpenCompany\Integrations\Supabase\Tools\SupabaseGetCurrentUser;
use OpenCompany\Integrations\Supabase\Tools\SupabaseGetOrganization;
use OpenCompany\Integrations\Supabase\Tools\SupabaseGetProject;
use OpenCompany\Integrations\Supabase\Tools\SupabaseGetProjectApiKeys;
use OpenCompany\Integrations\Supabase\Tools\SupabaseListOrganizationMembers;
use OpenCompany\Integrations\Supabase\Tools\SupabaseListOrganizationProjects;
use OpenCompany\Integrations\Supabase\Tools\SupabaseListOrganizations;
use OpenCompany\Integrations\Supabase\Tools\SupabaseListProjects;

/**
 * Tool provider for the Supabase Management API integration.
 *
 * Exposes documented project and organization management tools with bearer
 * token setup and multi-account credential resolution.
 */
class SupabaseToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => ['Supabase Management API requests use Authorization: Bearer with a personal access token or OAuth access token.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal'],
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
        return 'supabase';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Supabase',
            'description' => 'Supabase Management API for projects and organizations',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:supabase',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Supabase',
            'description' => 'Manage Supabase projects, organizations, members, and project API keys through the official Management API.',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:supabase',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://supabase.com/docs/reference/api/introduction',
            'source_url' => 'https://supabase.com/docs/reference/api/introduction',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Supabase access token',
                'hint' => 'Generate a Supabase personal access token in Account Settings > Access Tokens.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API URL',
                'placeholder' => 'https://api.supabase.com/v1',
                'hint' => 'Use https://api.supabase.com/v1 for the default Supabase Management API.',
                'default' => 'https://api.supabase.com/v1',
            ],
        ];
    }

    /**
     * Test the configured Supabase access token with the profile endpoint.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.supabase.com/v1'), '/');

        if ($accessToken === '') {
            return ['success' => false, 'error' => 'No access token provided.'];
        }

        try {
            $response = Http::withToken($accessToken)
                ->acceptJson()
                ->timeout(10)
                ->get($baseUrl . '/profile');

            if (!$response->successful()) {
                $message = $response->json('message') ?? $response->json('msg') ?? $response->body();

                return [
                    'success' => false,
                    'error' => 'Supabase API error (' . $response->status() . '): ' . (is_string($message) ? $message : json_encode($message)),
                ];
            }

            $profile = $response->json() ?? [];
            $email = is_array($profile) ? ($profile['email'] ?? $profile['primary_email'] ?? 'authenticated user') : 'authenticated user';

            return [
                'success' => true,
                'message' => "Connected to Supabase as {$email}.",
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * @return array<string, string>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'supabase_get_current_user' => [
                'class' => SupabaseGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Supabase user profile information.',
                'icon' => 'ph:user-circle',
            ],
            'supabase_list_projects' => [
                'class' => SupabaseListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List all Supabase projects visible to the authenticated account.',
                'icon' => 'ph:folders',
            ],
            'supabase_get_project' => [
                'class' => SupabaseGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get a specific Supabase project by project ref.',
                'icon' => 'ph:folder-open',
            ],
            'supabase_create_project' => [
                'class' => SupabaseCreateProject::class,
                'type' => 'write',
                'name' => 'Create Project',
                'description' => 'Create a Supabase project in an organization.',
                'icon' => 'ph:folder-plus',
            ],
            'supabase_delete_project' => [
                'class' => SupabaseDeleteProject::class,
                'type' => 'write',
                'name' => 'Delete Project',
                'description' => 'Delete a Supabase project by project ref.',
                'icon' => 'ph:trash',
            ],
            'supabase_list_organizations' => [
                'class' => SupabaseListOrganizations::class,
                'type' => 'read',
                'name' => 'List Organizations',
                'description' => 'List Supabase organizations visible to the authenticated account.',
                'icon' => 'ph:buildings',
            ],
            'supabase_get_organization' => [
                'class' => SupabaseGetOrganization::class,
                'type' => 'read',
                'name' => 'Get Organization',
                'description' => 'Get a Supabase organization by slug.',
                'icon' => 'ph:building-office',
            ],
            'supabase_list_organization_members' => [
                'class' => SupabaseListOrganizationMembers::class,
                'type' => 'read',
                'name' => 'List Organization Members',
                'description' => 'List members of a Supabase organization.',
                'icon' => 'ph:users',
            ],
            'supabase_list_organization_projects' => [
                'class' => SupabaseListOrganizationProjects::class,
                'type' => 'read',
                'name' => 'List Organization Projects',
                'description' => 'List projects for a Supabase organization.',
                'icon' => 'ph:folders',
            ],
            'supabase_get_project_api_keys' => [
                'class' => SupabaseGetProjectApiKeys::class,
                'type' => 'read',
                'name' => 'Get Project API Keys',
                'description' => 'Get API keys for a Supabase project.',
                'icon' => 'ph:key',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/supabase.md';
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return $this->configSchema();
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with default or account-specific credentials.
     *
     * @param  class-string<Tool>  $class  Tool class to instantiate.
     * @param  array<string, mixed>  $context  Optional context containing account.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a service for default or named account credentials.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): SupabaseService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new SupabaseService(
                accessToken: (string) $creds->get('supabase', 'access_token', '', (string) $account),
                baseUrl: (string) $creds->get('supabase', 'url', 'https://api.supabase.com/v1', (string) $account),
            );
        }

        return app(SupabaseService::class);
    }
}
