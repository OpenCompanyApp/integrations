<?php

namespace OpenCompany\Integrations\AbuseIpdb;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\AbuseIpdb\Tools\AbuseIpdbBlacklist;
use OpenCompany\Integrations\AbuseIpdb\Tools\AbuseIpdbBulkReport;
use OpenCompany\Integrations\AbuseIpdb\Tools\AbuseIpdbCheck;
use OpenCompany\Integrations\AbuseIpdb\Tools\AbuseIpdbCheckBlock;
use OpenCompany\Integrations\AbuseIpdb\Tools\AbuseIpdbClearAddress;
use OpenCompany\Integrations\AbuseIpdb\Tools\AbuseIpdbReport;
use OpenCompany\Integrations\AbuseIpdb\Tools\AbuseIpdbReports;

/**
 * Tool catalog and configuration metadata for AbuseIPDB.
 *
 * Exposes the documented API v2 endpoints for IP reputation checks, reports,
 * blacklist feeds, CIDR block checks, bulk reporting, and clearing reports.
 */
class AbuseIpdbToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => [
                'strategy' => 'api_key',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'required_secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['api_key'],
                'notes' => ['AbuseIPDB API v2 requires a private API key sent in the Key header.'],
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
        return 'abuseipdb';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'AbuseIPDB',
            'description' => 'IP abuse reputation, reports, blacklist feeds, and CIDR checks',
            'icon' => 'ph:shield-warning',
            'logo' => 'ph:shield-warning',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'AbuseIPDB',
            'description' => 'AbuseIPDB API v2 for checking IP reputation, listing reports, downloading blacklist feeds, submitting abuse reports, checking CIDR blocks, bulk reporting CSV data, and clearing reports from an account.',
            'icon' => 'ph:shield-warning',
            'logo' => 'ph:shield-warning',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://docs.abuseipdb.com/',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'AbuseIPDB API v2 key', 'hint' => 'Required. AbuseIPDB recommends sending the key in the Key header.', 'required' => true],
        ];
    }

    /**
     * Verify AbuseIPDB API-key validity with a lightweight check request.
     *
     * @param  array<string, mixed>  $config  Credential settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        try {
            $apiKey = (string) ($config['api_key'] ?? '');
            if ($apiKey === '') {
                return ['success' => false, 'error' => 'AbuseIPDB API key is required.'];
            }

            $response = Http::withHeaders(['Key' => $apiKey, 'Accept' => 'application/json'])
                ->timeout(20)
                ->get('https://api.abuseipdb.com/api/v2/check', ['ipAddress' => '127.0.0.2', 'maxAgeInDays' => 1]);

            return $response->successful()
                ? ['success' => true, 'message' => 'AbuseIPDB API key accepted.']
                : ['success' => false, 'error' => 'AbuseIPDB API returned HTTP '.$response->status().'.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['api_key' => 'required|string'];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'AbuseIPDB API v2 key', 'hint' => 'Required for all AbuseIPDB API v2 endpoints.', 'required' => true],
        ];
    }

    public function tools(): array
    {
        return [
            'abuseipdb_check' => ['class' => AbuseIpdbCheck::class, 'type' => 'read', 'name' => 'Check IP', 'description' => 'Check reputation for one IP address.', 'icon' => 'ph:magnifying-glass'],
            'abuseipdb_reports' => ['class' => AbuseIpdbReports::class, 'type' => 'read', 'name' => 'Reports', 'description' => 'List reports for one IP address.', 'icon' => 'ph:list-magnifying-glass'],
            'abuseipdb_blacklist' => ['class' => AbuseIpdbBlacklist::class, 'type' => 'read', 'name' => 'Blacklist', 'description' => 'Retrieve the AbuseIPDB blacklist.', 'icon' => 'ph:list-checks'],
            'abuseipdb_report' => ['class' => AbuseIpdbReport::class, 'type' => 'write', 'name' => 'Report IP', 'description' => 'Submit an abuse report for one IP address.', 'icon' => 'ph:flag'],
            'abuseipdb_check_block' => ['class' => AbuseIpdbCheckBlock::class, 'type' => 'read', 'name' => 'Check Block', 'description' => 'Check abuse data for a CIDR block.', 'icon' => 'ph:network'],
            'abuseipdb_bulk_report' => ['class' => AbuseIpdbBulkReport::class, 'type' => 'write', 'name' => 'Bulk Report', 'description' => 'Submit CSV abuse reports in bulk.', 'icon' => 'ph:file-csv'],
            'abuseipdb_clear_address' => ['class' => AbuseIpdbClearAddress::class, 'type' => 'write', 'name' => 'Clear Address', 'description' => 'Clear this account reports for one IP address.', 'icon' => 'ph:eraser'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create an AbuseIPDB tool from the catalog class name.
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
    private function resolveService(array $context = []): AbuseIpdbService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new AbuseIpdbService(apiKey: $creds->get('abuseipdb', 'api_key', '', $account));
        }

        return app(AbuseIpdbService::class);
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/abuseipdb.md';
    }
}
