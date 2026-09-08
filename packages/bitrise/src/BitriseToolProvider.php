<?php

namespace OpenCompany\Integrations\Bitrise;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Bitrise\Tools\BitriseAbortBuild;
use OpenCompany\Integrations\Bitrise\Tools\BitriseApiDelete;
use OpenCompany\Integrations\Bitrise\Tools\BitriseApiGet;
use OpenCompany\Integrations\Bitrise\Tools\BitriseApiPatch;
use OpenCompany\Integrations\Bitrise\Tools\BitriseApiPost;
use OpenCompany\Integrations\Bitrise\Tools\BitriseApiPut;
use OpenCompany\Integrations\Bitrise\Tools\BitriseCreateAndroidKeystoreFile;
use OpenCompany\Integrations\Bitrise\Tools\BitriseCreateOutgoingWebhook;
use OpenCompany\Integrations\Bitrise\Tools\BitriseDeleteAndroidKeystoreFile;
use OpenCompany\Integrations\Bitrise\Tools\BitriseDeleteApp;
use OpenCompany\Integrations\Bitrise\Tools\BitriseDeleteArtifact;
use OpenCompany\Integrations\Bitrise\Tools\BitriseDeleteOutgoingWebhook;
use OpenCompany\Integrations\Bitrise\Tools\BitriseDeleteSecret;
use OpenCompany\Integrations\Bitrise\Tools\BitriseFinishApp;
use OpenCompany\Integrations\Bitrise\Tools\BitriseGetApp;
use OpenCompany\Integrations\Bitrise\Tools\BitriseGetArtifact;
use OpenCompany\Integrations\Bitrise\Tools\BitriseGetBitriseYml;
use OpenCompany\Integrations\Bitrise\Tools\BitriseGetBitriseYmlConfig;
use OpenCompany\Integrations\Bitrise\Tools\BitriseGetBuild;
use OpenCompany\Integrations\Bitrise\Tools\BitriseGetBuildBitriseYml;
use OpenCompany\Integrations\Bitrise\Tools\BitriseGetBuildLog;
use OpenCompany\Integrations\Bitrise\Tools\BitriseGetRoleGroups;
use OpenCompany\Integrations\Bitrise\Tools\BitriseGetSecretValue;
use OpenCompany\Integrations\Bitrise\Tools\BitriseListAndroidKeystoreFiles;
use OpenCompany\Integrations\Bitrise\Tools\BitriseListAppBuilds;
use OpenCompany\Integrations\Bitrise\Tools\BitriseListApps;
use OpenCompany\Integrations\Bitrise\Tools\BitriseListArchivedBuilds;
use OpenCompany\Integrations\Bitrise\Tools\BitriseListArtifacts;
use OpenCompany\Integrations\Bitrise\Tools\BitriseListBranches;
use OpenCompany\Integrations\Bitrise\Tools\BitriseListBuildWorkflows;
use OpenCompany\Integrations\Bitrise\Tools\BitriseListBuilds;
use OpenCompany\Integrations\Bitrise\Tools\BitriseListOrganizationApps;
use OpenCompany\Integrations\Bitrise\Tools\BitriseListOutgoingWebhooks;
use OpenCompany\Integrations\Bitrise\Tools\BitriseListSecrets;
use OpenCompany\Integrations\Bitrise\Tools\BitriseListUserApps;
use OpenCompany\Integrations\Bitrise\Tools\BitriseMigrateOrganizationAppMachineTypes;
use OpenCompany\Integrations\Bitrise\Tools\BitriseMigrateUserAppMachineTypes;
use OpenCompany\Integrations\Bitrise\Tools\BitrisePutSecret;
use OpenCompany\Integrations\Bitrise\Tools\BitriseRegisterApp;
use OpenCompany\Integrations\Bitrise\Tools\BitriseRegisterSshKey;
use OpenCompany\Integrations\Bitrise\Tools\BitriseRegisterWebhook;
use OpenCompany\Integrations\Bitrise\Tools\BitriseSetRoleGroups;
use OpenCompany\Integrations\Bitrise\Tools\BitriseTriggerBuild;
use OpenCompany\Integrations\Bitrise\Tools\BitriseUpdateApp;
use OpenCompany\Integrations\Bitrise\Tools\BitriseUpdateArtifact;
use OpenCompany\Integrations\Bitrise\Tools\BitriseUpdateBitriseYmlConfig;
use OpenCompany\Integrations\Bitrise\Tools\BitriseUpdateEmailNotifications;
use OpenCompany\Integrations\Bitrise\Tools\BitriseUpdateOutgoingWebhook;
use OpenCompany\Integrations\Bitrise\Tools\BitriseUploadBitriseYml;

/**
 * Tool catalog and configuration metadata for Bitrise.
 *
 * Exposes Bitrise API v0.1 operations for apps, builds, webhooks, artifacts,
 * secrets, Android signing files, and safe raw relative API calls.
 */
class BitriseToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => ['Bitrise expects the token value in the Authorization header.'],
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
        return 'bitrise';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Bitrise',
            'description' => 'Mobile CI/CD apps, builds, artifacts, secrets, webhooks, and signing assets',
            'icon' => 'ph:device-mobile',
            'logo' => 'ph:device-mobile',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Bitrise',
            'description' => 'Manage Bitrise CI apps, builds, webhooks, artifacts, secrets, signing files, and raw API calls.',
            'icon' => 'ph:device-mobile',
            'logo' => 'ph:device-mobile',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.bitrise.io/en/bitrise-ci/api/api-reference.html',
        ];
    }

    public function configSchema(): array
    {
        return $this->credentialFields();
    }

    /**
     * Verify Bitrise credentials with the apps endpoint.
     *
     * @param  array<string, mixed>  $config  Credential settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        try {
            $token = (string) ($config['api_token'] ?? '');
            if ($token === '') {
                return ['success' => false, 'error' => 'Bitrise API token is required.'];
            }

            $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.bitrise.io/v0.1'), '/');
            $response = Http::withHeaders(['Authorization' => $token, 'Accept' => 'application/json'])
                ->timeout(20)
                ->get($baseUrl.'/apps');

            if (!$response->successful()) {
                return ['success' => false, 'error' => 'Bitrise API returned HTTP '.$response->status().'.'];
            }

            return ['success' => true, 'message' => 'Connected to Bitrise API.'];
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
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'placeholder' => 'bitrise-token', 'hint' => 'Bitrise personal access token or Workspace API token.', 'required' => true],
            ['key' => 'url', 'type' => 'text', 'label' => 'API URL', 'placeholder' => 'https://api.bitrise.io/v0.1', 'hint' => 'Optional Bitrise API base URL.', 'required' => false],
        ];
    }

    public function tools(): array
    {
        return [
            'bitrise_list_apps' => ['class' => BitriseListApps::class, 'type' => 'read', 'name' => 'List Apps', 'description' => 'List accessible Bitrise apps.', 'icon' => 'ph:app-window'],
            'bitrise_register_app' => ['class' => BitriseRegisterApp::class, 'type' => 'write', 'name' => 'Register App', 'description' => 'Register a new Bitrise app.', 'icon' => 'ph:plus-circle'],
            'bitrise_get_app' => ['class' => BitriseGetApp::class, 'type' => 'read', 'name' => 'Get App', 'description' => 'Get one Bitrise app.', 'icon' => 'ph:app-window'],
            'bitrise_update_app' => ['class' => BitriseUpdateApp::class, 'type' => 'write', 'name' => 'Update App', 'description' => 'Update app settings.', 'icon' => 'ph:pencil'],
            'bitrise_delete_app' => ['class' => BitriseDeleteApp::class, 'type' => 'write', 'name' => 'Delete App', 'description' => 'Delete one Bitrise app.', 'icon' => 'ph:trash'],
            'bitrise_get_bitrise_yml' => ['class' => BitriseGetBitriseYml::class, 'type' => 'read', 'name' => 'Get bitrise.yml', 'description' => 'Get app configuration YAML.', 'icon' => 'ph:file-code'],
            'bitrise_upload_bitrise_yml' => ['class' => BitriseUploadBitriseYml::class, 'type' => 'write', 'name' => 'Upload bitrise.yml', 'description' => 'Upload app configuration YAML.', 'icon' => 'ph:upload'],
            'bitrise_get_bitrise_yml_config' => ['class' => BitriseGetBitriseYmlConfig::class, 'type' => 'read', 'name' => 'Get YAML Config', 'description' => 'Get bitrise.yml storage configuration.', 'icon' => 'ph:gear'],
            'bitrise_update_bitrise_yml_config' => ['class' => BitriseUpdateBitriseYmlConfig::class, 'type' => 'write', 'name' => 'Update YAML Config', 'description' => 'Update bitrise.yml storage configuration.', 'icon' => 'ph:gear'],
            'bitrise_list_branches' => ['class' => BitriseListBranches::class, 'type' => 'read', 'name' => 'List Branches', 'description' => 'List repository branches for an app.', 'icon' => 'ph:git-branch'],
            'bitrise_register_ssh_key' => ['class' => BitriseRegisterSshKey::class, 'type' => 'write', 'name' => 'Register SSH Key', 'description' => 'Register app SSH key data.', 'icon' => 'ph:key'],
            'bitrise_finish_app' => ['class' => BitriseFinishApp::class, 'type' => 'write', 'name' => 'Finish App', 'description' => 'Finish app registration.', 'icon' => 'ph:check-circle'],
            'bitrise_list_organization_apps' => ['class' => BitriseListOrganizationApps::class, 'type' => 'read', 'name' => 'List Workspace Apps', 'description' => 'List apps for a Workspace.', 'icon' => 'ph:buildings'],
            'bitrise_list_user_apps' => ['class' => BitriseListUserApps::class, 'type' => 'read', 'name' => 'List User Apps', 'description' => 'List apps for a user.', 'icon' => 'ph:user'],
            'bitrise_get_role_groups' => ['class' => BitriseGetRoleGroups::class, 'type' => 'read', 'name' => 'Get Role Groups', 'description' => 'List groups assigned to an app role.', 'icon' => 'ph:users'],
            'bitrise_set_role_groups' => ['class' => BitriseSetRoleGroups::class, 'type' => 'write', 'name' => 'Set Role Groups', 'description' => 'Replace groups assigned to an app role.', 'icon' => 'ph:users-three'],
            'bitrise_update_email_notifications' => ['class' => BitriseUpdateEmailNotifications::class, 'type' => 'write', 'name' => 'Update Email Notifications', 'description' => 'Update app email notification settings.', 'icon' => 'ph:envelope'],
            'bitrise_migrate_user_app_machine_types' => ['class' => BitriseMigrateUserAppMachineTypes::class, 'type' => 'write', 'name' => 'Migrate User App Machines', 'description' => 'Migrate user-owned app machine types.', 'icon' => 'ph:cpu'],
            'bitrise_migrate_organization_app_machine_types' => ['class' => BitriseMigrateOrganizationAppMachineTypes::class, 'type' => 'write', 'name' => 'Migrate Workspace App Machines', 'description' => 'Migrate Workspace-owned app machine types.', 'icon' => 'ph:cpu'],
            'bitrise_trigger_build' => ['class' => BitriseTriggerBuild::class, 'type' => 'write', 'name' => 'Trigger Build', 'description' => 'Trigger a new app build.', 'icon' => 'ph:play'],
            'bitrise_abort_build' => ['class' => BitriseAbortBuild::class, 'type' => 'write', 'name' => 'Abort Build', 'description' => 'Abort a running app build.', 'icon' => 'ph:x-circle'],
            'bitrise_list_app_builds' => ['class' => BitriseListAppBuilds::class, 'type' => 'read', 'name' => 'List App Builds', 'description' => 'List recent app builds.', 'icon' => 'ph:list-checks'],
            'bitrise_list_archived_builds' => ['class' => BitriseListArchivedBuilds::class, 'type' => 'read', 'name' => 'List Archived Builds', 'description' => 'List archived app builds.', 'icon' => 'ph:archive'],
            'bitrise_list_build_workflows' => ['class' => BitriseListBuildWorkflows::class, 'type' => 'read', 'name' => 'List Build Workflows', 'description' => 'List workflows triggered for an app.', 'icon' => 'ph:flow-arrow'],
            'bitrise_get_build' => ['class' => BitriseGetBuild::class, 'type' => 'read', 'name' => 'Get Build', 'description' => 'Get one app build.', 'icon' => 'ph:check-circle'],
            'bitrise_get_build_bitrise_yml' => ['class' => BitriseGetBuildBitriseYml::class, 'type' => 'read', 'name' => 'Get Build YAML', 'description' => 'Get bitrise.yml used by one build.', 'icon' => 'ph:file-code'],
            'bitrise_get_build_log' => ['class' => BitriseGetBuildLog::class, 'type' => 'read', 'name' => 'Get Build Log', 'description' => 'Get one build log.', 'icon' => 'ph:file-text'],
            'bitrise_list_builds' => ['class' => BitriseListBuilds::class, 'type' => 'read', 'name' => 'List Builds', 'description' => 'List builds accessible to the account.', 'icon' => 'ph:list-checks'],
            'bitrise_register_webhook' => ['class' => BitriseRegisterWebhook::class, 'type' => 'write', 'name' => 'Register Webhook', 'description' => 'Register an incoming app webhook.', 'icon' => 'ph:webhooks-logo'],
            'bitrise_list_outgoing_webhooks' => ['class' => BitriseListOutgoingWebhooks::class, 'type' => 'read', 'name' => 'List Outgoing Webhooks', 'description' => 'List outgoing app webhooks.', 'icon' => 'ph:webhooks-logo'],
            'bitrise_create_outgoing_webhook' => ['class' => BitriseCreateOutgoingWebhook::class, 'type' => 'write', 'name' => 'Create Outgoing Webhook', 'description' => 'Create an outgoing app webhook.', 'icon' => 'ph:plus-circle'],
            'bitrise_update_outgoing_webhook' => ['class' => BitriseUpdateOutgoingWebhook::class, 'type' => 'write', 'name' => 'Update Outgoing Webhook', 'description' => 'Update an outgoing app webhook.', 'icon' => 'ph:pencil'],
            'bitrise_delete_outgoing_webhook' => ['class' => BitriseDeleteOutgoingWebhook::class, 'type' => 'write', 'name' => 'Delete Outgoing Webhook', 'description' => 'Delete an outgoing app webhook.', 'icon' => 'ph:trash'],
            'bitrise_list_artifacts' => ['class' => BitriseListArtifacts::class, 'type' => 'read', 'name' => 'List Artifacts', 'description' => 'List build artifacts.', 'icon' => 'ph:package'],
            'bitrise_get_artifact' => ['class' => BitriseGetArtifact::class, 'type' => 'read', 'name' => 'Get Artifact', 'description' => 'Get one build artifact.', 'icon' => 'ph:package'],
            'bitrise_update_artifact' => ['class' => BitriseUpdateArtifact::class, 'type' => 'write', 'name' => 'Update Artifact', 'description' => 'Update one build artifact.', 'icon' => 'ph:pencil'],
            'bitrise_delete_artifact' => ['class' => BitriseDeleteArtifact::class, 'type' => 'write', 'name' => 'Delete Artifact', 'description' => 'Delete one build artifact.', 'icon' => 'ph:trash'],
            'bitrise_list_secrets' => ['class' => BitriseListSecrets::class, 'type' => 'read', 'name' => 'List Secrets', 'description' => 'List app secrets.', 'icon' => 'ph:key'],
            'bitrise_get_secret_value' => ['class' => BitriseGetSecretValue::class, 'type' => 'read', 'name' => 'Get Secret Value', 'description' => 'Get an unprotected secret value.', 'icon' => 'ph:key'],
            'bitrise_put_secret' => ['class' => BitrisePutSecret::class, 'type' => 'write', 'name' => 'Put Secret', 'description' => 'Create or update an app secret.', 'icon' => 'ph:key'],
            'bitrise_delete_secret' => ['class' => BitriseDeleteSecret::class, 'type' => 'write', 'name' => 'Delete Secret', 'description' => 'Delete an app secret.', 'icon' => 'ph:trash'],
            'bitrise_list_android_keystore_files' => ['class' => BitriseListAndroidKeystoreFiles::class, 'type' => 'read', 'name' => 'List Android Keystores', 'description' => 'List Android keystore files.', 'icon' => 'ph:android-logo'],
            'bitrise_create_android_keystore_file' => ['class' => BitriseCreateAndroidKeystoreFile::class, 'type' => 'write', 'name' => 'Create Android Keystore', 'description' => 'Create an Android keystore upload record.', 'icon' => 'ph:upload'],
            'bitrise_delete_android_keystore_file' => ['class' => BitriseDeleteAndroidKeystoreFile::class, 'type' => 'write', 'name' => 'Delete Android Keystore', 'description' => 'Delete an Android keystore file.', 'icon' => 'ph:trash'],
            'bitrise_api_get' => ['class' => BitriseApiGet::class, 'type' => 'read', 'name' => 'API GET', 'description' => 'Call a safe relative Bitrise GET path.', 'icon' => 'ph:code'],
            'bitrise_api_post' => ['class' => BitriseApiPost::class, 'type' => 'write', 'name' => 'API POST', 'description' => 'Call a safe relative Bitrise POST path.', 'icon' => 'ph:code'],
            'bitrise_api_put' => ['class' => BitriseApiPut::class, 'type' => 'write', 'name' => 'API PUT', 'description' => 'Call a safe relative Bitrise PUT path.', 'icon' => 'ph:code'],
            'bitrise_api_patch' => ['class' => BitriseApiPatch::class, 'type' => 'write', 'name' => 'API PATCH', 'description' => 'Call a safe relative Bitrise PATCH path.', 'icon' => 'ph:code'],
            'bitrise_api_delete' => ['class' => BitriseApiDelete::class, 'type' => 'write', 'name' => 'API DELETE', 'description' => 'Call a safe relative Bitrise DELETE path.', 'icon' => 'ph:code'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a Bitrise tool instance.
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
    private function resolveService(array $context = []): BitriseService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new BitriseService(
                apiToken: $creds->get('bitrise', 'api_token', '', $account),
                baseUrl: $creds->get('bitrise', 'url', 'https://api.bitrise.io/v0.1', $account),
            );
        }

        return app(BitriseService::class);
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/bitrise.md';
    }
}
