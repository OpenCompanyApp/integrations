<?php

namespace OpenCompany\Integrations\PubMed;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\PubMed\Tools\PubMedCitationMatch;
use OpenCompany\Integrations\PubMed\Tools\PubMedFetch;
use OpenCompany\Integrations\PubMed\Tools\PubMedGlobalQuery;
use OpenCompany\Integrations\PubMed\Tools\PubMedInfo;
use OpenCompany\Integrations\PubMed\Tools\PubMedLink;
use OpenCompany\Integrations\PubMed\Tools\PubMedPost;
use OpenCompany\Integrations\PubMed\Tools\PubMedSearch;
use OpenCompany\Integrations\PubMed\Tools\PubMedSpell;
use OpenCompany\Integrations\PubMed\Tools\PubMedSummary;

/**
 * Tool catalog and metadata for PubMed and NCBI E-utilities.
 *
 * Exposes the public E-utilities suite with PubMed-first defaults and optional
 * NCBI identity/API-key parameters for compliant higher-volume use.
 */
class PubMedToolProvider implements ToolProvider, HasIntegrationCapabilities
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
                'notes' => ['NCBI E-utilities are public. api_key, email, and tool can be supplied per call for higher rate limits and NCBI usage compliance.'],
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
        return 'pubmed';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'PubMed',
            'description' => 'PubMed search, summaries, full records, links, spelling, and citation matching',
            'icon' => 'ph:first-aid-kit',
            'logo' => 'simple-icons:pubmed',
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
            'name' => 'PubMed',
            'description' => 'Public PubMed and NCBI Entrez E-utilities API for biomedical search, retrieval, History server workflows, links, spelling, global counts, and citation matching.',
            'icon' => 'ph:first-aid-kit',
            'logo' => 'simple-icons:pubmed',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://www.ncbi.nlm.nih.gov/books/NBK25499/',
        ];
    }

    public function tools(): array
    {
        return [
            'pubmed_search' => ['class' => PubMedSearch::class, 'type' => 'read', 'name' => 'Search', 'description' => 'Search PubMed or another Entrez database with ESearch.', 'icon' => 'ph:magnifying-glass'],
            'pubmed_summary' => ['class' => PubMedSummary::class, 'type' => 'read', 'name' => 'Summary', 'description' => 'Retrieve document summaries with ESummary.', 'icon' => 'ph:list-bullets'],
            'pubmed_fetch' => ['class' => PubMedFetch::class, 'type' => 'read', 'name' => 'Fetch', 'description' => 'Fetch full records or abstracts with EFetch.', 'icon' => 'ph:article'],
            'pubmed_link' => ['class' => PubMedLink::class, 'type' => 'read', 'name' => 'Link', 'description' => 'Retrieve related records and LinkOut URLs with ELink.', 'icon' => 'ph:link'],
            'pubmed_info' => ['class' => PubMedInfo::class, 'type' => 'read', 'name' => 'Info', 'description' => 'Inspect Entrez database fields and link names with EInfo.', 'icon' => 'ph:database'],
            'pubmed_post' => ['class' => PubMedPost::class, 'type' => 'write', 'name' => 'Post IDs', 'description' => 'Post IDs to the NCBI History server with EPost.', 'icon' => 'ph:upload-simple'],
            'pubmed_spell' => ['class' => PubMedSpell::class, 'type' => 'read', 'name' => 'Spell', 'description' => 'Get spelling suggestions with ESpell.', 'icon' => 'ph:text-aa'],
            'pubmed_global_query' => ['class' => PubMedGlobalQuery::class, 'type' => 'read', 'name' => 'Global Query', 'description' => 'Search all Entrez databases and return hit counts with EGQuery.', 'icon' => 'ph:globe'],
            'pubmed_citation_match' => ['class' => PubMedCitationMatch::class, 'type' => 'read', 'name' => 'Citation Match', 'description' => 'Match formatted citation strings to PubMed IDs with ECitMatch.', 'icon' => 'ph:quotes'],
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
     * Create a PubMed tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional context, unused for public endpoints.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class(app(PubMedService::class));
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/pubmed.md';
    }
}
