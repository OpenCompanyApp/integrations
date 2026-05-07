<?php

namespace OpenCompany\Integrations\FirstEpss;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\FirstEpss\Tools\FirstEpssBatch;
use OpenCompany\Integrations\FirstEpss\Tools\FirstEpssCve;
use OpenCompany\Integrations\FirstEpss\Tools\FirstEpssHistoricalCsvUrl;
use OpenCompany\Integrations\FirstEpss\Tools\FirstEpssQuery;
use OpenCompany\Integrations\FirstEpss\Tools\FirstEpssThreshold;
use OpenCompany\Integrations\FirstEpss\Tools\FirstEpssTimeSeries;
use OpenCompany\Integrations\FirstEpss\Tools\FirstEpssTop;

/**
 * Tool catalog and metadata for FIRST EPSS.
 *
 * Exposes the public Exploit Prediction Scoring System API query modes for
 * CVE lookup, batches, top scores, thresholds, time series, and CSV locations.
 */
class FirstEpssToolProvider implements ToolProvider, HasIntegrationCapabilities
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
                'notes' => ['FIRST EPSS is public and requires no API key. Public endpoints are rate limited by FIRST.'],
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
        return 'first-epss';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'FIRST EPSS',
            'description' => 'Exploit Prediction Scoring System probabilities and percentiles for CVEs',
            'icon' => 'ph:chart-line-up',
            'logo' => 'ph:chart-line-up',
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
            'name' => 'FIRST EPSS',
            'description' => 'FIRST Exploit Prediction Scoring System API for CVE exploitation probability, percentile ranking, date-specific scores, threshold queries, time series, and historical CSV score file URLs.',
            'icon' => 'ph:chart-line-up',
            'logo' => 'ph:chart-line-up',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://www.first.org/epss/api',
        ];
    }

    public function credentialFields(): array
    {
        return [];
    }

    public function tools(): array
    {
        return [
            'first_epss_query' => ['class' => FirstEpssQuery::class, 'type' => 'read', 'name' => 'Query', 'description' => 'Run a general EPSS API query with official parameters.', 'icon' => 'ph:magnifying-glass'],
            'first_epss_cve' => ['class' => FirstEpssCve::class, 'type' => 'read', 'name' => 'CVE', 'description' => 'Get EPSS score for one CVE.', 'icon' => 'ph:bug'],
            'first_epss_batch' => ['class' => FirstEpssBatch::class, 'type' => 'read', 'name' => 'Batch', 'description' => 'Get EPSS scores for multiple CVEs.', 'icon' => 'ph:list-magnifying-glass'],
            'first_epss_time_series' => ['class' => FirstEpssTimeSeries::class, 'type' => 'read', 'name' => 'Time Series', 'description' => 'Get EPSS time-series scores for one CVE.', 'icon' => 'ph:chart-line'],
            'first_epss_top' => ['class' => FirstEpssTop::class, 'type' => 'read', 'name' => 'Top', 'description' => 'List highest EPSS or percentile CVEs.', 'icon' => 'ph:ranking'],
            'first_epss_threshold' => ['class' => FirstEpssThreshold::class, 'type' => 'read', 'name' => 'Threshold', 'description' => 'List CVEs above EPSS or percentile thresholds.', 'icon' => 'ph:funnel'],
            'first_epss_historical_csv_url' => ['class' => FirstEpssHistoricalCsvUrl::class, 'type' => 'read', 'name' => 'Historical CSV URL', 'description' => 'Return the official historical daily EPSS CSV gzip URL for a date.', 'icon' => 'ph:file-csv'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a FIRST EPSS tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional tool context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class(app(FirstEpssService::class));
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/first-epss.md';
    }
}
