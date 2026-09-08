<?php

namespace OpenCompany\Integrations\GoogleAdminReports;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Google Admin Reports.
 *
 * Exposes generated coverage for the official Admin SDK Reports API Discovery
 * document, including audit activities, usage reports, watches, and channels.
 */
class GoogleAdminReportsToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => ['strategy' => 'oauth2_manual_token', 'legacy_auth_type' => 'oauth', 'credential_mode' => 'stored_token', 'setup_flows' => ['manual_token'], 'requires_browser_for_setup' => false, 'refreshable' => false, 'token_keys' => ['access_token'], 'notes' => ['Requires a Google OAuth access token with Admin SDK Reports scopes.']],
            'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal']],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string { return 'google-admin-reports'; }
    public function appMeta(): array { return ['label' => 'Google Admin Reports', 'description' => 'Audit activities, user/customer/entity usage reports, watches, and channels', 'icon' => 'ph:chart-line', 'logo' => 'logos:google-icon']; }
    public function integrationMeta(): array { return ['name' => 'Google Admin Reports', 'description' => 'Generated coverage for the Admin SDK Reports API: activities, user usage, customer usage, entity usage, watch subscriptions, and channel stop.', 'icon' => 'ph:chart-line', 'logo' => 'logos:google-icon', 'category' => 'analytics', 'badge' => 'verified', 'docs_url' => 'https://developers.google.com/admin-sdk/reports/reference/rest']; }
    public function configSchema(): array { return [['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'Google OAuth access token', 'hint' => 'Use a Google OAuth 2.0 token with Admin SDK Reports scopes.', 'required' => true], ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://admin.googleapis.com', 'hint' => 'Override only for a proxy or compatible endpoint.', 'default' => 'https://admin.googleapis.com']]; }

    /**
     * Verify Google Admin Reports credentials with token-presence only.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        if ($accessToken === '') return ['success' => false, 'error' => 'No access token provided.'];
        return ['success' => true, 'message' => 'Google Admin Reports token is present. Use an activities or usage report tool for a live report-specific check.'];
    }

    public function validationRules(): array { return ['access_token' => 'nullable|string', 'url' => 'nullable|url']; }

    public function tools(): array
    {
        return [
            'google_admin_reports_user_usage_report_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleAdminReports\\Tools\\GoogleAdminReportsUserUsageReportGet',
  'type' => 'read',
  'name' => 'User Usage Report Get',
  'description' => 'User Usage Report Get (GET /admin/reports/v1/usage/users/{userKey}/dates/{date}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_admin_reports_customer_usage_reports_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleAdminReports\\Tools\\GoogleAdminReportsCustomerUsageReportsGet',
  'type' => 'read',
  'name' => 'Customer Usage Reports Get',
  'description' => 'Customer Usage Reports Get (GET /admin/reports/v1/usage/dates/{date}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_admin_reports_entity_usage_reports_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleAdminReports\\Tools\\GoogleAdminReportsEntityUsageReportsGet',
  'type' => 'read',
  'name' => 'Entity Usage Reports Get',
  'description' => 'Entity Usage Reports Get (GET /admin/reports/v1/usage/{entityType}/{entityKey}/dates/{date}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_admin_reports_channels_stop' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleAdminReports\\Tools\\GoogleAdminReportsChannelsStop',
  'type' => 'write',
  'name' => 'Channels Stop',
  'description' => 'Channels Stop (POST /admin/reports_v1/channels/stop).',
  'icon' => 'ph:chart-line',
),
            'google_admin_reports_activities_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleAdminReports\\Tools\\GoogleAdminReportsActivitiesList',
  'type' => 'read',
  'name' => 'Activities List',
  'description' => 'Activities List (GET /admin/reports/v1/activity/users/{userKey}/applications/{applicationName}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_admin_reports_activities_watch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleAdminReports\\Tools\\GoogleAdminReportsActivitiesWatch',
  'type' => 'write',
  'name' => 'Activities Watch',
  'description' => 'Activities Watch (POST /admin/reports/v1/activity/users/{userKey}/applications/{applicationName}/watch).',
  'icon' => 'ph:chart-line',
),
        ];
    }

    public function credentialFields(): array { return $this->configSchema(); }
    public function isIntegration(): bool { return true; }

    /**
     * Create a Google Admin Reports tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): GoogleAdminReportsService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            return new GoogleAdminReportsService(accessToken: $creds->get('google-admin-reports', 'access_token', '', $account), baseUrl: $creds->get('google-admin-reports', 'url', 'https://admin.googleapis.com', $account));
        }
        return app(GoogleAdminReportsService::class);
    }

    public function scriptDocsPath(): ?string { return __DIR__ . '/../script-docs/google-admin-reports.md'; }
}