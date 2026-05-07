<?php

namespace OpenCompany\Integrations\SecEdgar;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\SecEdgar\Tools\SecEdgarBulkArchives;
use OpenCompany\Integrations\SecEdgar\Tools\SecEdgarCompanyConcept;
use OpenCompany\Integrations\SecEdgar\Tools\SecEdgarCompanyFacts;
use OpenCompany\Integrations\SecEdgar\Tools\SecEdgarCompanyTickers;
use OpenCompany\Integrations\SecEdgar\Tools\SecEdgarCompanyTickersExchange;
use OpenCompany\Integrations\SecEdgar\Tools\SecEdgarFrames;
use OpenCompany\Integrations\SecEdgar\Tools\SecEdgarSubmissionFile;
use OpenCompany\Integrations\SecEdgar\Tools\SecEdgarSubmissions;

/**
 * Tool catalog and metadata for SEC EDGAR.
 *
 * Exposes public submissions and XBRL data APIs from data.sec.gov plus SEC
 * ticker mapping files and official bulk archive URLs.
 */
class SecEdgarToolProvider implements ToolProvider, HasIntegrationCapabilities
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
                'strategy' => 'none',
                'legacy_auth_type' => 'none',
                'credential_mode' => 'none',
                'setup_flows' => ['none'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => ['SEC EDGAR data APIs require no API key. Automated access must use an identifiable User-Agent and comply with the SEC fair-access limit of no more than 10 requests per second.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'none'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'none', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string
    {
        return 'sec-edgar';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'SEC EDGAR',
            'description' => 'Company submissions, XBRL facts, frames, ticker mappings, and bulk archive URLs',
            'icon' => 'ph:bank',
            'logo' => 'ph:bank',
        ];
    }

    /**
     * Canonical integration metadata used by settings and generated catalogs.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'SEC EDGAR',
            'description' => 'Public SEC EDGAR APIs for submissions history, XBRL company facts, company concepts, frames, ticker mappings, and official bulk archive URLs.',
            'icon' => 'ph:bank',
            'logo' => 'ph:bank',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://www.sec.gov/edgar/sec-api-documentation',
        ];
    }

    public function tools(): array
    {
        return [
            'sec_edgar_submissions' => ['class' => SecEdgarSubmissions::class, 'type' => 'read', 'name' => 'Submissions', 'description' => 'Retrieve current public filing history for a CIK.', 'icon' => 'ph:files'],
            'sec_edgar_submission_file' => ['class' => SecEdgarSubmissionFile::class, 'type' => 'read', 'name' => 'Submission File', 'description' => 'Retrieve an additional paginated submissions JSON file.', 'icon' => 'ph:file-json'],
            'sec_edgar_company_facts' => ['class' => SecEdgarCompanyFacts::class, 'type' => 'read', 'name' => 'Company Facts', 'description' => 'Retrieve all standardized XBRL company facts for a CIK.', 'icon' => 'ph:database'],
            'sec_edgar_company_concept' => ['class' => SecEdgarCompanyConcept::class, 'type' => 'read', 'name' => 'Company Concept', 'description' => 'Retrieve one taxonomy concept across filings for a CIK.', 'icon' => 'ph:tag'],
            'sec_edgar_frames' => ['class' => SecEdgarFrames::class, 'type' => 'read', 'name' => 'Frames', 'description' => 'Retrieve an XBRL frame across reporting entities.', 'icon' => 'ph:table'],
            'sec_edgar_company_tickers' => ['class' => SecEdgarCompanyTickers::class, 'type' => 'read', 'name' => 'Company Tickers', 'description' => 'Retrieve SEC CIK, ticker, and company-title mappings.', 'icon' => 'ph:list-magnifying-glass'],
            'sec_edgar_company_tickers_exchange' => ['class' => SecEdgarCompanyTickersExchange::class, 'type' => 'read', 'name' => 'Ticker Exchanges', 'description' => 'Retrieve SEC CIK, ticker, exchange, and company-title mappings.', 'icon' => 'ph:chart-line'],
            'sec_edgar_bulk_archives' => ['class' => SecEdgarBulkArchives::class, 'type' => 'read', 'name' => 'Bulk Archives', 'description' => 'Return official SEC bulk archive ZIP URLs.', 'icon' => 'ph:archive'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function credentialFields(): array
    {
        return [];
    }

    /**
     * Create a SEC EDGAR tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional context, unused for public endpoints.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class(app(SecEdgarService::class));
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/sec-edgar.md';
    }
}
