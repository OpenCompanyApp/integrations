<?php

namespace OpenCompany\Integrations\Buildkite;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Buildkite\Tools\BuildkiteApiDelete;
use OpenCompany\Integrations\Buildkite\Tools\BuildkiteApiGet;
use OpenCompany\Integrations\Buildkite\Tools\BuildkiteApiPatch;
use OpenCompany\Integrations\Buildkite\Tools\BuildkiteApiPost;
use OpenCompany\Integrations\Buildkite\Tools\BuildkiteApiPut;
use OpenCompany\Integrations\Buildkite\Tools\BuildkiteArchivePipeline;
use OpenCompany\Integrations\Buildkite\Tools\BuildkiteCancelBuild;
use OpenCompany\Integrations\Buildkite\Tools\BuildkiteCreateBuild;
use OpenCompany\Integrations\Buildkite\Tools\BuildkiteCreatePipeline;
use OpenCompany\Integrations\Buildkite\Tools\BuildkiteGetBuild;
use OpenCompany\Integrations\Buildkite\Tools\BuildkiteGetCurrentUser;
use OpenCompany\Integrations\Buildkite\Tools\BuildkiteGetJobEnvironment;
use OpenCompany\Integrations\Buildkite\Tools\BuildkiteGetJobLog;
use OpenCompany\Integrations\Buildkite\Tools\BuildkiteGetOrganization;
use OpenCompany\Integrations\Buildkite\Tools\BuildkiteGetPipeline;
use OpenCompany\Integrations\Buildkite\Tools\BuildkiteListBuilds;
use OpenCompany\Integrations\Buildkite\Tools\BuildkiteListOrganizations;
use OpenCompany\Integrations\Buildkite\Tools\BuildkiteListPipelines;
use OpenCompany\Integrations\Buildkite\Tools\BuildkiteRebuildBuild;
use OpenCompany\Integrations\Buildkite\Tools\BuildkiteRetryFailedJobs;
use OpenCompany\Integrations\Buildkite\Tools\BuildkiteUnarchivePipeline;
use OpenCompany\Integrations\Buildkite\Tools\BuildkiteUpdatePipeline;

/**
 * Tool catalog and configuration metadata for Buildkite.
 *
 * Exposes core Buildkite REST API v2 operations for organizations, pipelines,
 * builds, job diagnostics, and safe raw relative API calls.
 */
class BuildkiteToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => ['Buildkite REST API v2 uses Authorization: Bearer <token>.'],
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
        return 'buildkite';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Buildkite',
            'description' => 'CI/CD organizations, pipelines, builds, and job diagnostics',
            'icon' => 'ph:terminal-window',
            'logo' => 'ph:terminal-window',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Buildkite',
            'description' => 'Manage Buildkite organizations, pipelines, builds, failed-job retries, rebuilds, and job logs through the REST API v2.',
            'icon' => 'ph:terminal-window',
            'logo' => 'ph:terminal-window',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://buildkite.com/docs/apis/rest-api',
        ];
    }

    public function configSchema(): array
    {
        return $this->credentialFields();
    }

    /**
     * Verify Buildkite credentials with the lightweight current-user endpoint.
     *
     * @param  array<string, mixed>  $config  Credential settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        try {
            $token = (string) ($config['access_token'] ?? '');
            $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.buildkite.com/v2'), '/');
            if ($token === '') {
                return ['success' => false, 'error' => 'Buildkite access token is required.'];
            }

            $response = Http::withHeaders(['Authorization' => 'Bearer '.$token, 'Accept' => 'application/json'])
                ->timeout(20)
                ->get($baseUrl.'/user');

            if (!$response->successful()) {
                return ['success' => false, 'error' => 'Buildkite API returned HTTP '.$response->status().'.'];
            }

            $name = (string) ($response->json('name') ?? $response->json('email') ?? 'current user');

            return ['success' => true, 'message' => "Connected to Buildkite as {$name}."];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['access_token' => 'required|string', 'url' => 'nullable|string'];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'bkua_...', 'hint' => 'Buildkite API access token with scopes for the tools you want to use.', 'required' => true],
            ['key' => 'url', 'type' => 'text', 'label' => 'API URL', 'default' => 'https://api.buildkite.com/v2', 'hint' => 'Override only for compatible Buildkite API hosts.', 'required' => false],
        ];
    }

    public function tools(): array
    {
        return [
            'buildkite_get_current_user' => ['class' => BuildkiteGetCurrentUser::class, 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Get authenticated Buildkite user details.', 'icon' => 'ph:user'],
            'buildkite_list_organizations' => ['class' => BuildkiteListOrganizations::class, 'type' => 'read', 'name' => 'List Organizations', 'description' => 'List organizations accessible to the token.', 'icon' => 'ph:buildings'],
            'buildkite_get_organization' => ['class' => BuildkiteGetOrganization::class, 'type' => 'read', 'name' => 'Get Organization', 'description' => 'Get one organization by slug.', 'icon' => 'ph:building'],
            'buildkite_list_pipelines' => ['class' => BuildkiteListPipelines::class, 'type' => 'read', 'name' => 'List Pipelines', 'description' => 'List pipelines in an organization.', 'icon' => 'ph:git-branch'],
            'buildkite_get_pipeline' => ['class' => BuildkiteGetPipeline::class, 'type' => 'read', 'name' => 'Get Pipeline', 'description' => 'Get one pipeline by slug.', 'icon' => 'ph:git-branch'],
            'buildkite_create_pipeline' => ['class' => BuildkiteCreatePipeline::class, 'type' => 'write', 'name' => 'Create Pipeline', 'description' => 'Create a Buildkite pipeline.', 'icon' => 'ph:plus-circle'],
            'buildkite_update_pipeline' => ['class' => BuildkiteUpdatePipeline::class, 'type' => 'write', 'name' => 'Update Pipeline', 'description' => 'Update a Buildkite pipeline.', 'icon' => 'ph:pencil'],
            'buildkite_archive_pipeline' => ['class' => BuildkiteArchivePipeline::class, 'type' => 'write', 'name' => 'Archive Pipeline', 'description' => 'Archive a pipeline.', 'icon' => 'ph:archive'],
            'buildkite_unarchive_pipeline' => ['class' => BuildkiteUnarchivePipeline::class, 'type' => 'write', 'name' => 'Unarchive Pipeline', 'description' => 'Unarchive a pipeline.', 'icon' => 'ph:archive-box'],
            'buildkite_list_builds' => ['class' => BuildkiteListBuilds::class, 'type' => 'read', 'name' => 'List Builds', 'description' => 'List builds for a pipeline.', 'icon' => 'ph:list-checks'],
            'buildkite_get_build' => ['class' => BuildkiteGetBuild::class, 'type' => 'read', 'name' => 'Get Build', 'description' => 'Get one build by number.', 'icon' => 'ph:check-circle'],
            'buildkite_create_build' => ['class' => BuildkiteCreateBuild::class, 'type' => 'write', 'name' => 'Create Build', 'description' => 'Trigger a new build.', 'icon' => 'ph:play'],
            'buildkite_cancel_build' => ['class' => BuildkiteCancelBuild::class, 'type' => 'write', 'name' => 'Cancel Build', 'description' => 'Cancel a build.', 'icon' => 'ph:x-circle'],
            'buildkite_rebuild_build' => ['class' => BuildkiteRebuildBuild::class, 'type' => 'write', 'name' => 'Rebuild Build', 'description' => 'Rebuild a build by number.', 'icon' => 'ph:arrow-clockwise'],
            'buildkite_retry_failed_jobs' => ['class' => BuildkiteRetryFailedJobs::class, 'type' => 'write', 'name' => 'Retry Failed Jobs', 'description' => 'Retry failed jobs for a build.', 'icon' => 'ph:arrows-clockwise'],
            'buildkite_get_job_log' => ['class' => BuildkiteGetJobLog::class, 'type' => 'read', 'name' => 'Get Job Log', 'description' => 'Get log output for a build job.', 'icon' => 'ph:file-text'],
            'buildkite_get_job_environment' => ['class' => BuildkiteGetJobEnvironment::class, 'type' => 'read', 'name' => 'Get Job Environment', 'description' => 'Get environment variables for a build job.', 'icon' => 'ph:list-dashes'],
            'buildkite_api_get' => ['class' => BuildkiteApiGet::class, 'type' => 'read', 'name' => 'API GET', 'description' => 'Call a safe relative Buildkite GET path.', 'icon' => 'ph:code'],
            'buildkite_api_post' => ['class' => BuildkiteApiPost::class, 'type' => 'write', 'name' => 'API POST', 'description' => 'Call a safe relative Buildkite POST path.', 'icon' => 'ph:code'],
            'buildkite_api_put' => ['class' => BuildkiteApiPut::class, 'type' => 'write', 'name' => 'API PUT', 'description' => 'Call a safe relative Buildkite PUT path.', 'icon' => 'ph:code'],
            'buildkite_api_patch' => ['class' => BuildkiteApiPatch::class, 'type' => 'write', 'name' => 'API PATCH', 'description' => 'Call a safe relative Buildkite PATCH path.', 'icon' => 'ph:code'],
            'buildkite_api_delete' => ['class' => BuildkiteApiDelete::class, 'type' => 'write', 'name' => 'API DELETE', 'description' => 'Call a safe relative Buildkite DELETE path.', 'icon' => 'ph:code'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a Buildkite tool instance.
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
    private function resolveService(array $context = []): BuildkiteService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new BuildkiteService(
                accessToken: $creds->get('buildkite', 'access_token', '', $account),
                baseUrl: $creds->get('buildkite', 'url', 'https://api.buildkite.com/v2', $account),
            );
        }

        return app(BuildkiteService::class);
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/buildkite.md';
    }
}
