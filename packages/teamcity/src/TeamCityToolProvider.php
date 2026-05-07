<?php

namespace OpenCompany\Integrations\TeamCity;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\TeamCity\Tools\TeamCityAddBuildTags;
use OpenCompany\Integrations\TeamCity\Tools\TeamCityApiDelete;
use OpenCompany\Integrations\TeamCity\Tools\TeamCityApiGet;
use OpenCompany\Integrations\TeamCity\Tools\TeamCityApiPatch;
use OpenCompany\Integrations\TeamCity\Tools\TeamCityApiPost;
use OpenCompany\Integrations\TeamCity\Tools\TeamCityApiPut;
use OpenCompany\Integrations\TeamCity\Tools\TeamCityCancelBuild;
use OpenCompany\Integrations\TeamCity\Tools\TeamCityCancelQueuedBuild;
use OpenCompany\Integrations\TeamCity\Tools\TeamCityCreateProject;
use OpenCompany\Integrations\TeamCity\Tools\TeamCityDeleteBuild;
use OpenCompany\Integrations\TeamCity\Tools\TeamCityDeleteProject;
use OpenCompany\Integrations\TeamCity\Tools\TeamCityGetAgent;
use OpenCompany\Integrations\TeamCity\Tools\TeamCityGetBuild;
use OpenCompany\Integrations\TeamCity\Tools\TeamCityGetBuildStatistics;
use OpenCompany\Integrations\TeamCity\Tools\TeamCityGetBuildTags;
use OpenCompany\Integrations\TeamCity\Tools\TeamCityGetBuildType;
use OpenCompany\Integrations\TeamCity\Tools\TeamCityGetProject;
use OpenCompany\Integrations\TeamCity\Tools\TeamCityGetServerInfo;
use OpenCompany\Integrations\TeamCity\Tools\TeamCityGetUser;
use OpenCompany\Integrations\TeamCity\Tools\TeamCityListAgents;
use OpenCompany\Integrations\TeamCity\Tools\TeamCityListBuildArtifacts;
use OpenCompany\Integrations\TeamCity\Tools\TeamCityListBuildQueue;
use OpenCompany\Integrations\TeamCity\Tools\TeamCityListBuilds;
use OpenCompany\Integrations\TeamCity\Tools\TeamCityListBuildTypeBuilds;
use OpenCompany\Integrations\TeamCity\Tools\TeamCityListBuildTypes;
use OpenCompany\Integrations\TeamCity\Tools\TeamCityListChanges;
use OpenCompany\Integrations\TeamCity\Tools\TeamCityListGroups;
use OpenCompany\Integrations\TeamCity\Tools\TeamCityListInvestigations;
use OpenCompany\Integrations\TeamCity\Tools\TeamCityListProblems;
use OpenCompany\Integrations\TeamCity\Tools\TeamCityListProjects;
use OpenCompany\Integrations\TeamCity\Tools\TeamCityListUsers;
use OpenCompany\Integrations\TeamCity\Tools\TeamCityListVcsRoots;
use OpenCompany\Integrations\TeamCity\Tools\TeamCityQueueBuild;
use OpenCompany\Integrations\TeamCity\Tools\TeamCitySetBuildPinInfo;
use OpenCompany\Integrations\TeamCity\Tools\TeamCitySetQueuePaused;

/**
 * Tool catalog and configuration metadata for TeamCity.
 *
 * Exposes TeamCity REST API operations for projects, build configurations,
 * builds, queue control, agents, users, diagnostics, and safe raw API calls.
 */
class TeamCityToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe authentication and host capabilities.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => [
                'strategy' => 'bearer_token',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'required_secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['access_token'],
                'notes' => ['TeamCity REST API calls use Authorization: Bearer <token> and JSON headers.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string
    {
        return 'teamcity';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'TeamCity',
            'description' => 'CI/CD projects, build configurations, builds, queues, and agents',
            'icon' => 'ph:terminal-window',
            'logo' => 'ph:terminal-window',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'TeamCity',
            'description' => 'Manage TeamCity projects, build configurations, builds, queue state, agents, users, and diagnostics through the REST API.',
            'icon' => 'ph:terminal-window',
            'logo' => 'ph:terminal-window',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://www.jetbrains.com/help/teamcity/rest/teamcity-rest-api-documentation.html',
        ];
    }

    public function configSchema(): array
    {
        return $this->credentialFields();
    }

    /**
     * Verify TeamCity credentials with the lightweight server endpoint.
     *
     * @param  array<string, mixed>  $config  Credential settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        try {
            $token = (string) ($config['access_token'] ?? '');
            $baseUrl = $this->normalizeBaseUrl((string) ($config['url'] ?? ''));
            if ($token === '' || $baseUrl === '') {
                return ['success' => false, 'error' => 'TeamCity URL and access token are required.'];
            }

            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$token,
                'Accept' => 'application/json',
            ])->timeout(20)->get($baseUrl.'/server');

            if (!$response->successful()) {
                return ['success' => false, 'error' => 'TeamCity API returned HTTP '.$response->status().'.'];
            }

            $version = (string) ($response->json('version') ?? 'unknown version');

            return ['success' => true, 'message' => "Connected to TeamCity {$version}."];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['url' => 'required|string', 'access_token' => 'required|string'];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'url', 'type' => 'text', 'label' => 'TeamCity URL', 'placeholder' => 'https://teamcity.example.test', 'hint' => 'TeamCity server URL. /app/rest is appended automatically when omitted.', 'required' => true],
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'tc_token...', 'hint' => 'TeamCity access token with permissions for the tools you want to use.', 'required' => true],
        ];
    }

    public function tools(): array
    {
        return [
            'teamcity_get_server_info' => ['class' => TeamCityGetServerInfo::class, 'type' => 'read', 'name' => 'Get Server Info', 'description' => 'Get TeamCity server details.', 'icon' => 'ph:info'],
            'teamcity_list_projects' => ['class' => TeamCityListProjects::class, 'type' => 'read', 'name' => 'List Projects', 'description' => 'List TeamCity projects.', 'icon' => 'ph:folder'],
            'teamcity_get_project' => ['class' => TeamCityGetProject::class, 'type' => 'read', 'name' => 'Get Project', 'description' => 'Get one project by locator.', 'icon' => 'ph:folder-open'],
            'teamcity_create_project' => ['class' => TeamCityCreateProject::class, 'type' => 'write', 'name' => 'Create Project', 'description' => 'Create a TeamCity project.', 'icon' => 'ph:plus-circle'],
            'teamcity_delete_project' => ['class' => TeamCityDeleteProject::class, 'type' => 'write', 'name' => 'Delete Project', 'description' => 'Delete a TeamCity project.', 'icon' => 'ph:trash'],
            'teamcity_list_build_types' => ['class' => TeamCityListBuildTypes::class, 'type' => 'read', 'name' => 'List Build Types', 'description' => 'List build configurations.', 'icon' => 'ph:git-branch'],
            'teamcity_get_build_type' => ['class' => TeamCityGetBuildType::class, 'type' => 'read', 'name' => 'Get Build Type', 'description' => 'Get one build configuration.', 'icon' => 'ph:git-branch'],
            'teamcity_list_build_type_builds' => ['class' => TeamCityListBuildTypeBuilds::class, 'type' => 'read', 'name' => 'List Build Type Builds', 'description' => 'List builds for one build configuration.', 'icon' => 'ph:list-checks'],
            'teamcity_list_builds' => ['class' => TeamCityListBuilds::class, 'type' => 'read', 'name' => 'List Builds', 'description' => 'List builds by locator.', 'icon' => 'ph:list-checks'],
            'teamcity_get_build' => ['class' => TeamCityGetBuild::class, 'type' => 'read', 'name' => 'Get Build', 'description' => 'Get one build by locator.', 'icon' => 'ph:check-circle'],
            'teamcity_queue_build' => ['class' => TeamCityQueueBuild::class, 'type' => 'write', 'name' => 'Queue Build', 'description' => 'Add a build to the queue.', 'icon' => 'ph:play'],
            'teamcity_cancel_queued_build' => ['class' => TeamCityCancelQueuedBuild::class, 'type' => 'write', 'name' => 'Cancel Queued Build', 'description' => 'Cancel a queued build by locator.', 'icon' => 'ph:x-circle'],
            'teamcity_cancel_build' => ['class' => TeamCityCancelBuild::class, 'type' => 'write', 'name' => 'Cancel Build', 'description' => 'Cancel a started build by locator.', 'icon' => 'ph:x-circle'],
            'teamcity_delete_build' => ['class' => TeamCityDeleteBuild::class, 'type' => 'write', 'name' => 'Delete Build', 'description' => 'Delete build metadata by locator.', 'icon' => 'ph:trash'],
            'teamcity_list_build_artifacts' => ['class' => TeamCityListBuildArtifacts::class, 'type' => 'read', 'name' => 'List Build Artifacts', 'description' => 'List artifact files for a build.', 'icon' => 'ph:archive'],
            'teamcity_get_build_statistics' => ['class' => TeamCityGetBuildStatistics::class, 'type' => 'read', 'name' => 'Get Build Statistics', 'description' => 'Get statistical values for a build.', 'icon' => 'ph:chart-line'],
            'teamcity_get_build_tags' => ['class' => TeamCityGetBuildTags::class, 'type' => 'read', 'name' => 'Get Build Tags', 'description' => 'Get tags for a build.', 'icon' => 'ph:tag'],
            'teamcity_add_build_tags' => ['class' => TeamCityAddBuildTags::class, 'type' => 'write', 'name' => 'Add Build Tags', 'description' => 'Add tags to a build.', 'icon' => 'ph:tag'],
            'teamcity_set_build_pin_info' => ['class' => TeamCitySetBuildPinInfo::class, 'type' => 'write', 'name' => 'Set Build Pin Info', 'description' => 'Pin or unpin a build.', 'icon' => 'ph:push-pin'],
            'teamcity_list_build_queue' => ['class' => TeamCityListBuildQueue::class, 'type' => 'read', 'name' => 'List Build Queue', 'description' => 'List queued builds.', 'icon' => 'ph:queue'],
            'teamcity_set_queue_paused' => ['class' => TeamCitySetQueuePaused::class, 'type' => 'write', 'name' => 'Set Queue Paused', 'description' => 'Pause or resume the build queue.', 'icon' => 'ph:pause-circle'],
            'teamcity_list_agents' => ['class' => TeamCityListAgents::class, 'type' => 'read', 'name' => 'List Agents', 'description' => 'List build agents.', 'icon' => 'ph:hard-drives'],
            'teamcity_get_agent' => ['class' => TeamCityGetAgent::class, 'type' => 'read', 'name' => 'Get Agent', 'description' => 'Get one build agent by locator.', 'icon' => 'ph:hard-drive'],
            'teamcity_list_users' => ['class' => TeamCityListUsers::class, 'type' => 'read', 'name' => 'List Users', 'description' => 'List TeamCity users.', 'icon' => 'ph:users'],
            'teamcity_get_user' => ['class' => TeamCityGetUser::class, 'type' => 'read', 'name' => 'Get User', 'description' => 'Get one user by locator.', 'icon' => 'ph:user'],
            'teamcity_list_groups' => ['class' => TeamCityListGroups::class, 'type' => 'read', 'name' => 'List Groups', 'description' => 'List user groups.', 'icon' => 'ph:users-three'],
            'teamcity_list_investigations' => ['class' => TeamCityListInvestigations::class, 'type' => 'read', 'name' => 'List Investigations', 'description' => 'List investigations.', 'icon' => 'ph:magnifying-glass'],
            'teamcity_list_problems' => ['class' => TeamCityListProblems::class, 'type' => 'read', 'name' => 'List Problems', 'description' => 'List build problems.', 'icon' => 'ph:warning'],
            'teamcity_list_changes' => ['class' => TeamCityListChanges::class, 'type' => 'read', 'name' => 'List Changes', 'description' => 'List VCS changes.', 'icon' => 'ph:git-commit'],
            'teamcity_list_vcs_roots' => ['class' => TeamCityListVcsRoots::class, 'type' => 'read', 'name' => 'List VCS Roots', 'description' => 'List VCS roots.', 'icon' => 'ph:git-fork'],
            'teamcity_api_get' => ['class' => TeamCityApiGet::class, 'type' => 'read', 'name' => 'API GET', 'description' => 'Call a safe relative TeamCity GET path.', 'icon' => 'ph:code'],
            'teamcity_api_post' => ['class' => TeamCityApiPost::class, 'type' => 'write', 'name' => 'API POST', 'description' => 'Call a safe relative TeamCity POST path.', 'icon' => 'ph:code'],
            'teamcity_api_put' => ['class' => TeamCityApiPut::class, 'type' => 'write', 'name' => 'API PUT', 'description' => 'Call a safe relative TeamCity PUT path.', 'icon' => 'ph:code'],
            'teamcity_api_patch' => ['class' => TeamCityApiPatch::class, 'type' => 'write', 'name' => 'API PATCH', 'description' => 'Call a safe relative TeamCity PATCH path.', 'icon' => 'ph:code'],
            'teamcity_api_delete' => ['class' => TeamCityApiDelete::class, 'type' => 'write', 'name' => 'API DELETE', 'description' => 'Call a safe relative TeamCity DELETE path.', 'icon' => 'ph:code'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a TeamCity tool instance.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): TeamCityService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new TeamCityService(
                accessToken: $creds->get('teamcity', 'access_token', '', $account),
                baseUrl: $creds->get('teamcity', 'url', '', $account),
            );
        }

        return app(TeamCityService::class);
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/teamcity.md';
    }

    private function normalizeBaseUrl(string $url): string
    {
        $url = rtrim(trim($url), '/');
        if ($url === '') {
            return '';
        }

        return str_ends_with($url, '/app/rest') ? $url : $url.'/app/rest';
    }
}
