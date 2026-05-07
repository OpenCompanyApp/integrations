<?php

namespace OpenCompany\Integrations\DataCite;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\DataCite\Tools\DataCiteClientStats;
use OpenCompany\Integrations\DataCite\Tools\DataCiteGetActivity;
use OpenCompany\Integrations\DataCite\Tools\DataCiteGetClient;
use OpenCompany\Integrations\DataCite\Tools\DataCiteGetDoi;
use OpenCompany\Integrations\DataCite\Tools\DataCiteGetDoiActivities;
use OpenCompany\Integrations\DataCite\Tools\DataCiteGetEvent;
use OpenCompany\Integrations\DataCite\Tools\DataCiteGetPrefix;
use OpenCompany\Integrations\DataCite\Tools\DataCiteGetProvider;
use OpenCompany\Integrations\DataCite\Tools\DataCiteGetReport;
use OpenCompany\Integrations\DataCite\Tools\DataCiteGraphqlQuery;
use OpenCompany\Integrations\DataCite\Tools\DataCiteHeartbeat;
use OpenCompany\Integrations\DataCite\Tools\DataCiteListActivities;
use OpenCompany\Integrations\DataCite\Tools\DataCiteListClientPrefixes;
use OpenCompany\Integrations\DataCite\Tools\DataCiteListClients;
use OpenCompany\Integrations\DataCite\Tools\DataCiteListDois;
use OpenCompany\Integrations\DataCite\Tools\DataCiteListEvents;
use OpenCompany\Integrations\DataCite\Tools\DataCiteListPrefixes;
use OpenCompany\Integrations\DataCite\Tools\DataCiteListProviderPrefixes;
use OpenCompany\Integrations\DataCite\Tools\DataCiteListProviders;
use OpenCompany\Integrations\DataCite\Tools\DataCiteListReports;
use OpenCompany\Integrations\DataCite\Tools\DataCitePrefixStats;
use OpenCompany\Integrations\DataCite\Tools\DataCiteProviderStats;

/**
 * Tool catalog and metadata for DataCite.
 *
 * Exposes public read/query surfaces from the current REST API plus GraphQL,
 * while excluding DOI mutation endpoints that require repository credentials.
 */
class DataCiteToolProvider implements ToolProvider, HasIntegrationCapabilities
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
                'notes' => ['Public DataCite retrieval endpoints require no authentication. Create, update, and delete endpoints are intentionally excluded.'],
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
        return 'datacite';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'DataCite',
            'description' => 'DOI metadata, repositories, providers, prefixes, events, reports, activities, and GraphQL',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:datacite',
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
            'name' => 'DataCite',
            'description' => 'Public DataCite APIs for DOI metadata, clients, providers, prefixes, Event Data, reports, activities, heartbeat, and GraphQL queries.',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:datacite',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://support.datacite.org/reference/introduction',
        ];
    }

    public function tools(): array
    {
        return [
            'datacite_list_activities' => ['class' => DataCiteListActivities::class, 'type' => 'read', 'name' => 'List Activities', 'description' => 'List DataCite activity records.', 'icon' => 'ph:activity'],
            'datacite_get_activity' => ['class' => DataCiteGetActivity::class, 'type' => 'read', 'name' => 'Get Activity', 'description' => 'Get a DataCite activity record.', 'icon' => 'ph:activity'],
            'datacite_list_client_prefixes' => ['class' => DataCiteListClientPrefixes::class, 'type' => 'read', 'name' => 'List Client Prefixes', 'description' => 'List client-prefix records.', 'icon' => 'ph:link'],
            'datacite_list_clients' => ['class' => DataCiteListClients::class, 'type' => 'read', 'name' => 'List Clients', 'description' => 'List DataCite clients/repositories.', 'icon' => 'ph:archive'],
            'datacite_client_stats' => ['class' => DataCiteClientStats::class, 'type' => 'read', 'name' => 'Client Stats', 'description' => 'Get clients DOI production statistics.', 'icon' => 'ph:chart-bar'],
            'datacite_get_client' => ['class' => DataCiteGetClient::class, 'type' => 'read', 'name' => 'Get Client', 'description' => 'Get one DataCite client/repository.', 'icon' => 'ph:archive'],
            'datacite_list_dois' => ['class' => DataCiteListDois::class, 'type' => 'read', 'name' => 'List DOIs', 'description' => 'List, search, filter, sort, sample, or page DOI metadata.', 'icon' => 'ph:link'],
            'datacite_get_doi' => ['class' => DataCiteGetDoi::class, 'type' => 'read', 'name' => 'Get DOI', 'description' => 'Get one DOI metadata record.', 'icon' => 'ph:link'],
            'datacite_get_doi_activities' => ['class' => DataCiteGetDoiActivities::class, 'type' => 'read', 'name' => 'DOI Activities', 'description' => 'Get activities for a DOI.', 'icon' => 'ph:activity'],
            'datacite_list_events' => ['class' => DataCiteListEvents::class, 'type' => 'read', 'name' => 'List Events', 'description' => 'List DataCite Event Data records.', 'icon' => 'ph:graph'],
            'datacite_get_event' => ['class' => DataCiteGetEvent::class, 'type' => 'read', 'name' => 'Get Event', 'description' => 'Get one Event Data record.', 'icon' => 'ph:graph'],
            'datacite_heartbeat' => ['class' => DataCiteHeartbeat::class, 'type' => 'read', 'name' => 'Heartbeat', 'description' => 'Check REST API status.', 'icon' => 'ph:heartbeat'],
            'datacite_list_prefixes' => ['class' => DataCiteListPrefixes::class, 'type' => 'read', 'name' => 'List Prefixes', 'description' => 'List DOI prefixes.', 'icon' => 'ph:number-circle-one'],
            'datacite_prefix_stats' => ['class' => DataCitePrefixStats::class, 'type' => 'read', 'name' => 'Prefix Stats', 'description' => 'Get prefixes DOI production statistics.', 'icon' => 'ph:chart-bar'],
            'datacite_get_prefix' => ['class' => DataCiteGetPrefix::class, 'type' => 'read', 'name' => 'Get Prefix', 'description' => 'Get one DOI prefix.', 'icon' => 'ph:number-circle-one'],
            'datacite_list_provider_prefixes' => ['class' => DataCiteListProviderPrefixes::class, 'type' => 'read', 'name' => 'List Provider Prefixes', 'description' => 'List provider-prefix records.', 'icon' => 'ph:link'],
            'datacite_list_providers' => ['class' => DataCiteListProviders::class, 'type' => 'read', 'name' => 'List Providers', 'description' => 'List DataCite providers.', 'icon' => 'ph:buildings'],
            'datacite_provider_stats' => ['class' => DataCiteProviderStats::class, 'type' => 'read', 'name' => 'Provider Stats', 'description' => 'Get providers DOI production statistics.', 'icon' => 'ph:chart-bar'],
            'datacite_get_provider' => ['class' => DataCiteGetProvider::class, 'type' => 'read', 'name' => 'Get Provider', 'description' => 'Get one DataCite provider.', 'icon' => 'ph:building'],
            'datacite_list_reports' => ['class' => DataCiteListReports::class, 'type' => 'read', 'name' => 'List Reports', 'description' => 'List usage reports.', 'icon' => 'ph:file-text'],
            'datacite_get_report' => ['class' => DataCiteGetReport::class, 'type' => 'read', 'name' => 'Get Report', 'description' => 'Get one usage report.', 'icon' => 'ph:file-text'],
            'datacite_graphql_query' => ['class' => DataCiteGraphqlQuery::class, 'type' => 'read', 'name' => 'GraphQL Query', 'description' => 'Execute a read-only DataCite GraphQL query.', 'icon' => 'ph:graph'],
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
     * Create a DataCite tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional context, unused for public endpoints.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class(app(DataCiteService::class));
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/datacite.md';
    }
}
