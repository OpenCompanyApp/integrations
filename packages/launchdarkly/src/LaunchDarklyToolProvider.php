<?php

namespace OpenCompany\Integrations\LaunchDarkly;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyApiDelete;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyApiGet;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyApiPatch;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyApiPost;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyApiPut;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyCopyFeatureFlag;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyCreateEnvironment;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyCreateFeatureFlag;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyCreateProject;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyCreateSegment;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyCreateTeam;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyDeleteEnvironment;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyDeleteFeatureFlag;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyDeleteMember;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyDeleteProject;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyDeleteSegment;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyDeleteTeam;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyGetCurrentUser;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyGetEnvironment;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyGetFlag;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyGetMember;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyGetProject;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyGetSegment;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyGetTeam;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyInviteMembers;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyListEnvironments;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyListFlags;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyListMembers;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyListProjects;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyListSegments;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyListTeams;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyToggleFlag;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyUpdateEnvironment;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyUpdateFeatureFlag;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyUpdateMember;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyUpdateProject;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyUpdateSegment;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyUpdateTeam;

/**
 * Tool provider for LaunchDarkly feature-management APIs.
 *
 * Exposes typed tools for core project, environment, flag, segment, member, and
 * team workflows plus raw API helpers for less common LaunchDarkly endpoints.
 */
class LaunchDarklyToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'launchdarkly';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'LaunchDarkly',
            'description' => 'Feature flags and release management',
            'icon' => 'ph:flag',
            'logo' => 'simple-icons:launchdarkly',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'LaunchDarkly',
            'description' => 'Feature flags, projects, environments, segments, members, and teams',
            'icon' => 'ph:flag',
            'logo' => 'simple-icons:launchdarkly',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://launchdarkly.com/docs/api',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your LaunchDarkly access token',
                'hint' => 'Generate an API access token in LaunchDarkly under Account Settings > Authorization',
                'required' => true,
            ],
            [
                'key' => 'project_key',
                'type' => 'text',
                'label' => 'Default Project Key',
                'placeholder' => 'default',
                'hint' => 'The LaunchDarkly project key to use by default for legacy flag tools.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://app.launchdarkly.com/api/v2',
                'hint' => 'Use <code>https://app.launchdarkly.com/api/v2</code> for the standard LaunchDarkly API.',
                'default' => 'https://app.launchdarkly.com/api/v2',
            ],
        ];
    }

    /**
     * Test LaunchDarkly credentials against the authenticated member endpoint.
     *
     * @param  array<string, mixed>  $config  Credential form values.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://app.launchdarkly.com/api/v2', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/members/me');

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => 'LaunchDarkly API error (' . $response->status() . '): ' . $response->body(),
                ];
            }

            $json = $response->json();

            if (!is_array($json)) {
                return [
                    'success' => false,
                    'error' => "Could not reach LaunchDarkly API at {$baseUrl}. Check the URL.",
                ];
            }

            $member = $json['member'] ?? $json;
            $name = trim(($member['firstName'] ?? '') . ' ' . ($member['lastName'] ?? ''));
            $label = $name !== '' ? $name : ($member['email'] ?? 'the authenticated member');

            return [
                'success' => true,
                'message' => "Connected to LaunchDarkly as {$label}.",
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'project_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'launchdarkly_api_get' => ['class' => LaunchDarklyApiGet::class, 'type' => 'read', 'name' => 'API GET', 'description' => 'Call any LaunchDarkly GET endpoint.', 'icon' => 'ph:plug'],
            'launchdarkly_api_post' => ['class' => LaunchDarklyApiPost::class, 'type' => 'write', 'name' => 'API POST', 'description' => 'Call any LaunchDarkly POST endpoint.', 'icon' => 'ph:plug'],
            'launchdarkly_api_patch' => ['class' => LaunchDarklyApiPatch::class, 'type' => 'write', 'name' => 'API PATCH', 'description' => 'Call any LaunchDarkly PATCH endpoint.', 'icon' => 'ph:plug'],
            'launchdarkly_api_put' => ['class' => LaunchDarklyApiPut::class, 'type' => 'write', 'name' => 'API PUT', 'description' => 'Call any LaunchDarkly PUT endpoint.', 'icon' => 'ph:plug'],
            'launchdarkly_api_delete' => ['class' => LaunchDarklyApiDelete::class, 'type' => 'write', 'name' => 'API DELETE', 'description' => 'Call any LaunchDarkly DELETE endpoint.', 'icon' => 'ph:plug'],

            'launchdarkly_list_projects' => ['class' => LaunchDarklyListProjects::class, 'type' => 'read', 'name' => 'List Projects', 'description' => 'List all LaunchDarkly projects.', 'icon' => 'ph:folder'],
            'launchdarkly_get_project' => ['class' => LaunchDarklyGetProject::class, 'type' => 'read', 'name' => 'Get Project', 'description' => 'Get details of a specific LaunchDarkly project.', 'icon' => 'ph:folder-open'],
            'launchdarkly_create_project' => ['class' => LaunchDarklyCreateProject::class, 'type' => 'write', 'name' => 'Create Project', 'description' => 'Create a LaunchDarkly project.', 'icon' => 'ph:folder-plus'],
            'launchdarkly_update_project' => ['class' => LaunchDarklyUpdateProject::class, 'type' => 'write', 'name' => 'Update Project', 'description' => 'Update a LaunchDarkly project with JSON Patch.', 'icon' => 'ph:pencil-simple'],
            'launchdarkly_delete_project' => ['class' => LaunchDarklyDeleteProject::class, 'type' => 'write', 'name' => 'Delete Project', 'description' => 'Delete a LaunchDarkly project.', 'icon' => 'ph:trash'],

            'launchdarkly_list_environments' => ['class' => LaunchDarklyListEnvironments::class, 'type' => 'read', 'name' => 'List Environments', 'description' => 'List environments for a LaunchDarkly project.', 'icon' => 'ph:tree-structure'],
            'launchdarkly_get_environment' => ['class' => LaunchDarklyGetEnvironment::class, 'type' => 'read', 'name' => 'Get Environment', 'description' => 'Get a LaunchDarkly environment.', 'icon' => 'ph:tree-structure'],
            'launchdarkly_create_environment' => ['class' => LaunchDarklyCreateEnvironment::class, 'type' => 'write', 'name' => 'Create Environment', 'description' => 'Create a LaunchDarkly environment.', 'icon' => 'ph:plus-circle'],
            'launchdarkly_update_environment' => ['class' => LaunchDarklyUpdateEnvironment::class, 'type' => 'write', 'name' => 'Update Environment', 'description' => 'Update a LaunchDarkly environment.', 'icon' => 'ph:pencil-simple'],
            'launchdarkly_delete_environment' => ['class' => LaunchDarklyDeleteEnvironment::class, 'type' => 'write', 'name' => 'Delete Environment', 'description' => 'Delete a LaunchDarkly environment.', 'icon' => 'ph:trash'],

            'launchdarkly_list_flags' => ['class' => LaunchDarklyListFlags::class, 'type' => 'read', 'name' => 'List Flags', 'description' => 'List feature flags in a LaunchDarkly project.', 'icon' => 'ph:flag'],
            'launchdarkly_get_flag' => ['class' => LaunchDarklyGetFlag::class, 'type' => 'read', 'name' => 'Get Flag', 'description' => 'Get details of a specific feature flag.', 'icon' => 'ph:flag'],
            'launchdarkly_create_feature_flag' => ['class' => LaunchDarklyCreateFeatureFlag::class, 'type' => 'write', 'name' => 'Create Feature Flag', 'description' => 'Create a LaunchDarkly feature flag.', 'icon' => 'ph:flag-pennant'],
            'launchdarkly_update_feature_flag' => ['class' => LaunchDarklyUpdateFeatureFlag::class, 'type' => 'write', 'name' => 'Update Feature Flag', 'description' => 'Update a LaunchDarkly feature flag.', 'icon' => 'ph:pencil-simple'],
            'launchdarkly_toggle_flag' => ['class' => LaunchDarklyToggleFlag::class, 'type' => 'write', 'name' => 'Toggle Flag', 'description' => 'Turn a feature flag on or off in a specific environment.', 'icon' => 'ph:toggle-left'],
            'launchdarkly_copy_feature_flag' => ['class' => LaunchDarklyCopyFeatureFlag::class, 'type' => 'write', 'name' => 'Copy Feature Flag', 'description' => 'Copy feature flag settings between environments.', 'icon' => 'ph:copy'],
            'launchdarkly_delete_feature_flag' => ['class' => LaunchDarklyDeleteFeatureFlag::class, 'type' => 'write', 'name' => 'Delete Feature Flag', 'description' => 'Delete a LaunchDarkly feature flag.', 'icon' => 'ph:trash'],

            'launchdarkly_list_segments' => ['class' => LaunchDarklyListSegments::class, 'type' => 'read', 'name' => 'List Segments', 'description' => 'List segments in a LaunchDarkly environment.', 'icon' => 'ph:circles-three'],
            'launchdarkly_get_segment' => ['class' => LaunchDarklyGetSegment::class, 'type' => 'read', 'name' => 'Get Segment', 'description' => 'Get a LaunchDarkly segment.', 'icon' => 'ph:circles-three'],
            'launchdarkly_create_segment' => ['class' => LaunchDarklyCreateSegment::class, 'type' => 'write', 'name' => 'Create Segment', 'description' => 'Create a LaunchDarkly segment.', 'icon' => 'ph:plus-circle'],
            'launchdarkly_update_segment' => ['class' => LaunchDarklyUpdateSegment::class, 'type' => 'write', 'name' => 'Update Segment', 'description' => 'Update a LaunchDarkly segment.', 'icon' => 'ph:pencil-simple'],
            'launchdarkly_delete_segment' => ['class' => LaunchDarklyDeleteSegment::class, 'type' => 'write', 'name' => 'Delete Segment', 'description' => 'Delete a LaunchDarkly segment.', 'icon' => 'ph:trash'],

            'launchdarkly_get_current_user' => ['class' => LaunchDarklyGetCurrentUser::class, 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Get the currently authenticated LaunchDarkly user.', 'icon' => 'ph:user'],
            'launchdarkly_list_members' => ['class' => LaunchDarklyListMembers::class, 'type' => 'read', 'name' => 'List Members', 'description' => 'List LaunchDarkly account members.', 'icon' => 'ph:users'],
            'launchdarkly_get_member' => ['class' => LaunchDarklyGetMember::class, 'type' => 'read', 'name' => 'Get Member', 'description' => 'Get a LaunchDarkly account member.', 'icon' => 'ph:user'],
            'launchdarkly_invite_members' => ['class' => LaunchDarklyInviteMembers::class, 'type' => 'write', 'name' => 'Invite Members', 'description' => 'Invite LaunchDarkly account members.', 'icon' => 'ph:user-plus'],
            'launchdarkly_update_member' => ['class' => LaunchDarklyUpdateMember::class, 'type' => 'write', 'name' => 'Update Member', 'description' => 'Update a LaunchDarkly account member.', 'icon' => 'ph:pencil-simple'],
            'launchdarkly_delete_member' => ['class' => LaunchDarklyDeleteMember::class, 'type' => 'write', 'name' => 'Delete Member', 'description' => 'Delete a LaunchDarkly account member.', 'icon' => 'ph:user-minus'],

            'launchdarkly_list_teams' => ['class' => LaunchDarklyListTeams::class, 'type' => 'read', 'name' => 'List Teams', 'description' => 'List LaunchDarkly teams.', 'icon' => 'ph:users-three'],
            'launchdarkly_get_team' => ['class' => LaunchDarklyGetTeam::class, 'type' => 'read', 'name' => 'Get Team', 'description' => 'Get a LaunchDarkly team.', 'icon' => 'ph:users-three'],
            'launchdarkly_create_team' => ['class' => LaunchDarklyCreateTeam::class, 'type' => 'write', 'name' => 'Create Team', 'description' => 'Create a LaunchDarkly team.', 'icon' => 'ph:user-list'],
            'launchdarkly_update_team' => ['class' => LaunchDarklyUpdateTeam::class, 'type' => 'write', 'name' => 'Update Team', 'description' => 'Update a LaunchDarkly team.', 'icon' => 'ph:pencil-simple'],
            'launchdarkly_delete_team' => ['class' => LaunchDarklyDeleteTeam::class, 'type' => 'write', 'name' => 'Delete Team', 'description' => 'Delete a LaunchDarkly team.', 'icon' => 'ph:trash'],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/launchdarkly.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'project_key', 'type' => 'text', 'label' => 'Project Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://app.launchdarkly.com/api/v2'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a LaunchDarkly tool using default or account-scoped credentials.
     *
     * @param  class-string<Tool>  $class  Tool class name.
     * @param  array<string, mixed>  $context  Optional context with account key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a LaunchDarkly service for default or multi-account credentials.
     *
     * @param  array<string, mixed>  $context  Optional context with account key.
     */
    private function resolveService(array $context = []): LaunchDarklyService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new LaunchDarklyService(
                accessToken: $creds->get('launchdarkly', 'access_token', '', $account),
                projectKey: $creds->get('launchdarkly', 'project_key', '', $account),
                baseUrl: $creds->get('launchdarkly', 'url', 'https://app.launchdarkly.com/api/v2', $account),
            );
        }

        return app(LaunchDarklyService::class);
    }
}
