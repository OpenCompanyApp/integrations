<?php

namespace OpenCompany\Integrations\BrowserStack;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\BrowserStack\Tools\BrowserStackApiDelete;
use OpenCompany\Integrations\BrowserStack\Tools\BrowserStackApiGet;
use OpenCompany\Integrations\BrowserStack\Tools\BrowserStackApiPost;
use OpenCompany\Integrations\BrowserStack\Tools\BrowserStackApiPut;
use OpenCompany\Integrations\BrowserStack\Tools\BrowserStackDeleteApp;
use OpenCompany\Integrations\BrowserStack\Tools\BrowserStackDeleteBuild;
use OpenCompany\Integrations\BrowserStack\Tools\BrowserStackDeleteBuilds;
use OpenCompany\Integrations\BrowserStack\Tools\BrowserStackDeleteProject;
use OpenCompany\Integrations\BrowserStack\Tools\BrowserStackDeleteSession;
use OpenCompany\Integrations\BrowserStack\Tools\BrowserStackGetPlan;
use OpenCompany\Integrations\BrowserStack\Tools\BrowserStackGetProject;
use OpenCompany\Integrations\BrowserStack\Tools\BrowserStackGetSession;
use OpenCompany\Integrations\BrowserStack\Tools\BrowserStackGetSessionLogs;
use OpenCompany\Integrations\BrowserStack\Tools\BrowserStackGetSessionNetworkLogs;
use OpenCompany\Integrations\BrowserStack\Tools\BrowserStackListBrowsers;
use OpenCompany\Integrations\BrowserStack\Tools\BrowserStackListBuildSessions;
use OpenCompany\Integrations\BrowserStack\Tools\BrowserStackListBuilds;
use OpenCompany\Integrations\BrowserStack\Tools\BrowserStackListProjects;
use OpenCompany\Integrations\BrowserStack\Tools\BrowserStackListRecentApps;
use OpenCompany\Integrations\BrowserStack\Tools\BrowserStackUpdateBuild;
use OpenCompany\Integrations\BrowserStack\Tools\BrowserStackUpdateProject;
use OpenCompany\Integrations\BrowserStack\Tools\BrowserStackUpdateSession;
use OpenCompany\Integrations\BrowserStack\Tools\BrowserStackUploadApp;

/**
 * Tool catalog and configuration metadata for BrowserStack.
 *
 * Exposes BrowserStack Automate and App Automate API operations for plan,
 * browsers, projects, builds, sessions, uploaded apps, and raw API calls.
 */
class BrowserStackToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => ['BrowserStack REST APIs use HTTP Basic authentication with username and access key.'],
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
        return 'browserstack';
    }

    public function appMeta(): array
    {
        return ['label' => 'BrowserStack', 'description' => 'Cross-browser and mobile app test cloud APIs', 'icon' => 'ph:browsers', 'logo' => 'ph:browsers'];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'BrowserStack',
            'description' => 'Manage BrowserStack Automate projects, builds, sessions, App Automate uploads, and raw API calls.',
            'icon' => 'ph:browsers',
            'logo' => 'ph:browsers',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://www.browserstack.com/docs/automate/api-reference/selenium/automate-api',
        ];
    }

    public function configSchema(): array
    {
        return $this->credentialFields();
    }

    /**
     * Verify BrowserStack credentials with the Automate plan endpoint.
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
                return ['success' => false, 'error' => 'BrowserStack username and access key are required.'];
            }

            $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.browserstack.com'), '/');
            $response = Http::withBasicAuth($username, $accessKey)
                ->timeout(20)
                ->get($baseUrl.'/automate/plan.json');

            if (!$response->successful()) {
                return ['success' => false, 'error' => 'BrowserStack API returned HTTP '.$response->status().'.'];
            }

            $plan = (string) ($response->json('automate_plan') ?? 'Automate');

            return ['success' => true, 'message' => "Connected to BrowserStack {$plan}."];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['username' => 'required|string', 'access_key' => 'required|string', 'url' => 'nullable|string', 'cloud_url' => 'nullable|string'];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'username', 'type' => 'text', 'label' => 'Username', 'placeholder' => 'browserstack-user', 'hint' => 'BrowserStack username.', 'required' => true],
            ['key' => 'access_key', 'type' => 'secret', 'label' => 'Access Key', 'placeholder' => 'browserstack-access-key', 'hint' => 'BrowserStack access key.', 'required' => true],
            ['key' => 'url', 'type' => 'text', 'label' => 'Automate API URL', 'placeholder' => 'https://api.browserstack.com', 'hint' => 'Optional Automate API base URL.', 'required' => false],
            ['key' => 'cloud_url', 'type' => 'text', 'label' => 'App Automate API URL', 'placeholder' => 'https://api-cloud.browserstack.com', 'hint' => 'Optional App Automate API base URL.', 'required' => false],
        ];
    }

    public function tools(): array
    {
        return [
            'browserstack_get_plan' => ['class' => BrowserStackGetPlan::class, 'type' => 'read', 'name' => 'Get Plan', 'description' => 'Get Automate plan and parallel session details.', 'icon' => 'ph:gauge'],
            'browserstack_list_browsers' => ['class' => BrowserStackListBrowsers::class, 'type' => 'read', 'name' => 'List Browsers', 'description' => 'List Automate browsers and devices.', 'icon' => 'ph:browsers'],
            'browserstack_list_projects' => ['class' => BrowserStackListProjects::class, 'type' => 'read', 'name' => 'List Projects', 'description' => 'List Automate projects.', 'icon' => 'ph:folder'],
            'browserstack_get_project' => ['class' => BrowserStackGetProject::class, 'type' => 'read', 'name' => 'Get Project', 'description' => 'Get one Automate project.', 'icon' => 'ph:folder-open'],
            'browserstack_update_project' => ['class' => BrowserStackUpdateProject::class, 'type' => 'write', 'name' => 'Update Project', 'description' => 'Update Automate project details.', 'icon' => 'ph:pencil'],
            'browserstack_delete_project' => ['class' => BrowserStackDeleteProject::class, 'type' => 'write', 'name' => 'Delete Project', 'description' => 'Delete one Automate project.', 'icon' => 'ph:trash'],
            'browserstack_list_builds' => ['class' => BrowserStackListBuilds::class, 'type' => 'read', 'name' => 'List Builds', 'description' => 'List Automate builds.', 'icon' => 'ph:list-checks'],
            'browserstack_update_build' => ['class' => BrowserStackUpdateBuild::class, 'type' => 'write', 'name' => 'Update Build', 'description' => 'Update Automate build name or tag.', 'icon' => 'ph:pencil'],
            'browserstack_delete_build' => ['class' => BrowserStackDeleteBuild::class, 'type' => 'write', 'name' => 'Delete Build', 'description' => 'Delete one Automate build.', 'icon' => 'ph:trash'],
            'browserstack_delete_builds' => ['class' => BrowserStackDeleteBuilds::class, 'type' => 'write', 'name' => 'Delete Builds', 'description' => 'Delete multiple Automate builds.', 'icon' => 'ph:trash'],
            'browserstack_list_build_sessions' => ['class' => BrowserStackListBuildSessions::class, 'type' => 'read', 'name' => 'List Build Sessions', 'description' => 'List sessions in an Automate build.', 'icon' => 'ph:list-bullets'],
            'browserstack_get_session' => ['class' => BrowserStackGetSession::class, 'type' => 'read', 'name' => 'Get Session', 'description' => 'Get one Automate session.', 'icon' => 'ph:monitor'],
            'browserstack_update_session' => ['class' => BrowserStackUpdateSession::class, 'type' => 'write', 'name' => 'Update Session', 'description' => 'Update one Automate session.', 'icon' => 'ph:pencil'],
            'browserstack_delete_session' => ['class' => BrowserStackDeleteSession::class, 'type' => 'write', 'name' => 'Delete Session', 'description' => 'Delete one Automate session.', 'icon' => 'ph:trash'],
            'browserstack_get_session_logs' => ['class' => BrowserStackGetSessionLogs::class, 'type' => 'read', 'name' => 'Get Session Logs', 'description' => 'Get text logs for one session.', 'icon' => 'ph:file-text'],
            'browserstack_get_session_network_logs' => ['class' => BrowserStackGetSessionNetworkLogs::class, 'type' => 'read', 'name' => 'Get Session Network Logs', 'description' => 'Get HAR network logs for one session.', 'icon' => 'ph:file-code'],
            'browserstack_upload_app' => ['class' => BrowserStackUploadApp::class, 'type' => 'write', 'name' => 'Upload App', 'description' => 'Upload an App Automate app by public URL.', 'icon' => 'ph:upload'],
            'browserstack_list_recent_apps' => ['class' => BrowserStackListRecentApps::class, 'type' => 'read', 'name' => 'List Recent Apps', 'description' => 'List recently uploaded App Automate apps.', 'icon' => 'ph:device-mobile'],
            'browserstack_delete_app' => ['class' => BrowserStackDeleteApp::class, 'type' => 'write', 'name' => 'Delete App', 'description' => 'Delete an uploaded App Automate app.', 'icon' => 'ph:trash'],
            'browserstack_api_get' => ['class' => BrowserStackApiGet::class, 'type' => 'read', 'name' => 'API GET', 'description' => 'Call a safe relative BrowserStack GET path.', 'icon' => 'ph:code'],
            'browserstack_api_post' => ['class' => BrowserStackApiPost::class, 'type' => 'write', 'name' => 'API POST', 'description' => 'Call a safe relative BrowserStack POST path.', 'icon' => 'ph:code'],
            'browserstack_api_put' => ['class' => BrowserStackApiPut::class, 'type' => 'write', 'name' => 'API PUT', 'description' => 'Call a safe relative BrowserStack PUT path.', 'icon' => 'ph:code'],
            'browserstack_api_delete' => ['class' => BrowserStackApiDelete::class, 'type' => 'write', 'name' => 'API DELETE', 'description' => 'Call a safe relative BrowserStack DELETE path.', 'icon' => 'ph:code'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a BrowserStack tool instance.
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
    private function resolveService(array $context = []): BrowserStackService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new BrowserStackService(
                username: $creds->get('browserstack', 'username', '', $account),
                accessKey: $creds->get('browserstack', 'access_key', '', $account),
                baseUrl: $creds->get('browserstack', 'url', 'https://api.browserstack.com', $account),
                cloudBaseUrl: $creds->get('browserstack', 'cloud_url', 'https://api-cloud.browserstack.com', $account),
            );
        }

        return app(BrowserStackService::class);
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/browserstack.md';
    }
}
