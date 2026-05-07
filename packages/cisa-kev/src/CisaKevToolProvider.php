<?php

namespace OpenCompany\Integrations\CisaKev;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\CisaKev\Tools\CisaKevCatalog;
use OpenCompany\Integrations\CisaKev\Tools\CisaKevCsv;
use OpenCompany\Integrations\CisaKev\Tools\CisaKevGetVulnerability;
use OpenCompany\Integrations\CisaKev\Tools\CisaKevLicense;
use OpenCompany\Integrations\CisaKev\Tools\CisaKevRecent;
use OpenCompany\Integrations\CisaKev\Tools\CisaKevSchema;
use OpenCompany\Integrations\CisaKev\Tools\CisaKevSearch;

/**
 * Tool catalog and metadata for the CISA KEV catalog.
 *
 * Exposes CISA's public Known Exploited Vulnerabilities JSON feed, CSV export,
 * JSON schema, license, and agent-focused filtered views over the catalog.
 */
class CisaKevToolProvider implements ToolProvider, HasIntegrationCapabilities
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
                'notes' => ['CISA KEV catalog feeds are public and require no API key.'],
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
        return 'cisa-kev';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'CISA KEV',
            'description' => 'Known Exploited Vulnerabilities catalog, schema, CSV, and filtered CVE lookup',
            'icon' => 'ph:warning-octagon',
            'logo' => 'ph:warning-octagon',
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
            'name' => 'CISA KEV',
            'description' => 'CISA Known Exploited Vulnerabilities catalog feed for exploited CVEs, required actions, due dates, ransomware usage flags, schema, CSV export, and license.',
            'icon' => 'ph:warning-octagon',
            'logo' => 'ph:warning-octagon',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://www.cisa.gov/known-exploited-vulnerabilities-catalog',
        ];
    }

    public function credentialFields(): array
    {
        return [];
    }

    public function tools(): array
    {
        return [
            'cisa_kev_catalog' => ['class' => CisaKevCatalog::class, 'type' => 'read', 'name' => 'Catalog', 'description' => 'Retrieve the full CISA KEV JSON catalog.', 'icon' => 'ph:list-bullets'],
            'cisa_kev_search' => ['class' => CisaKevSearch::class, 'type' => 'read', 'name' => 'Search', 'description' => 'Search and filter CISA KEV vulnerabilities client-side.', 'icon' => 'ph:magnifying-glass'],
            'cisa_kev_get_vulnerability' => ['class' => CisaKevGetVulnerability::class, 'type' => 'read', 'name' => 'Get Vulnerability', 'description' => 'Retrieve one KEV catalog entry by CVE ID.', 'icon' => 'ph:bug'],
            'cisa_kev_recent' => ['class' => CisaKevRecent::class, 'type' => 'read', 'name' => 'Recent', 'description' => 'List recently added KEV catalog entries.', 'icon' => 'ph:clock-counter-clockwise'],
            'cisa_kev_schema' => ['class' => CisaKevSchema::class, 'type' => 'read', 'name' => 'Schema', 'description' => 'Retrieve the official CISA KEV JSON schema.', 'icon' => 'ph:file-code'],
            'cisa_kev_csv' => ['class' => CisaKevCsv::class, 'type' => 'read', 'name' => 'CSV', 'description' => 'Retrieve the official CISA KEV CSV export.', 'icon' => 'ph:file-csv'],
            'cisa_kev_license' => ['class' => CisaKevLicense::class, 'type' => 'read', 'name' => 'License', 'description' => 'Retrieve the CISA KEV feed license text.', 'icon' => 'ph:scroll'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a CISA KEV tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional tool context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class(app(CisaKevService::class));
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/cisa-kev.md';
    }
}
