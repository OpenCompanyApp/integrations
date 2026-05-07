<?php

namespace OpenCompany\Integrations\GoogleDriveActivity;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Google Drive Activity.
 *
 * Exposes generated coverage for the official Drive Activity v2 Discovery
 * document, currently the activity query endpoint.
 */
class GoogleDriveActivityToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => ['strategy' => 'oauth2_manual_token', 'legacy_auth_type' => 'oauth', 'credential_mode' => 'stored_token', 'setup_flows' => ['manual_token'], 'requires_browser_for_setup' => false, 'refreshable' => false, 'token_keys' => ['access_token'], 'notes' => ['Requires a Google OAuth access token with Drive Activity scopes.']],
            'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal']],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string { return 'google-drive-activity'; }
    public function appMeta(): array { return ['label' => 'Google Drive Activity', 'description' => 'Query audit and activity history for Google Drive items and folders', 'icon' => 'ph:activity', 'logo' => 'logos:google-drive']; }
    public function integrationMeta(): array { return ['name' => 'Google Drive Activity', 'description' => 'Generated coverage for the Google Drive Activity v2 REST API: query Drive item and folder activity history.', 'icon' => 'ph:activity', 'logo' => 'logos:google-drive', 'category' => 'productivity', 'badge' => 'verified', 'docs_url' => 'https://developers.google.com/workspace/drive/activity/v2/reference/rest']; }
    public function configSchema(): array { return [['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'Google OAuth access token', 'hint' => 'Use a Google OAuth 2.0 token with Drive Activity scopes.', 'required' => true], ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://driveactivity.googleapis.com', 'hint' => 'Override only for a proxy or compatible endpoint.', 'default' => 'https://driveactivity.googleapis.com']]; }

    /**
     * Verify Google Drive Activity credentials with token-presence only.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        if ($accessToken === '') return ['success' => false, 'error' => 'No access token provided.'];
        return ['success' => true, 'message' => 'Google Drive Activity token is present. Use activity.query with a target item or ancestor for a live activity check.'];
    }

    public function validationRules(): array { return ['access_token' => 'nullable|string', 'url' => 'nullable|url']; }

    public function tools(): array
    {
        return [
            'google_drive_activity_activity_query' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDriveActivity\\Tools\\GoogleDriveActivityActivityQuery',
  'type' => 'write',
  'name' => 'Activity Query',
  'description' => 'Activity Query (POST /v2/activity:query).',
  'icon' => 'ph:activity',
),
        ];
    }

    public function credentialFields(): array { return $this->configSchema(); }
    public function isIntegration(): bool { return true; }

    /**
     * Create a Google Drive Activity tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): GoogleDriveActivityService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            return new GoogleDriveActivityService(accessToken: $creds->get('google-drive-activity', 'access_token', '', $account), baseUrl: $creds->get('google-drive-activity', 'url', 'https://driveactivity.googleapis.com', $account));
        }
        return app(GoogleDriveActivityService::class);
    }

    public function luaDocsPath(): ?string { return __DIR__ . '/../lua-docs/google-drive-activity.md'; }
}