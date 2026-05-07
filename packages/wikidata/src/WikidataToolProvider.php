<?php

namespace OpenCompany\Integrations\Wikidata;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Wikidata\Tools\WikidataEntityDataUrl;
use OpenCompany\Integrations\Wikidata\Tools\WikidataEntityPageUrl;
use OpenCompany\Integrations\Wikidata\Tools\WikidataGetClaims;
use OpenCompany\Integrations\Wikidata\Tools\WikidataGetEntities;
use OpenCompany\Integrations\Wikidata\Tools\WikidataSearchEntities;
use OpenCompany\Integrations\Wikidata\Tools\WikidataSparql;

/**
 * Tool catalog and metadata for Wikidata.
 *
 * Exposes read-only public Wikibase API lookups, Wikidata Query Service SPARQL
 * access, and deterministic entity URL builders.
 */
class WikidataToolProvider implements ToolProvider, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => ['strategy' => 'none', 'legacy_auth_type' => 'none', 'credential_mode' => 'none', 'setup_flows' => ['none'], 'requires_browser_for_setup' => false, 'refreshable' => false, 'token_keys' => [], 'notes' => ['Wikidata read APIs are public and require no credentials.']],
            'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'none'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'none', 'runtime_mode' => 'normal']],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string
    {
        return 'wikidata';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return ['label' => 'Wikidata', 'description' => 'Search and query the public Wikidata knowledge graph', 'icon' => 'ph:graph', 'logo' => 'ph:graph'];
    }

    /**
     * Canonical integration metadata used by settings and generated catalogs.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return ['name' => 'Wikidata', 'description' => 'Wikidata public APIs for entity search, entity retrieval, claims, SPARQL queries, and entity data/page URLs.', 'icon' => 'ph:graph', 'logo' => 'ph:graph', 'category' => 'data', 'badge' => 'verified', 'docs_url' => 'https://www.wikidata.org/wiki/Wikidata:Data_access'];
    }

    public function credentialFields(): array
    {
        return [];
    }

    public function tools(): array
    {
        return [
            'wikidata_search_entities' => ['class' => WikidataSearchEntities::class, 'type' => 'read', 'name' => 'Search Entities', 'description' => 'Search Wikidata items or properties.', 'icon' => 'ph:magnifying-glass'],
            'wikidata_get_entities' => ['class' => WikidataGetEntities::class, 'type' => 'read', 'name' => 'Get Entities', 'description' => 'Retrieve Wikidata entities by IDs or site/title pairs.', 'icon' => 'ph:database'],
            'wikidata_get_claims' => ['class' => WikidataGetClaims::class, 'type' => 'read', 'name' => 'Get Claims', 'description' => 'Retrieve Wikidata claims for an entity, property, or claim ID.', 'icon' => 'ph:list-checks'],
            'wikidata_sparql' => ['class' => WikidataSparql::class, 'type' => 'read', 'name' => 'SPARQL', 'description' => 'Run a Wikidata Query Service SPARQL query.', 'icon' => 'ph:brackets-curly'],
            'wikidata_entity_data_url' => ['class' => WikidataEntityDataUrl::class, 'type' => 'read', 'name' => 'Entity Data URL', 'description' => 'Build a Special:EntityData URL for JSON/RDF/Turtle/N-Triples/N3.', 'icon' => 'ph:link'],
            'wikidata_entity_page_url' => ['class' => WikidataEntityPageUrl::class, 'type' => 'read', 'name' => 'Entity Page URL', 'description' => 'Build a canonical Wikidata entity page URL.', 'icon' => 'ph:globe'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a Wikidata tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional tool context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class(app(WikidataService::class));
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/wikidata.md';
    }
}
