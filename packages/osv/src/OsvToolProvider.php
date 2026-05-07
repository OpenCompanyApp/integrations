<?php

namespace OpenCompany\Integrations\Osv;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Osv\Tools\OsvDetermineVersion;
use OpenCompany\Integrations\Osv\Tools\OsvGetVulnerability;
use OpenCompany\Integrations\Osv\Tools\OsvImportFindings;
use OpenCompany\Integrations\Osv\Tools\OsvQuery;
use OpenCompany\Integrations\Osv\Tools\OsvQueryBatch;

/**
 * Tool catalog and metadata for OSV.dev.
 *
 * Exposes the complete documented public OSV API surface, including the two
 * experimental endpoints for import findings and C/C++ version determination.
 */
class OsvToolProvider implements ToolProvider, HasIntegrationCapabilities
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
                'notes' => ['OSV.dev APIs are public and currently require no API key.'],
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
        return 'osv';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'OSV',
            'description' => 'Query OSV.dev open source vulnerability records by package, commit, batch, or OSV ID',
            'icon' => 'ph:shield-warning',
            'logo' => 'ph:shield-warning',
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
            'name' => 'OSV',
            'description' => 'OSV.dev API for open source vulnerability lookup by package version, git commit, batch query, vulnerability ID, import-quality findings, and experimental C/C++ version determination.',
            'icon' => 'ph:shield-warning',
            'logo' => 'ph:shield-warning',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://google.github.io/osv.dev/api/',
        ];
    }

    public function tools(): array
    {
        return [
            'osv_query' => ['class' => OsvQuery::class, 'type' => 'read', 'name' => 'Query', 'description' => 'Query vulnerabilities for one package version, purl, or commit.', 'icon' => 'ph:magnifying-glass'],
            'osv_query_batch' => ['class' => OsvQueryBatch::class, 'type' => 'read', 'name' => 'Query Batch', 'description' => 'Query vulnerabilities for multiple package versions or commits.', 'icon' => 'ph:list-magnifying-glass'],
            'osv_get_vulnerability' => ['class' => OsvGetVulnerability::class, 'type' => 'read', 'name' => 'Get Vulnerability', 'description' => 'Retrieve one OSV vulnerability record by ID.', 'icon' => 'ph:bug'],
            'osv_import_findings' => ['class' => OsvImportFindings::class, 'type' => 'read', 'name' => 'Import Findings', 'description' => 'Retrieve experimental import-quality findings for a source.', 'icon' => 'ph:clipboard-text'],
            'osv_determine_version' => ['class' => OsvDetermineVersion::class, 'type' => 'read', 'name' => 'Determine Version', 'description' => 'Experimentally identify likely C/C++ library versions from file hashes.', 'icon' => 'ph:git-branch'],
        ];
    }

    public function credentialFields(): array
    {
        return [];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create an OSV tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional tool context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class(app(OsvService::class));
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/osv.md';
    }
}
