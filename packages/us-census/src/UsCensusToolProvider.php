<?php

namespace OpenCompany\Integrations\UsCensus;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\UsCensus\Tools\UsCensusDataQuery;
use OpenCompany\Integrations\UsCensus\Tools\UsCensusDataQueryUrl;
use OpenCompany\Integrations\UsCensus\Tools\UsCensusDatasetMetadata;
use OpenCompany\Integrations\UsCensus\Tools\UsCensusExamples;
use OpenCompany\Integrations\UsCensus\Tools\UsCensusGeographies;
use OpenCompany\Integrations\UsCensus\Tools\UsCensusGroups;
use OpenCompany\Integrations\UsCensus\Tools\UsCensusListDatasets;
use OpenCompany\Integrations\UsCensus\Tools\UsCensusVariables;

/**
 * Tool catalog and configuration metadata for the U.S. Census Data API.
 *
 * Exposes public dataset discovery, dataset metadata, variable/group/geography
 * metadata, examples, and data query tools with optional API-key support.
 */
class UsCensusToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'strategy' => 'api_key',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'optional_secret',
                'setup_flows' => ['none', 'manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['api_key'],
                'notes' => ['US Census Data API is public; an API key is optional and can increase allowed usage.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'optional_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'optional_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string
    {
        return 'us-census';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'US Census',
            'description' => 'Census datasets, metadata, and data queries',
            'icon' => 'ph:buildings',
            'logo' => 'ph:buildings',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'US Census',
            'description' => 'U.S. Census Data API for dataset discovery, variables, groups, geographies, examples, and tabular data queries.',
            'icon' => 'ph:buildings',
            'logo' => 'ph:buildings',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://www.census.gov/data/developers/guidance/api-user-guide.html',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'Optional Census API key', 'hint' => 'Optional. Public requests work without a key, but keys can increase allowed usage.', 'required' => false],
        ];
    }

    /**
     * Verify optional US Census API credentials with a lightweight dataset request.
     *
     * @param  array<string, mixed>  $config  Credential settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        try {
            $query = [];
            if (($config['api_key'] ?? '') !== '') {
                $query['key'] = (string) $config['api_key'];
            }

            $response = Http::acceptJson()
                ->timeout(20)
                ->get('https://api.census.gov/data.json', $query);

            return $response->successful()
                ? ['success' => true, 'message' => 'US Census API reachable.']
                : ['success' => false, 'error' => 'US Census API returned HTTP '.$response->status().'.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['api_key' => 'nullable|string'];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'Optional Census API key', 'hint' => 'Optional. Public requests work without a key, but keys can increase allowed usage.', 'required' => false],
        ];
    }

    public function tools(): array
    {
        return [
            'us_census_list_datasets' => ['class' => UsCensusListDatasets::class, 'type' => 'read', 'name' => 'List Datasets', 'description' => 'List and search Census API datasets.', 'icon' => 'ph:database'],
            'us_census_dataset_metadata' => ['class' => UsCensusDatasetMetadata::class, 'type' => 'read', 'name' => 'Dataset Metadata', 'description' => 'Get root metadata for one Census API dataset.', 'icon' => 'ph:info'],
            'us_census_variables' => ['class' => UsCensusVariables::class, 'type' => 'read', 'name' => 'Variables', 'description' => 'List or search dataset variables.', 'icon' => 'ph:list-magnifying-glass'],
            'us_census_groups' => ['class' => UsCensusGroups::class, 'type' => 'read', 'name' => 'Groups', 'description' => 'List or search dataset variable groups.', 'icon' => 'ph:folders'],
            'us_census_geographies' => ['class' => UsCensusGeographies::class, 'type' => 'read', 'name' => 'Geographies', 'description' => 'List supported geographies for a dataset.', 'icon' => 'ph:map-trifold'],
            'us_census_examples' => ['class' => UsCensusExamples::class, 'type' => 'read', 'name' => 'Examples', 'description' => 'Get example queries for a dataset.', 'icon' => 'ph:code'],
            'us_census_data_query' => ['class' => UsCensusDataQuery::class, 'type' => 'read', 'name' => 'Data Query', 'description' => 'Query a Census dataset and normalize rows into records.', 'icon' => 'ph:table'],
            'us_census_data_query_url' => ['class' => UsCensusDataQueryUrl::class, 'type' => 'read', 'name' => 'Data Query URL', 'description' => 'Build a Census data query URL for sharing or inspection.', 'icon' => 'ph:link'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a US Census tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): UsCensusService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new UsCensusService(apiKey: $creds->get('us-census', 'api_key', '', $account));
        }

        return app(UsCensusService::class);
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/us-census.md';
    }
}
