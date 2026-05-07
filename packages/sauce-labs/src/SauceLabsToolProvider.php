<?php

namespace OpenCompany\Integrations\SauceLabs;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\SauceLabs\Tools\SauceLabsApiDelete;
use OpenCompany\Integrations\SauceLabs\Tools\SauceLabsApiGet;
use OpenCompany\Integrations\SauceLabs\Tools\SauceLabsApiPut;
use OpenCompany\Integrations\SauceLabs\Tools\SauceLabsDeleteJob;
use OpenCompany\Integrations\SauceLabs\Tools\SauceLabsDeleteRdcJob;
use OpenCompany\Integrations\SauceLabs\Tools\SauceLabsGetBuild;
use OpenCompany\Integrations\SauceLabs\Tools\SauceLabsGetJob;
use OpenCompany\Integrations\SauceLabs\Tools\SauceLabsGetJobAsset;
use OpenCompany\Integrations\SauceLabs\Tools\SauceLabsGetJobBuild;
use OpenCompany\Integrations\SauceLabs\Tools\SauceLabsGetRdcJob;
use OpenCompany\Integrations\SauceLabs\Tools\SauceLabsGetRdcJobAsset;
use OpenCompany\Integrations\SauceLabs\Tools\SauceLabsGetStatus;
use OpenCompany\Integrations\SauceLabs\Tools\SauceLabsGetTunnel;
use OpenCompany\Integrations\SauceLabs\Tools\SauceLabsGetTunnelJobsCount;
use OpenCompany\Integrations\SauceLabs\Tools\SauceLabsListBuildJobs;
use OpenCompany\Integrations\SauceLabs\Tools\SauceLabsListBuilds;
use OpenCompany\Integrations\SauceLabs\Tools\SauceLabsListJobAssets;
use OpenCompany\Integrations\SauceLabs\Tools\SauceLabsListJobs;
use OpenCompany\Integrations\SauceLabs\Tools\SauceLabsListPlatforms;
use OpenCompany\Integrations\SauceLabs\Tools\SauceLabsListPrivateDevices;
use OpenCompany\Integrations\SauceLabs\Tools\SauceLabsListRdcJobs;
use OpenCompany\Integrations\SauceLabs\Tools\SauceLabsListTunnels;
use OpenCompany\Integrations\SauceLabs\Tools\SauceLabsStopJob;
use OpenCompany\Integrations\SauceLabs\Tools\SauceLabsStopRdcJob;
use OpenCompany\Integrations\SauceLabs\Tools\SauceLabsStopTunnel;
use OpenCompany\Integrations\SauceLabs\Tools\SauceLabsUpdateJob;

/**
 * Tool catalog and configuration metadata for Sauce Labs.
 *
 * Exposes Sauce Labs REST APIs for platform status, jobs, builds, real device
 * jobs, private devices, tunnels, and safe raw relative API calls.
 */
class SauceLabsToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'strategy' => 'basic_auth',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'required_secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['username', 'access_key'],
                'notes' => ['Sauce Labs REST APIs use HTTP Basic authentication with username and access key.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string { return 'sauce-labs'; }

    public function appMeta(): array
    {
        return ['label' => 'Sauce Labs', 'description' => 'Continuous testing jobs, builds, real devices, and tunnels', 'icon' => 'ph:flask', 'logo' => 'ph:flask'];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Sauce Labs',
            'description' => 'Manage Sauce Labs platform status, VDC jobs, builds, RDC jobs, devices, tunnels, and raw API calls.',
            'icon' => 'ph:flask',
            'logo' => 'ph:flask',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.saucelabs.com/dev/api/',
        ];
    }

    public function configSchema(): array { return $this->credentialFields(); }

    /**
     * Verify Sauce Labs credentials with the platform status endpoint.
     *
     * @param  array<string, mixed>  $config  Credential settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        try {
            $username = (string) ($config['username'] ?? '');
            $accessKey = (string) ($config['access_key'] ?? '');
            if ($username === '' || $accessKey === '') {
                return ['success' => false, 'error' => 'Sauce Labs username and access key are required.'];
            }

            $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.us-west-1.saucelabs.com'), '/');
            $response = Http::withBasicAuth($username, $accessKey)
                ->timeout(20)
                ->get($baseUrl.'/rest/v1/info/status');

            if (!$response->successful()) {
                return ['success' => false, 'error' => 'Sauce Labs API returned HTTP '.$response->status().'.'];
            }

            return ['success' => true, 'message' => 'Connected to Sauce Labs API.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['username' => 'required|string', 'access_key' => 'required|string', 'url' => 'nullable|string'];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'username', 'type' => 'text', 'label' => 'Username', 'placeholder' => 'sauce-user', 'hint' => 'Sauce Labs username or service account username.', 'required' => true],
            ['key' => 'access_key', 'type' => 'secret', 'label' => 'Access Key', 'placeholder' => 'sauce-access-key', 'hint' => 'Sauce Labs access key.', 'required' => true],
            ['key' => 'url', 'type' => 'text', 'label' => 'API URL', 'placeholder' => 'https://api.us-west-1.saucelabs.com', 'hint' => 'Sauce Labs regional API base URL.', 'required' => false],
        ];
    }

    public function tools(): array
    {
        return [
            'sauce_labs_get_status' => ['class' => SauceLabsGetStatus::class, 'type' => 'read', 'name' => 'Get Status', 'description' => 'Get Sauce Labs platform status.', 'icon' => 'ph:heartbeat'],
            'sauce_labs_list_platforms' => ['class' => SauceLabsListPlatforms::class, 'type' => 'read', 'name' => 'List Platforms', 'description' => 'List supported Sauce Labs platforms.', 'icon' => 'ph:desktop'],
            'sauce_labs_list_jobs' => ['class' => SauceLabsListJobs::class, 'type' => 'read', 'name' => 'List Jobs', 'description' => 'List VDC jobs for a user.', 'icon' => 'ph:list-checks'],
            'sauce_labs_get_job' => ['class' => SauceLabsGetJob::class, 'type' => 'read', 'name' => 'Get Job', 'description' => 'Get one VDC job.', 'icon' => 'ph:check-circle'],
            'sauce_labs_update_job' => ['class' => SauceLabsUpdateJob::class, 'type' => 'write', 'name' => 'Update Job', 'description' => 'Update one VDC job.', 'icon' => 'ph:pencil'],
            'sauce_labs_stop_job' => ['class' => SauceLabsStopJob::class, 'type' => 'write', 'name' => 'Stop Job', 'description' => 'Stop one VDC job.', 'icon' => 'ph:x-circle'],
            'sauce_labs_delete_job' => ['class' => SauceLabsDeleteJob::class, 'type' => 'write', 'name' => 'Delete Job', 'description' => 'Delete one VDC job.', 'icon' => 'ph:trash'],
            'sauce_labs_list_job_assets' => ['class' => SauceLabsListJobAssets::class, 'type' => 'read', 'name' => 'List Job Assets', 'description' => 'List assets for one VDC job.', 'icon' => 'ph:package'],
            'sauce_labs_get_job_asset' => ['class' => SauceLabsGetJobAsset::class, 'type' => 'read', 'name' => 'Get Job Asset', 'description' => 'Get one VDC job asset file.', 'icon' => 'ph:file'],
            'sauce_labs_list_builds' => ['class' => SauceLabsListBuilds::class, 'type' => 'read', 'name' => 'List Builds', 'description' => 'List v2 builds by source.', 'icon' => 'ph:list-checks'],
            'sauce_labs_get_build' => ['class' => SauceLabsGetBuild::class, 'type' => 'read', 'name' => 'Get Build', 'description' => 'Get one v2 build.', 'icon' => 'ph:check-circle'],
            'sauce_labs_get_job_build' => ['class' => SauceLabsGetJobBuild::class, 'type' => 'read', 'name' => 'Get Job Build', 'description' => 'Lookup the build for a known job.', 'icon' => 'ph:git-branch'],
            'sauce_labs_list_build_jobs' => ['class' => SauceLabsListBuildJobs::class, 'type' => 'read', 'name' => 'List Build Jobs', 'description' => 'List jobs in a v2 build.', 'icon' => 'ph:list-bullets'],
            'sauce_labs_list_rdc_jobs' => ['class' => SauceLabsListRdcJobs::class, 'type' => 'read', 'name' => 'List RDC Jobs', 'description' => 'List real device jobs.', 'icon' => 'ph:device-mobile'],
            'sauce_labs_get_rdc_job' => ['class' => SauceLabsGetRdcJob::class, 'type' => 'read', 'name' => 'Get RDC Job', 'description' => 'Get one real device job.', 'icon' => 'ph:device-mobile'],
            'sauce_labs_get_rdc_job_asset' => ['class' => SauceLabsGetRdcJobAsset::class, 'type' => 'read', 'name' => 'Get RDC Job Asset', 'description' => 'Download one real device job asset.', 'icon' => 'ph:file'],
            'sauce_labs_stop_rdc_job' => ['class' => SauceLabsStopRdcJob::class, 'type' => 'write', 'name' => 'Stop RDC Job', 'description' => 'Stop one real device job.', 'icon' => 'ph:x-circle'],
            'sauce_labs_delete_rdc_job' => ['class' => SauceLabsDeleteRdcJob::class, 'type' => 'write', 'name' => 'Delete RDC Job', 'description' => 'Delete one real device job.', 'icon' => 'ph:trash'],
            'sauce_labs_list_private_devices' => ['class' => SauceLabsListPrivateDevices::class, 'type' => 'read', 'name' => 'List Private Devices', 'description' => 'List private real devices.', 'icon' => 'ph:device-mobile-camera'],
            'sauce_labs_list_tunnels' => ['class' => SauceLabsListTunnels::class, 'type' => 'read', 'name' => 'List Tunnels', 'description' => 'List Sauce Connect tunnels.', 'icon' => 'ph:network'],
            'sauce_labs_get_tunnel' => ['class' => SauceLabsGetTunnel::class, 'type' => 'read', 'name' => 'Get Tunnel', 'description' => 'Get one Sauce Connect tunnel.', 'icon' => 'ph:network'],
            'sauce_labs_get_tunnel_jobs_count' => ['class' => SauceLabsGetTunnelJobsCount::class, 'type' => 'read', 'name' => 'Get Tunnel Jobs Count', 'description' => 'Get current running jobs for one tunnel.', 'icon' => 'ph:hash'],
            'sauce_labs_stop_tunnel' => ['class' => SauceLabsStopTunnel::class, 'type' => 'write', 'name' => 'Stop Tunnel', 'description' => 'Stop one Sauce Connect tunnel.', 'icon' => 'ph:stop-circle'],
            'sauce_labs_api_get' => ['class' => SauceLabsApiGet::class, 'type' => 'read', 'name' => 'API GET', 'description' => 'Call a safe relative Sauce Labs GET path.', 'icon' => 'ph:code'],
            'sauce_labs_api_put' => ['class' => SauceLabsApiPut::class, 'type' => 'write', 'name' => 'API PUT', 'description' => 'Call a safe relative Sauce Labs PUT path.', 'icon' => 'ph:code'],
            'sauce_labs_api_delete' => ['class' => SauceLabsApiDelete::class, 'type' => 'write', 'name' => 'API DELETE', 'description' => 'Call a safe relative Sauce Labs DELETE path.', 'icon' => 'ph:code'],
        ];
    }

    public function isIntegration(): bool { return true; }

    /**
     * Create a Sauce Labs tool instance.
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
    private function resolveService(array $context = []): SauceLabsService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new SauceLabsService(
                username: $creds->get('sauce-labs', 'username', '', $account),
                accessKey: $creds->get('sauce-labs', 'access_key', '', $account),
                baseUrl: $creds->get('sauce-labs', 'url', 'https://api.us-west-1.saucelabs.com', $account),
            );
        }

        return app(SauceLabsService::class);
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/sauce-labs.md';
    }
}
