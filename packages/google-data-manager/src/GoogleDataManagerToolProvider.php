<?php

namespace OpenCompany\Integrations\GoogleDataManager;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\GoogleDataManager\Tools\GoogleDataManagerDiagnostics;
use OpenCompany\Integrations\GoogleDataManager\Tools\GoogleDataManagerIngestAudienceMembers;
use OpenCompany\Integrations\GoogleDataManager\Tools\GoogleDataManagerIngestEvents;
use OpenCompany\Integrations\GoogleDataManager\Tools\GoogleDataManagerRawRequest;
use OpenCompany\Integrations\GoogleDataManager\Tools\GoogleDataManagerRemoveAudienceMembers;
use OpenCompany\Integrations\GoogleDataManager\Tools\GoogleDataManagerRetrieveRequestStatus;

/**
 * Tool catalog and credential metadata for Google Data Manager.
 *
 * Supports web OAuth and CLI/manual refresh-token setup for first-party data ingestion.
 */
class GoogleDataManagerToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe setup support and runtime requirements for host applications.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => [
                'strategy' => 'oauth2',
                'setup_flows' => ['oauth_redirect', 'manual_refresh_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => true,
                'oauth_scopes' => ['https://www.googleapis.com/auth/datamanager'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'oauth_redirect'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_refresh_token'],
            ],
            'runtime_requirements' => [
                'OAuth token with the datamanager scope',
                'Destination objects configured for Google advertising products',
                'Consent and terms fields supplied by the caller where legally or policy required',
            ],
        ];
    }

    public function appName(): string
    {
        return 'google_data_manager';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Google Data Manager',
            'description' => 'First-party event and audience ingestion for Google advertising products',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:google',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Google Data Manager',
            'description' => 'Google Data Manager API integration for conversion events, audience members, removals, and request-status polling.',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:google',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://developers.google.com/data-manager/api',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'client_id', 'type' => 'string', 'label' => 'OAuth Client ID', 'required' => false],
            ['key' => 'client_secret', 'type' => 'secret', 'label' => 'OAuth Client Secret', 'required' => false],
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => false],
            ['key' => 'refresh_token', 'type' => 'secret', 'label' => 'Refresh Token', 'required' => false],
            ['key' => 'expires_at', 'type' => 'string', 'label' => 'Access Token Expiry Timestamp', 'required' => false],
        ];
    }

    /**
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        if (empty($config['access_token']) && (empty($config['refresh_token']) || empty($config['client_id']) || empty($config['client_secret']))) {
            return ['success' => false, 'error' => 'Google Data Manager requires access_token, or client_id/client_secret/refresh_token for automatic CLI refresh.'];
        }

        $service = $this->serviceFromConfig($config);

        try {
            $diagnostics = $service->diagnostics();

            return ['success' => true, 'message' => 'Google Data Manager credentials are present for scope ' . $diagnostics['oauthScope']];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'refresh_token' => 'nullable|string',
            'client_id' => 'nullable|string',
            'client_secret' => 'nullable|string',
            'expires_at' => 'nullable',
        ];
    }

    public function tools(): array
    {
        return [
            'google_data_manager_diagnostics' => ['class' => GoogleDataManagerDiagnostics::class, 'type' => 'read', 'name' => 'Diagnostics', 'description' => 'Show safe configuration diagnostics.', 'icon' => 'ph:stethoscope'],
            'google_data_manager_ingest_events' => ['class' => GoogleDataManagerIngestEvents::class, 'type' => 'write', 'name' => 'Ingest Events', 'description' => 'Upload conversion event resources to destinations.', 'icon' => 'ph:upload'],
            'google_data_manager_ingest_audience_members' => ['class' => GoogleDataManagerIngestAudienceMembers::class, 'type' => 'write', 'name' => 'Ingest Audience Members', 'description' => 'Upload audience member resources to destinations.', 'icon' => 'ph:users-three'],
            'google_data_manager_remove_audience_members' => ['class' => GoogleDataManagerRemoveAudienceMembers::class, 'type' => 'write', 'name' => 'Remove Audience Members', 'description' => 'Remove audience members from destinations.', 'icon' => 'ph:user-minus'],
            'google_data_manager_retrieve_request_status' => ['class' => GoogleDataManagerRetrieveRequestStatus::class, 'type' => 'read', 'name' => 'Retrieve Request Status', 'description' => 'Poll request processing status by request ID.', 'icon' => 'ph:clock'],
            'google_data_manager_raw_request' => ['class' => GoogleDataManagerRawRequest::class, 'type' => 'write', 'name' => 'Raw API Request', 'description' => 'Low-level Data Manager API request for new endpoints.', 'icon' => 'ph:terminal-window'],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/google-data-manager.md';
    }

    public function credentialFields(): array
    {
        return $this->configSchema();
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve account-specific credentials for multi-account hosts.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): GoogleDataManagerService
    {
        $account = $context['account'] ?? null;
        if ($account === null) {
            return app(GoogleDataManagerService::class);
        }

        $creds = app(CredentialResolver::class);

        $expiresAt = $creds->get('google_data_manager', 'expires_at', null, $account);

        return new GoogleDataManagerService(
            clientId: $creds->get('google_data_manager', 'client_id', '', $account),
            clientSecret: $creds->get('google_data_manager', 'client_secret', '', $account),
            accessToken: $creds->get('google_data_manager', 'access_token', '', $account),
            refreshToken: $creds->get('google_data_manager', 'refresh_token', '', $account),
            expiresAt: is_numeric($expiresAt) ? (int) $expiresAt : null,
        );
    }

    /**
     * @param  array<string, mixed>  $config
     */
    private function serviceFromConfig(array $config): GoogleDataManagerService
    {
        return new GoogleDataManagerService(
            clientId: (string) ($config['client_id'] ?? ''),
            clientSecret: (string) ($config['client_secret'] ?? ''),
            accessToken: (string) ($config['access_token'] ?? ''),
            refreshToken: (string) ($config['refresh_token'] ?? ''),
            expiresAt: isset($config['expires_at']) ? (int) $config['expires_at'] : null,
        );
    }
}
