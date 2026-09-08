<?php

namespace OpenCompany\Integrations\Nvd;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Nvd\Tools\NvdCpeByNameId;
use OpenCompany\Integrations\Nvd\Tools\NvdCpeMatch;
use OpenCompany\Integrations\Nvd\Tools\NvdCpeMatchByCriteriaId;
use OpenCompany\Integrations\Nvd\Tools\NvdCpes;
use OpenCompany\Integrations\Nvd\Tools\NvdCveById;
use OpenCompany\Integrations\Nvd\Tools\NvdCveHistory;
use OpenCompany\Integrations\Nvd\Tools\NvdCves;
use OpenCompany\Integrations\Nvd\Tools\NvdSourceByIdentifier;
use OpenCompany\Integrations\Nvd\Tools\NvdSources;

/**
 * Tool catalog and configuration metadata for the National Vulnerability Database.
 *
 * Exposes NVD 2.0 REST APIs for CVEs, CVE changes, CPE names, CPE match
 * criteria, and source metadata. An API key is optional but improves rate limits.
 */
class NvdToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'credential_mode' => 'optional_secret',
                'setup_flows' => ['none', 'manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['api_key'],
                'notes' => ['NVD APIs can be used without an API key at lower rate limits. The API key is sent as the official apiKey request header when configured.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'optional_manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'optional_manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string
    {
        return 'nvd';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'NVD',
            'description' => 'Search NIST National Vulnerability Database CVE, CPE, match criteria, and source data',
            'icon' => 'ph:shield-check',
            'logo' => 'ph:shield-check',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'NVD',
            'description' => 'NIST National Vulnerability Database 2.0 APIs for CVE records, CVE change history, CPE dictionary records, CPE match criteria, and data-source metadata.',
            'icon' => 'ph:shield-check',
            'logo' => 'ph:shield-check',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://nvd.nist.gov/developers',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'NVD API key', 'hint' => 'Optional. Raises NVD rate limits when provided.', 'required' => false],
        ];
    }

    /**
     * Verify NVD connectivity and optional API-key acceptance.
     *
     * @param  array<string, mixed>  $config  Credential settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        try {
            $request = Http::acceptJson()->timeout(20);
            $apiKey = (string) ($config['api_key'] ?? '');
            if ($apiKey !== '') {
                $request = $request->withHeaders(['apiKey' => $apiKey]);
            }

            $response = $request->get('https://services.nvd.nist.gov/rest/json/cves/2.0?resultsPerPage=1&startIndex=0');

            return $response->successful()
                ? ['success' => true, 'message' => $apiKey === '' ? 'NVD API is reachable without an API key.' : 'NVD API key accepted.']
                : ['success' => false, 'error' => 'NVD API returned HTTP '.$response->status().'.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['api_key' => 'nullable|string'];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'NVD API key', 'hint' => 'Optional. Raises NVD rate limits when provided.', 'required' => false],
        ];
    }

    public function tools(): array
    {
        return [
            'nvd_cves' => ['class' => NvdCves::class, 'type' => 'read', 'name' => 'CVEs', 'description' => 'Search NVD CVE records with official 2.0 filters.', 'icon' => 'ph:bug'],
            'nvd_cve_by_id' => ['class' => NvdCveById::class, 'type' => 'read', 'name' => 'CVE By ID', 'description' => 'Retrieve one CVE record by CVE ID.', 'icon' => 'ph:bug-beetle'],
            'nvd_cve_history' => ['class' => NvdCveHistory::class, 'type' => 'read', 'name' => 'CVE History', 'description' => 'Search CVE change-history events.', 'icon' => 'ph:clock-counter-clockwise'],
            'nvd_cpes' => ['class' => NvdCpes::class, 'type' => 'read', 'name' => 'CPEs', 'description' => 'Search NVD CPE dictionary records.', 'icon' => 'ph:package'],
            'nvd_cpe_by_name_id' => ['class' => NvdCpeByNameId::class, 'type' => 'read', 'name' => 'CPE By Name ID', 'description' => 'Retrieve CPE dictionary records by cpeNameId UUID.', 'icon' => 'ph:identification-card'],
            'nvd_cpe_match' => ['class' => NvdCpeMatch::class, 'type' => 'read', 'name' => 'CPE Match Criteria', 'description' => 'Search CPE match criteria records.', 'icon' => 'ph:funnel'],
            'nvd_cpe_match_by_criteria_id' => ['class' => NvdCpeMatchByCriteriaId::class, 'type' => 'read', 'name' => 'CPE Match By Criteria ID', 'description' => 'Retrieve match criteria records by matchCriteriaId UUID.', 'icon' => 'ph:hash'],
            'nvd_sources' => ['class' => NvdSources::class, 'type' => 'read', 'name' => 'Sources', 'description' => 'Search NVD data-source metadata.', 'icon' => 'ph:database'],
            'nvd_source_by_identifier' => ['class' => NvdSourceByIdentifier::class, 'type' => 'read', 'name' => 'Source By Identifier', 'description' => 'Retrieve NVD data-source metadata by sourceIdentifier.', 'icon' => 'ph:address-book'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create an NVD tool from the catalog class name.
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
    private function resolveService(array $context = []): NvdService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new NvdService(apiKey: $creds->get('nvd', 'api_key', '', $account));
        }

        return app(NvdService::class);
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/nvd.md';
    }
}
