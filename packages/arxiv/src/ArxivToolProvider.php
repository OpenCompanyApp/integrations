<?php

namespace OpenCompany\Integrations\Arxiv;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and metadata for arXiv.
 *
 * Exposes the official arXiv Atom query API and OAI-PMH metadata endpoint
 * without requiring credentials.
 */
class ArxivToolProvider implements ToolProvider, HasIntegrationCapabilities
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
                'notes' => ['The arXiv APIs are public and return XML. Respect arXiv request pacing for repeated calls and use OAI resumption tokens for harvesting.'],
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
        return 'arxiv';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'arXiv',
            'description' => 'Open preprint search and metadata harvesting',
            'icon' => 'ph:book-open-text',
            'logo' => 'simple-icons:arxiv',
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
            'name' => 'arXiv',
            'description' => 'Public arXiv Atom API and OAI-PMH endpoint for searching preprints, retrieving papers, and harvesting metadata.',
            'icon' => 'ph:book-open-text',
            'logo' => 'simple-icons:arxiv',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://info.arxiv.org/help/api/user-manual.html',
        ];
    }

    public function tools(): array
    {
        return [
            'arxiv_search_papers' => [
                'class' => 'OpenCompany\\Integrations\\Arxiv\\Tools\\ArxivSearchPapers',
                'type' => 'read',
                'name' => 'Search Papers',
                'description' => 'Search arXiv papers with the official query syntax, paging, and sorting.',
                'icon' => 'ph:magnifying-glass',
            ],
            'arxiv_get_papers' => [
                'class' => 'OpenCompany\\Integrations\\Arxiv\\Tools\\ArxivGetPapers',
                'type' => 'read',
                'name' => 'Get Papers',
                'description' => 'Retrieve paper metadata by one or more arXiv IDs.',
                'icon' => 'ph:article',
            ],
            'arxiv_search_by_author' => [
                'class' => 'OpenCompany\\Integrations\\Arxiv\\Tools\\ArxivSearchByAuthor',
                'type' => 'read',
                'name' => 'Search by Author',
                'description' => 'Search arXiv papers by author name.',
                'icon' => 'ph:user-list',
            ],
            'arxiv_search_by_title' => [
                'class' => 'OpenCompany\\Integrations\\Arxiv\\Tools\\ArxivSearchByTitle',
                'type' => 'read',
                'name' => 'Search by Title',
                'description' => 'Search arXiv papers by title text.',
                'icon' => 'ph:text-t',
            ],
            'arxiv_search_by_category' => [
                'class' => 'OpenCompany\\Integrations\\Arxiv\\Tools\\ArxivSearchByCategory',
                'type' => 'read',
                'name' => 'Search by Category',
                'description' => 'Search recent arXiv papers by category code.',
                'icon' => 'ph:tag',
            ],
            'arxiv_search_recent' => [
                'class' => 'OpenCompany\\Integrations\\Arxiv\\Tools\\ArxivSearchRecent',
                'type' => 'read',
                'name' => 'Search Recent',
                'description' => 'Search arXiv with newest submissions first.',
                'icon' => 'ph:clock-countdown',
            ],
            'arxiv_oai_identify' => [
                'class' => 'OpenCompany\\Integrations\\Arxiv\\Tools\\ArxivOaiIdentify',
                'type' => 'read',
                'name' => 'OAI Identify',
                'description' => 'Read arXiv OAI-PMH repository metadata.',
                'icon' => 'ph:database',
            ],
            'arxiv_oai_list_metadata_formats' => [
                'class' => 'OpenCompany\\Integrations\\Arxiv\\Tools\\ArxivOaiListMetadataFormats',
                'type' => 'read',
                'name' => 'OAI Metadata Formats',
                'description' => 'List OAI-PMH metadata formats supported by arXiv.',
                'icon' => 'ph:list-bullets',
            ],
            'arxiv_oai_list_sets' => [
                'class' => 'OpenCompany\\Integrations\\Arxiv\\Tools\\ArxivOaiListSets',
                'type' => 'read',
                'name' => 'OAI Sets',
                'description' => 'List arXiv OAI-PMH sets.',
                'icon' => 'ph:folders',
            ],
            'arxiv_oai_list_identifiers' => [
                'class' => 'OpenCompany\\Integrations\\Arxiv\\Tools\\ArxivOaiListIdentifiers',
                'type' => 'read',
                'name' => 'OAI Identifiers',
                'description' => 'List OAI-PMH identifiers and datestamps.',
                'icon' => 'ph:identification-card',
            ],
            'arxiv_oai_list_records' => [
                'class' => 'OpenCompany\\Integrations\\Arxiv\\Tools\\ArxivOaiListRecords',
                'type' => 'read',
                'name' => 'OAI Records',
                'description' => 'List OAI-PMH metadata records.',
                'icon' => 'ph:archive',
            ],
            'arxiv_oai_get_record' => [
                'class' => 'OpenCompany\\Integrations\\Arxiv\\Tools\\ArxivOaiGetRecord',
                'type' => 'read',
                'name' => 'OAI Get Record',
                'description' => 'Retrieve one OAI-PMH metadata record by identifier.',
                'icon' => 'ph:file-text',
            ],
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
     * Create an arXiv tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional context, unused for public endpoints.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class(app(ArxivService::class));
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/arxiv.md';
    }
}
