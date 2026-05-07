<?php

namespace OpenCompany\Integrations\DroneCi;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiApiDelete;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiApiGet;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiApiPatch;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiApiPost;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiApproveBuild;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiChownRepo;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiCreateBuild;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiCreateCron;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiCreateSecret;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiDeclineBuild;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiDeleteCron;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiDeleteSecret;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiDisableRepo;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiEnableRepo;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiGetBuild;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiGetBuildLogs;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiGetCron;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiGetCurrentUser;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiGetCurrentUserFeed;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiGetRepo;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiGetSecret;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiGetUser;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiListBuilds;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiListCron;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiListCurrentUserRepos;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiListSecrets;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiListUsers;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiPromoteBuild;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiRepairRepo;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiRestartBuild;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiStopBuild;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiSyncCurrentUser;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiTriggerCron;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiUpdateCron;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiUpdateRepo;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiUpdateSecret;

/**
 * Tool catalog and configuration metadata for Drone CI.
 *
 * Exposes the Drone remote API for users, repositories, builds, cron jobs,
 * secrets, admin users, and safe raw relative API calls.
 */
class DroneCiToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => ['Drone remote API uses Authorization: Bearer <token>.'],
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
        return 'drone-ci';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Drone CI',
            'description' => 'Self-hosted CI repositories, builds, cron jobs, secrets, and users',
            'icon' => 'ph:terminal-window',
            'logo' => 'ph:terminal-window',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Drone CI',
            'description' => 'Manage Drone users, repositories, builds, cron jobs, secrets, and raw API calls.',
            'icon' => 'ph:terminal-window',
            'logo' => 'ph:terminal-window',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.drone.io/api/overview',
        ];
    }

    public function configSchema(): array
    {
        return $this->credentialFields();
    }

    /**
     * Verify Drone credentials with the current-user endpoint.
     *
     * @param  array<string, mixed>  $config  Credential settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        try {
            $token = (string) ($config['access_token'] ?? '');
            $baseUrl = rtrim((string) ($config['url'] ?? ''), '/');
            if ($token === '' || $baseUrl === '') {
                return ['success' => false, 'error' => 'Drone CI URL and access token are required.'];
            }

            $response = Http::withHeaders(['Authorization' => 'Bearer '.$token, 'Accept' => 'application/json'])
                ->timeout(20)
                ->get($baseUrl.'/api/user');

            if (!$response->successful()) {
                return ['success' => false, 'error' => 'Drone CI API returned HTTP '.$response->status().'.'];
            }

            $login = (string) ($response->json('login') ?? 'current user');

            return ['success' => true, 'message' => "Connected to Drone CI as {$login}."];
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
            ['key' => 'url', 'type' => 'text', 'label' => 'Drone URL', 'placeholder' => 'https://drone.example.test', 'hint' => 'Drone server base URL.', 'required' => true],
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'drone-token', 'hint' => 'Drone access token from the user profile.', 'required' => true],
        ];
    }

    public function tools(): array
    {
        return [
            'drone_ci_get_current_user' => ['class' => DroneCiGetCurrentUser::class, 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Get authenticated Drone user.', 'icon' => 'ph:user'],
            'drone_ci_get_current_user_feed' => ['class' => DroneCiGetCurrentUserFeed::class, 'type' => 'read', 'name' => 'Get Current User Feed', 'description' => 'Get current user activity feed.', 'icon' => 'ph:rss'],
            'drone_ci_list_current_user_repos' => ['class' => DroneCiListCurrentUserRepos::class, 'type' => 'read', 'name' => 'List Current User Repos', 'description' => 'List repositories registered to the user.', 'icon' => 'ph:git-branch'],
            'drone_ci_sync_current_user' => ['class' => DroneCiSyncCurrentUser::class, 'type' => 'write', 'name' => 'Sync Current User', 'description' => 'Sync user repositories from source control.', 'icon' => 'ph:arrows-clockwise'],
            'drone_ci_get_repo' => ['class' => DroneCiGetRepo::class, 'type' => 'read', 'name' => 'Get Repo', 'description' => 'Get repository details.', 'icon' => 'ph:git-branch'],
            'drone_ci_enable_repo' => ['class' => DroneCiEnableRepo::class, 'type' => 'write', 'name' => 'Enable Repo', 'description' => 'Enable a repository in Drone.', 'icon' => 'ph:power'],
            'drone_ci_update_repo' => ['class' => DroneCiUpdateRepo::class, 'type' => 'write', 'name' => 'Update Repo', 'description' => 'Update repository settings.', 'icon' => 'ph:pencil'],
            'drone_ci_disable_repo' => ['class' => DroneCiDisableRepo::class, 'type' => 'write', 'name' => 'Disable Repo', 'description' => 'Disable a repository in Drone.', 'icon' => 'ph:power'],
            'drone_ci_repair_repo' => ['class' => DroneCiRepairRepo::class, 'type' => 'write', 'name' => 'Repair Repo', 'description' => 'Repair repository webhooks.', 'icon' => 'ph:wrench'],
            'drone_ci_chown_repo' => ['class' => DroneCiChownRepo::class, 'type' => 'write', 'name' => 'Chown Repo', 'description' => 'Change repository ownership.', 'icon' => 'ph:user-switch'],
            'drone_ci_list_builds' => ['class' => DroneCiListBuilds::class, 'type' => 'read', 'name' => 'List Builds', 'description' => 'List repository builds.', 'icon' => 'ph:list-checks'],
            'drone_ci_create_build' => ['class' => DroneCiCreateBuild::class, 'type' => 'write', 'name' => 'Create Build', 'description' => 'Create a custom build.', 'icon' => 'ph:play'],
            'drone_ci_get_build' => ['class' => DroneCiGetBuild::class, 'type' => 'read', 'name' => 'Get Build', 'description' => 'Get one build.', 'icon' => 'ph:check-circle'],
            'drone_ci_restart_build' => ['class' => DroneCiRestartBuild::class, 'type' => 'write', 'name' => 'Restart Build', 'description' => 'Restart a build.', 'icon' => 'ph:arrow-clockwise'],
            'drone_ci_stop_build' => ['class' => DroneCiStopBuild::class, 'type' => 'write', 'name' => 'Stop Build', 'description' => 'Stop a build.', 'icon' => 'ph:x-circle'],
            'drone_ci_approve_build' => ['class' => DroneCiApproveBuild::class, 'type' => 'write', 'name' => 'Approve Build', 'description' => 'Approve a blocked build.', 'icon' => 'ph:check'],
            'drone_ci_decline_build' => ['class' => DroneCiDeclineBuild::class, 'type' => 'write', 'name' => 'Decline Build', 'description' => 'Decline a blocked build.', 'icon' => 'ph:x'],
            'drone_ci_promote_build' => ['class' => DroneCiPromoteBuild::class, 'type' => 'write', 'name' => 'Promote Build', 'description' => 'Promote a build.', 'icon' => 'ph:rocket-launch'],
            'drone_ci_get_build_logs' => ['class' => DroneCiGetBuildLogs::class, 'type' => 'read', 'name' => 'Get Build Logs', 'description' => 'Get build logs for a stage and step.', 'icon' => 'ph:file-text'],
            'drone_ci_list_cron' => ['class' => DroneCiListCron::class, 'type' => 'read', 'name' => 'List Cron', 'description' => 'List repository cron jobs.', 'icon' => 'ph:clock'],
            'drone_ci_create_cron' => ['class' => DroneCiCreateCron::class, 'type' => 'write', 'name' => 'Create Cron', 'description' => 'Create a repository cron job.', 'icon' => 'ph:plus-circle'],
            'drone_ci_get_cron' => ['class' => DroneCiGetCron::class, 'type' => 'read', 'name' => 'Get Cron', 'description' => 'Get one cron job.', 'icon' => 'ph:clock'],
            'drone_ci_update_cron' => ['class' => DroneCiUpdateCron::class, 'type' => 'write', 'name' => 'Update Cron', 'description' => 'Update one cron job.', 'icon' => 'ph:pencil'],
            'drone_ci_delete_cron' => ['class' => DroneCiDeleteCron::class, 'type' => 'write', 'name' => 'Delete Cron', 'description' => 'Delete one cron job.', 'icon' => 'ph:trash'],
            'drone_ci_trigger_cron' => ['class' => DroneCiTriggerCron::class, 'type' => 'write', 'name' => 'Trigger Cron', 'description' => 'Trigger one cron job.', 'icon' => 'ph:play-circle'],
            'drone_ci_list_secrets' => ['class' => DroneCiListSecrets::class, 'type' => 'read', 'name' => 'List Secrets', 'description' => 'List repository secrets.', 'icon' => 'ph:key'],
            'drone_ci_create_secret' => ['class' => DroneCiCreateSecret::class, 'type' => 'write', 'name' => 'Create Secret', 'description' => 'Create repository secret.', 'icon' => 'ph:key'],
            'drone_ci_get_secret' => ['class' => DroneCiGetSecret::class, 'type' => 'read', 'name' => 'Get Secret', 'description' => 'Get repository secret metadata.', 'icon' => 'ph:key'],
            'drone_ci_update_secret' => ['class' => DroneCiUpdateSecret::class, 'type' => 'write', 'name' => 'Update Secret', 'description' => 'Update repository secret.', 'icon' => 'ph:pencil'],
            'drone_ci_delete_secret' => ['class' => DroneCiDeleteSecret::class, 'type' => 'write', 'name' => 'Delete Secret', 'description' => 'Delete repository secret.', 'icon' => 'ph:trash'],
            'drone_ci_list_users' => ['class' => DroneCiListUsers::class, 'type' => 'read', 'name' => 'List Users', 'description' => 'List Drone users.', 'icon' => 'ph:users'],
            'drone_ci_get_user' => ['class' => DroneCiGetUser::class, 'type' => 'read', 'name' => 'Get User', 'description' => 'Get one Drone user.', 'icon' => 'ph:user'],
            'drone_ci_api_get' => ['class' => DroneCiApiGet::class, 'type' => 'read', 'name' => 'API GET', 'description' => 'Call a safe relative Drone GET path.', 'icon' => 'ph:code'],
            'drone_ci_api_post' => ['class' => DroneCiApiPost::class, 'type' => 'write', 'name' => 'API POST', 'description' => 'Call a safe relative Drone POST path.', 'icon' => 'ph:code'],
            'drone_ci_api_patch' => ['class' => DroneCiApiPatch::class, 'type' => 'write', 'name' => 'API PATCH', 'description' => 'Call a safe relative Drone PATCH path.', 'icon' => 'ph:code'],
            'drone_ci_api_delete' => ['class' => DroneCiApiDelete::class, 'type' => 'write', 'name' => 'API DELETE', 'description' => 'Call a safe relative Drone DELETE path.', 'icon' => 'ph:code'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a Drone tool instance.
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
    private function resolveService(array $context = []): DroneCiService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new DroneCiService(
                accessToken: $creds->get('drone-ci', 'access_token', '', $account),
                baseUrl: $creds->get('drone-ci', 'url', '', $account),
            );
        }

        return app(DroneCiService::class);
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/drone-ci.md';
    }
}
