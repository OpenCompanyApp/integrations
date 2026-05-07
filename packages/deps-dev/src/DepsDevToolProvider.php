<?php

namespace OpenCompany\Integrations\DepsDev;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\DepsDev\Tools\DepsDevAdvisory;
use OpenCompany\Integrations\DepsDev\Tools\DepsDevDependencies;
use OpenCompany\Integrations\DepsDev\Tools\DepsDevPackage;
use OpenCompany\Integrations\DepsDev\Tools\DepsDevProject;
use OpenCompany\Integrations\DepsDev\Tools\DepsDevProjectPackageVersions;
use OpenCompany\Integrations\DepsDev\Tools\DepsDevQuery;
use OpenCompany\Integrations\DepsDev\Tools\DepsDevRequirements;
use OpenCompany\Integrations\DepsDev\Tools\DepsDevVersion;

/**
 * Tool catalog and metadata for deps.dev.
 *
 * Exposes the stable v3 Open Source Insights API endpoints for packages,
 * package versions, dependencies, projects, advisories, and query lookups.
 */
class DepsDevToolProvider implements ToolProvider, HasIntegrationCapabilities
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
                'notes' => ['deps.dev API v3 is public and requires no API key.'],
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
        return 'deps-dev';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'deps.dev',
            'description' => 'Open Source Insights package, dependency, project, and advisory data',
            'icon' => 'ph:tree-structure',
            'logo' => 'ph:tree-structure',
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
            'name' => 'deps.dev',
            'description' => 'deps.dev Open Source Insights API for package versions, version metadata, requirements, resolved dependencies, project metadata, package-version mappings, advisories, and file hash or version queries.',
            'icon' => 'ph:tree-structure',
            'logo' => 'ph:tree-structure',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://docs.deps.dev/api/v3/',
        ];
    }

    public function credentialFields(): array
    {
        return [];
    }

    public function tools(): array
    {
        return [
            'deps_dev_package' => ['class' => DepsDevPackage::class, 'type' => 'read', 'name' => 'Package', 'description' => 'Retrieve package metadata and available versions.', 'icon' => 'ph:package'],
            'deps_dev_version' => ['class' => DepsDevVersion::class, 'type' => 'read', 'name' => 'Version', 'description' => 'Retrieve metadata for one package version.', 'icon' => 'ph:tag'],
            'deps_dev_requirements' => ['class' => DepsDevRequirements::class, 'type' => 'read', 'name' => 'Requirements', 'description' => 'Retrieve declared dependency requirements for one version.', 'icon' => 'ph:list-checks'],
            'deps_dev_dependencies' => ['class' => DepsDevDependencies::class, 'type' => 'read', 'name' => 'Dependencies', 'description' => 'Retrieve the resolved dependency graph for one version.', 'icon' => 'ph:graph'],
            'deps_dev_project' => ['class' => DepsDevProject::class, 'type' => 'read', 'name' => 'Project', 'description' => 'Retrieve project metadata for a source repository.', 'icon' => 'ph:git-branch'],
            'deps_dev_project_package_versions' => ['class' => DepsDevProjectPackageVersions::class, 'type' => 'read', 'name' => 'Project Package Versions', 'description' => 'Retrieve package versions built from a source project.', 'icon' => 'ph:git-commit'],
            'deps_dev_advisory' => ['class' => DepsDevAdvisory::class, 'type' => 'read', 'name' => 'Advisory', 'description' => 'Retrieve one OSV advisory from deps.dev.', 'icon' => 'ph:bug'],
            'deps_dev_query' => ['class' => DepsDevQuery::class, 'type' => 'read', 'name' => 'Query', 'description' => 'Query package versions by content hash, version key, or both.', 'icon' => 'ph:magnifying-glass'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a deps.dev tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional tool context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class(app(DepsDevService::class));
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/deps-dev.md';
    }
}
