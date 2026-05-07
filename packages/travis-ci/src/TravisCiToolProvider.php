<?php

namespace OpenCompany\Integrations\TravisCi;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\TravisCi\Tools\TravisCiActivateRepository;
use OpenCompany\Integrations\TravisCi\Tools\TravisCiApiDelete;
use OpenCompany\Integrations\TravisCi\Tools\TravisCiApiGet;
use OpenCompany\Integrations\TravisCi\Tools\TravisCiApiPatch;
use OpenCompany\Integrations\TravisCi\Tools\TravisCiApiPost;
use OpenCompany\Integrations\TravisCi\Tools\TravisCiCancelBuild;
use OpenCompany\Integrations\TravisCi\Tools\TravisCiCancelJob;
use OpenCompany\Integrations\TravisCi\Tools\TravisCiCreateEnvVar;
use OpenCompany\Integrations\TravisCi\Tools\TravisCiCreateRequest;
use OpenCompany\Integrations\TravisCi\Tools\TravisCiDeactivateRepository;
use OpenCompany\Integrations\TravisCi\Tools\TravisCiDebugJob;
use OpenCompany\Integrations\TravisCi\Tools\TravisCiDeleteEnvVar;
use OpenCompany\Integrations\TravisCi\Tools\TravisCiGetBuild;
use OpenCompany\Integrations\TravisCi\Tools\TravisCiGetCurrentUser;
use OpenCompany\Integrations\TravisCi\Tools\TravisCiGetJob;
use OpenCompany\Integrations\TravisCi\Tools\TravisCiGetJobLog;
use OpenCompany\Integrations\TravisCi\Tools\TravisCiGetRepository;
use OpenCompany\Integrations\TravisCi\Tools\TravisCiListBuildJobs;
use OpenCompany\Integrations\TravisCi\Tools\TravisCiListBuilds;
use OpenCompany\Integrations\TravisCi\Tools\TravisCiListEnvVars;
use OpenCompany\Integrations\TravisCi\Tools\TravisCiListJobs;
use OpenCompany\Integrations\TravisCi\Tools\TravisCiListOwnerRepositories;
use OpenCompany\Integrations\TravisCi\Tools\TravisCiListRepositories;
use OpenCompany\Integrations\TravisCi\Tools\TravisCiListRepositoryBuilds;
use OpenCompany\Integrations\TravisCi\Tools\TravisCiListRequests;
use OpenCompany\Integrations\TravisCi\Tools\TravisCiListSettings;
use OpenCompany\Integrations\TravisCi\Tools\TravisCiRestartBuild;
use OpenCompany\Integrations\TravisCi\Tools\TravisCiRestartJob;
use OpenCompany\Integrations\TravisCi\Tools\TravisCiUpdateSetting;

/**
 * Tool catalog and configuration metadata for Travis CI.
 *
 * Exposes Travis CI API V3 operations for repositories, builds, jobs, logs,
 * requests, settings, environment variables, and safe raw relative API calls.
 */
class TravisCiToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'strategy' => 'api_token',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'required_secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['api_token'],
                'notes' => ['Travis CI API V3 uses Authorization: token <token> and Travis-API-Version: 3.'],
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
        return 'travis-ci';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Travis CI',
            'description' => 'Hosted CI repositories, builds, jobs, logs, requests, and settings',
            'icon' => 'ph:terminal-window',
            'logo' => 'ph:terminal-window',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Travis CI',
            'description' => 'Manage Travis CI repositories, builds, jobs, logs, requests, settings, and environment variables through API V3.',
            'icon' => 'ph:terminal-window',
            'logo' => 'ph:terminal-window',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.travis-ci.com/',
        ];
    }

    public function configSchema(): array
    {
        return $this->credentialFields();
    }

    /**
     * Verify Travis CI credentials with the current-user endpoint.
     *
     * @param  array<string, mixed>  $config  Credential settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        try {
            $token = (string) ($config['api_token'] ?? '');
            $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.travis-ci.com'), '/');
            if ($token === '') {
                return ['success' => false, 'error' => 'Travis CI API token is required.'];
            }

            $response = Http::withHeaders([
                'Authorization' => 'token '.$token,
                'Travis-API-Version' => '3',
                'Accept' => 'application/json',
            ])->timeout(20)->get($baseUrl.'/user');

            if (!$response->successful()) {
                return ['success' => false, 'error' => 'Travis CI API returned HTTP '.$response->status().'.'];
            }

            $name = (string) ($response->json('name') ?? $response->json('login') ?? 'current user');

            return ['success' => true, 'message' => "Connected to Travis CI as {$name}."];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['api_token' => 'required|string', 'url' => 'nullable|string'];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'placeholder' => 'travis-token', 'hint' => 'Travis CI API token with permissions for the tools you want to use.', 'required' => true],
            ['key' => 'url', 'type' => 'text', 'label' => 'API URL', 'default' => 'https://api.travis-ci.com', 'hint' => 'Override only for Travis Enterprise or compatible API V3 hosts.', 'required' => false],
        ];
    }

    public function tools(): array
    {
        return [
            'travis_ci_get_current_user' => ['class' => TravisCiGetCurrentUser::class, 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Get authenticated Travis CI user details.', 'icon' => 'ph:user'],
            'travis_ci_list_repositories' => ['class' => TravisCiListRepositories::class, 'type' => 'read', 'name' => 'List Repositories', 'description' => 'List repositories visible to the current user.', 'icon' => 'ph:git-branch'],
            'travis_ci_list_owner_repositories' => ['class' => TravisCiListOwnerRepositories::class, 'type' => 'read', 'name' => 'List Owner Repositories', 'description' => 'List repositories for an owner.', 'icon' => 'ph:buildings'],
            'travis_ci_get_repository' => ['class' => TravisCiGetRepository::class, 'type' => 'read', 'name' => 'Get Repository', 'description' => 'Get a repository by id or slug.', 'icon' => 'ph:git-branch'],
            'travis_ci_activate_repository' => ['class' => TravisCiActivateRepository::class, 'type' => 'write', 'name' => 'Activate Repository', 'description' => 'Activate a repository.', 'icon' => 'ph:power'],
            'travis_ci_deactivate_repository' => ['class' => TravisCiDeactivateRepository::class, 'type' => 'write', 'name' => 'Deactivate Repository', 'description' => 'Deactivate a repository.', 'icon' => 'ph:power'],
            'travis_ci_list_builds' => ['class' => TravisCiListBuilds::class, 'type' => 'read', 'name' => 'List Builds', 'description' => 'List builds visible to the current user.', 'icon' => 'ph:list-checks'],
            'travis_ci_list_repository_builds' => ['class' => TravisCiListRepositoryBuilds::class, 'type' => 'read', 'name' => 'List Repository Builds', 'description' => 'List builds for a repository.', 'icon' => 'ph:list-checks'],
            'travis_ci_get_build' => ['class' => TravisCiGetBuild::class, 'type' => 'read', 'name' => 'Get Build', 'description' => 'Get one build by id.', 'icon' => 'ph:check-circle'],
            'travis_ci_cancel_build' => ['class' => TravisCiCancelBuild::class, 'type' => 'write', 'name' => 'Cancel Build', 'description' => 'Cancel a running build.', 'icon' => 'ph:x-circle'],
            'travis_ci_restart_build' => ['class' => TravisCiRestartBuild::class, 'type' => 'write', 'name' => 'Restart Build', 'description' => 'Restart a completed or canceled build.', 'icon' => 'ph:arrow-clockwise'],
            'travis_ci_list_jobs' => ['class' => TravisCiListJobs::class, 'type' => 'read', 'name' => 'List Jobs', 'description' => 'List jobs visible to the current user.', 'icon' => 'ph:list-checks'],
            'travis_ci_list_build_jobs' => ['class' => TravisCiListBuildJobs::class, 'type' => 'read', 'name' => 'List Build Jobs', 'description' => 'List jobs for one build.', 'icon' => 'ph:list-checks'],
            'travis_ci_get_job' => ['class' => TravisCiGetJob::class, 'type' => 'read', 'name' => 'Get Job', 'description' => 'Get one job by id.', 'icon' => 'ph:check'],
            'travis_ci_cancel_job' => ['class' => TravisCiCancelJob::class, 'type' => 'write', 'name' => 'Cancel Job', 'description' => 'Cancel a running job.', 'icon' => 'ph:x-circle'],
            'travis_ci_restart_job' => ['class' => TravisCiRestartJob::class, 'type' => 'write', 'name' => 'Restart Job', 'description' => 'Restart a completed or canceled job.', 'icon' => 'ph:arrow-clockwise'],
            'travis_ci_debug_job' => ['class' => TravisCiDebugJob::class, 'type' => 'write', 'name' => 'Debug Job', 'description' => 'Restart a job in debug mode.', 'icon' => 'ph:bug'],
            'travis_ci_get_job_log' => ['class' => TravisCiGetJobLog::class, 'type' => 'read', 'name' => 'Get Job Log', 'description' => 'Get a job log as JSON or plain text.', 'icon' => 'ph:file-text'],
            'travis_ci_list_requests' => ['class' => TravisCiListRequests::class, 'type' => 'read', 'name' => 'List Requests', 'description' => 'List repository build requests.', 'icon' => 'ph:paper-plane'],
            'travis_ci_create_request' => ['class' => TravisCiCreateRequest::class, 'type' => 'write', 'name' => 'Create Request', 'description' => 'Trigger a repository build request.', 'icon' => 'ph:play'],
            'travis_ci_list_settings' => ['class' => TravisCiListSettings::class, 'type' => 'read', 'name' => 'List Settings', 'description' => 'List repository settings.', 'icon' => 'ph:gear'],
            'travis_ci_update_setting' => ['class' => TravisCiUpdateSetting::class, 'type' => 'write', 'name' => 'Update Setting', 'description' => 'Update one repository setting.', 'icon' => 'ph:pencil'],
            'travis_ci_list_env_vars' => ['class' => TravisCiListEnvVars::class, 'type' => 'read', 'name' => 'List Env Vars', 'description' => 'List repository environment variables.', 'icon' => 'ph:key'],
            'travis_ci_create_env_var' => ['class' => TravisCiCreateEnvVar::class, 'type' => 'write', 'name' => 'Create Env Var', 'description' => 'Create a repository environment variable.', 'icon' => 'ph:key'],
            'travis_ci_delete_env_var' => ['class' => TravisCiDeleteEnvVar::class, 'type' => 'write', 'name' => 'Delete Env Var', 'description' => 'Delete a repository environment variable.', 'icon' => 'ph:trash'],
            'travis_ci_api_get' => ['class' => TravisCiApiGet::class, 'type' => 'read', 'name' => 'API GET', 'description' => 'Call a safe relative Travis CI GET path.', 'icon' => 'ph:code'],
            'travis_ci_api_post' => ['class' => TravisCiApiPost::class, 'type' => 'write', 'name' => 'API POST', 'description' => 'Call a safe relative Travis CI POST path.', 'icon' => 'ph:code'],
            'travis_ci_api_patch' => ['class' => TravisCiApiPatch::class, 'type' => 'write', 'name' => 'API PATCH', 'description' => 'Call a safe relative Travis CI PATCH path.', 'icon' => 'ph:code'],
            'travis_ci_api_delete' => ['class' => TravisCiApiDelete::class, 'type' => 'write', 'name' => 'API DELETE', 'description' => 'Call a safe relative Travis CI DELETE path.', 'icon' => 'ph:code'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a Travis CI tool instance.
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
    private function resolveService(array $context = []): TravisCiService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new TravisCiService(
                apiToken: $creds->get('travis-ci', 'api_token', '', $account),
                baseUrl: $creds->get('travis-ci', 'url', 'https://api.travis-ci.com', $account),
            );
        }

        return app(TravisCiService::class);
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/travis-ci.md';
    }
}
