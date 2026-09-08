<?php

namespace OpenCompany\Integrations\OpenFigi;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\OpenFigi\Tools\OpenFigiFilter;
use OpenCompany\Integrations\OpenFigi\Tools\OpenFigiMapping;
use OpenCompany\Integrations\OpenFigi\Tools\OpenFigiMappingValues;
use OpenCompany\Integrations\OpenFigi\Tools\OpenFigiSchema;
use OpenCompany\Integrations\OpenFigi\Tools\OpenFigiSearch;

/**
 * Tool catalog and configuration metadata for OpenFIGI.
 *
 * Exposes the complete current OpenFIGI API surface for identifier mapping,
 * search, filtering, enum discovery, and schema retrieval.
 */
class OpenFigiToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => ['OpenFIGI can be used without an API key at lower rate limits. Send X-OPENFIGI-APIKEY for higher limits.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'optional_manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'optional_manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string
    {
        return 'openfigi';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'OpenFIGI',
            'description' => 'Map security identifiers to FIGIs and search/filter instruments',
            'icon' => 'ph:identification-card',
            'logo' => 'ph:identification-card',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'OpenFIGI',
            'description' => 'OpenFIGI API for mapping third-party security identifiers to FIGIs, listing mapping enum values, searching and filtering instruments, and retrieving the OpenAPI schema.',
            'icon' => 'ph:identification-card',
            'logo' => 'ph:identification-card',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://www.openfigi.com/api/documentation',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'OpenFIGI API key', 'hint' => 'Optional. Raises OpenFIGI rate limits when provided.', 'required' => false],
        ];
    }

    /**
     * Verify OpenFIGI connectivity and optional API-key validity.
     *
     * @param  array<string, mixed>  $config  Credential settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        try {
            $request = Http::acceptJson()->timeout(20);
            $apiKey = (string) ($config['api_key'] ?? '');
            if ($apiKey !== '') {
                $request = $request->withHeaders(['X-OPENFIGI-APIKEY' => $apiKey]);
            }

            $response = $request->get('https://api.openfigi.com/schema');

            return $response->successful()
                ? ['success' => true, 'message' => $apiKey === '' ? 'OpenFIGI is reachable without an API key.' : 'OpenFIGI API key accepted.']
                : ['success' => false, 'error' => 'OpenFIGI API returned HTTP '.$response->status().'.'];
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
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'OpenFIGI API key', 'hint' => 'Optional. Raises OpenFIGI rate limits when provided.', 'required' => false],
        ];
    }

    public function tools(): array
    {
        return [
            'openfigi_mapping' => ['class' => OpenFigiMapping::class, 'type' => 'read', 'name' => 'Mapping', 'description' => 'Map third-party identifiers to FIGIs.', 'icon' => 'ph:arrows-left-right'],
            'openfigi_mapping_values' => ['class' => OpenFigiMappingValues::class, 'type' => 'read', 'name' => 'Mapping Values', 'description' => 'List supported values for OpenFIGI mapping job properties.', 'icon' => 'ph:list-bullets'],
            'openfigi_search' => ['class' => OpenFigiSearch::class, 'type' => 'read', 'name' => 'Search', 'description' => 'Search for FIGIs using keywords and optional filters.', 'icon' => 'ph:magnifying-glass'],
            'openfigi_filter' => ['class' => OpenFigiFilter::class, 'type' => 'read', 'name' => 'Filter', 'description' => 'Filter for FIGIs using OpenFIGI instrument filters.', 'icon' => 'ph:funnel'],
            'openfigi_schema' => ['class' => OpenFigiSchema::class, 'type' => 'read', 'name' => 'Schema', 'description' => 'Retrieve the current OpenFIGI OpenAPI schema.', 'icon' => 'ph:file-code'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create an OpenFIGI tool from the catalog class name.
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
    private function resolveService(array $context = []): OpenFigiService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new OpenFigiService(apiKey: $creds->get('openfigi', 'api_key', '', $account));
        }

        return app(OpenFigiService::class);
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/openfigi.md';
    }
}
