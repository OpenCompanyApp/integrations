<?php

namespace OpenCompany\Integrations\EuropePmc;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\EuropePmc\Tools\EuropePmcAnnotationsByArticleIds;
use OpenCompany\Integrations\EuropePmc\Tools\EuropePmcAnnotationsByEntity;
use OpenCompany\Integrations\EuropePmc\Tools\EuropePmcAnnotationsByProvider;
use OpenCompany\Integrations\EuropePmc\Tools\EuropePmcAnnotationsByRelationship;
use OpenCompany\Integrations\EuropePmc\Tools\EuropePmcAnnotationsBySectionOrType;
use OpenCompany\Integrations\EuropePmc\Tools\EuropePmcArticle;
use OpenCompany\Integrations\EuropePmc\Tools\EuropePmcBookXml;
use OpenCompany\Integrations\EuropePmc\Tools\EuropePmcCitations;
use OpenCompany\Integrations\EuropePmc\Tools\EuropePmcDatabaseLinks;
use OpenCompany\Integrations\EuropePmc\Tools\EuropePmcDataLinks;
use OpenCompany\Integrations\EuropePmc\Tools\EuropePmcEvaluations;
use OpenCompany\Integrations\EuropePmc\Tools\EuropePmcFields;
use OpenCompany\Integrations\EuropePmc\Tools\EuropePmcFullTextXml;
use OpenCompany\Integrations\EuropePmc\Tools\EuropePmcGrantsSearch;
use OpenCompany\Integrations\EuropePmc\Tools\EuropePmcLabsLinks;
use OpenCompany\Integrations\EuropePmc\Tools\EuropePmcMetrics;
use OpenCompany\Integrations\EuropePmc\Tools\EuropePmcProfile;
use OpenCompany\Integrations\EuropePmc\Tools\EuropePmcReferences;
use OpenCompany\Integrations\EuropePmc\Tools\EuropePmcSearch;
use OpenCompany\Integrations\EuropePmc\Tools\EuropePmcSearchPost;
use OpenCompany\Integrations\EuropePmc\Tools\EuropePmcStatusUpdateSearch;
use OpenCompany\Integrations\EuropePmc\Tools\EuropePmcSupplementaryFiles;

/**
 * Tool catalog and metadata for Europe PMC.
 *
 * Exposes public literature metadata, full-text, citation-network,
 * annotations, and grant-search APIs without credentials.
 */
class EuropePmcToolProvider implements ToolProvider, HasIntegrationCapabilities
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
                'notes' => ['Europe PMC Articles, Annotations, and GRIST grants APIs are public. Pass email per call when you want Europe PMC to contact you about service usage.'],
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
        return 'europe-pmc';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Europe PMC',
            'description' => 'Biomedical literature, citations, full text, annotations, and grants',
            'icon' => 'ph:books',
            'logo' => 'ph:books',
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
            'name' => 'Europe PMC',
            'description' => 'Public Europe PMC APIs for publication search, article metadata, references, citations, full-text XML, database links, annotations, metrics, profiles, and GRIST grant search.',
            'icon' => 'ph:books',
            'logo' => 'ph:books',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://europepmc.org/RestfulWebService',
        ];
    }

    public function tools(): array
    {
        return [
            'europe_pmc_search' => ['class' => EuropePmcSearch::class, 'type' => 'read', 'name' => 'Search', 'description' => 'Search Europe PMC publications with GET /search.', 'icon' => 'ph:magnifying-glass'],
            'europe_pmc_search_post' => ['class' => EuropePmcSearchPost::class, 'type' => 'read', 'name' => 'Search POST', 'description' => 'Search Europe PMC publications with POST /searchPOST for long queries.', 'icon' => 'ph:magnifying-glass'],
            'europe_pmc_article' => ['class' => EuropePmcArticle::class, 'type' => 'read', 'name' => 'Article', 'description' => 'Get one article by source and external ID.', 'icon' => 'ph:article'],
            'europe_pmc_references' => ['class' => EuropePmcReferences::class, 'type' => 'read', 'name' => 'References', 'description' => 'List publications referenced by an article.', 'icon' => 'ph:list-bullets'],
            'europe_pmc_citations' => ['class' => EuropePmcCitations::class, 'type' => 'read', 'name' => 'Citations', 'description' => 'List publications citing an article.', 'icon' => 'ph:quotes'],
            'europe_pmc_database_links' => ['class' => EuropePmcDatabaseLinks::class, 'type' => 'read', 'name' => 'Database Links', 'description' => 'List biological database cross-references for an article.', 'icon' => 'ph:database'],
            'europe_pmc_labs_links' => ['class' => EuropePmcLabsLinks::class, 'type' => 'read', 'name' => 'Labs Links', 'description' => 'List third-party external links for an article.', 'icon' => 'ph:link'],
            'europe_pmc_data_links' => ['class' => EuropePmcDataLinks::class, 'type' => 'read', 'name' => 'Data Links', 'description' => 'Return consolidated Scholix data-literature links.', 'icon' => 'ph:graph'],
            'europe_pmc_evaluations' => ['class' => EuropePmcEvaluations::class, 'type' => 'read', 'name' => 'Evaluations', 'description' => 'Get evaluations for an article.', 'icon' => 'ph:clipboard-text'],
            'europe_pmc_full_text_xml' => ['class' => EuropePmcFullTextXml::class, 'type' => 'read', 'name' => 'Full Text XML', 'description' => 'Retrieve Open Access full-text XML by article ID.', 'icon' => 'ph:file-code'],
            'europe_pmc_book_xml' => ['class' => EuropePmcBookXml::class, 'type' => 'read', 'name' => 'Book XML', 'description' => 'Retrieve bookshelf XML by article ID.', 'icon' => 'ph:book-open-text'],
            'europe_pmc_supplementary_files' => ['class' => EuropePmcSupplementaryFiles::class, 'type' => 'read', 'name' => 'Supplementary Files', 'description' => 'Retrieve supplementary file archive for an article when available.', 'icon' => 'ph:paperclip'],
            'europe_pmc_fields' => ['class' => EuropePmcFields::class, 'type' => 'read', 'name' => 'Fields', 'description' => 'List indexed search fields.', 'icon' => 'ph:list-checks'],
            'europe_pmc_profile' => ['class' => EuropePmcProfile::class, 'type' => 'read', 'name' => 'Profile', 'description' => 'Get result-count profiles by publication type and source.', 'icon' => 'ph:chart-pie'],
            'europe_pmc_metrics' => ['class' => EuropePmcMetrics::class, 'type' => 'read', 'name' => 'Metrics', 'description' => 'Read Europe PMC service metrics.', 'icon' => 'ph:chart-line'],
            'europe_pmc_status_update_search' => ['class' => EuropePmcStatusUpdateSearch::class, 'type' => 'read', 'name' => 'Status Update Search', 'description' => 'Search article status updates.', 'icon' => 'ph:activity'],
            'europe_pmc_annotations_by_article_ids' => ['class' => EuropePmcAnnotationsByArticleIds::class, 'type' => 'read', 'name' => 'Annotations by Articles', 'description' => 'Get annotations for one or more article IDs.', 'icon' => 'ph:highlighter'],
            'europe_pmc_annotations_by_entity' => ['class' => EuropePmcAnnotationsByEntity::class, 'type' => 'read', 'name' => 'Annotations by Entity', 'description' => 'Find annotations tagging a specific entity.', 'icon' => 'ph:tag'],
            'europe_pmc_annotations_by_provider' => ['class' => EuropePmcAnnotationsByProvider::class, 'type' => 'read', 'name' => 'Annotations by Provider', 'description' => 'Find annotations supplied by a provider.', 'icon' => 'ph:user-list'],
            'europe_pmc_annotations_by_relationship' => ['class' => EuropePmcAnnotationsByRelationship::class, 'type' => 'read', 'name' => 'Annotations by Relationship', 'description' => 'Find relationship annotations between two entities.', 'icon' => 'ph:graph'],
            'europe_pmc_annotations_by_section_or_type' => ['class' => EuropePmcAnnotationsBySectionOrType::class, 'type' => 'read', 'name' => 'Annotations by Section or Type', 'description' => 'Find annotations by article section and/or annotation type.', 'icon' => 'ph:selection'],
            'europe_pmc_grants_search' => ['class' => EuropePmcGrantsSearch::class, 'type' => 'read', 'name' => 'Grants Search', 'description' => 'Search the GRIST grants database.', 'icon' => 'ph:hand-coins'],
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
     * Create a Europe PMC tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional context, unused for public endpoints.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class(app(EuropePmcService::class));
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/europe-pmc.md';
    }
}
