<?php

namespace OpenCompany\Integrations\Clearbit;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Clearbit\Tools\ClearbitApiGet;
use OpenCompany\Integrations\Clearbit\Tools\ClearbitCalculateRisk;
use OpenCompany\Integrations\Clearbit\Tools\ClearbitDiscoverySearch;
use OpenCompany\Integrations\Clearbit\Tools\ClearbitEnrichCombined;
use OpenCompany\Integrations\Clearbit\Tools\ClearbitEnrichCompany;
use OpenCompany\Integrations\Clearbit\Tools\ClearbitEnrichPerson;
use OpenCompany\Integrations\Clearbit\Tools\ClearbitListAutocomplete;
use OpenCompany\Integrations\Clearbit\Tools\ClearbitNameToDomain;
use OpenCompany\Integrations\Clearbit\Tools\ClearbitProspect;
use OpenCompany\Integrations\Clearbit\Tools\ClearbitReveal;

/**
 * Exposes Clearbit data-enrichment tools and setup metadata.
 */
class ClearbitToolProvider implements ConfigurableIntegration, HasIntegrationCapabilities, ToolProvider
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
                'credential_mode' => 'secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => [
                    'Company autocomplete does not require authentication. Name-to-domain and risk are legacy unsupported APIs for existing Clearbit customers.',
                ],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                    'runtime_mode' => 'normal',
                ],
            ],
            'runtime_requirements' => [],
            'compatibility' => [
                'web_setup_supported' => true,
                'web_runtime_supported' => true,
                'cli_setup_supported' => true,
                'cli_runtime_supported' => true,
            ],
        ];
    }

    public function appName(): string
    {
        return 'clearbit';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Clearbit',
            'description' => 'B2B enrichment, reveal, prospector, and company lookup data',
            'icon' => 'ph:buildings',
            'logo' => 'ph:buildings',
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
            'name' => 'Clearbit',
            'description' => 'B2B person and company enrichment, visitor reveal, prospecting, discovery, and legacy lookup APIs.',
            'icon' => 'ph:buildings',
            'logo' => 'ph:buildings',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://help.clearbit.com/hc/en-us/categories/360000913214-APIs',
        ];
    }

    /**
     * Configuration schema for the Clearbit integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Clearbit API key',
                'hint' => 'Find your API key in the Clearbit dashboard. Autocomplete is public; other endpoints require an existing Clearbit customer API key.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Person API Base URL',
                'placeholder' => 'https://person.clearbit.com/v2',
                'hint' => 'Optional override for the Person API host. Other Clearbit API families use their canonical hosts.',
                'default' => 'https://person.clearbit.com/v2',
            ],
        ];
    }

    /**
     * Test the connection using a lightweight person enrichment request.
     *
     * A 404 is treated as a valid connection because it means Clearbit accepted
     * the request and did not find the dummy address.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://person.clearbit.com/v2'), '/');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$apiKey,
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl.'/people/find', ['email' => 'test@example.invalid']);

            if (in_array($response->status(), [200, 202, 404], true)) {
                return [
                    'success' => true,
                    'message' => "Connected to Clearbit Person API at {$baseUrl}.",
                ];
            }

            $error = $response->json('error') ?? $response->json('message') ?? $response->body();

            return [
                'success' => false,
                'error' => 'Clearbit API error ('.$response->status().'): '.(is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Laravel validation rules for the configuration fields.
     *
     * @return array<string, string>
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Return the list of tools provided by this integration.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'clearbit_enrich_person' => $this->tool(ClearbitEnrichPerson::class, 'Enrich Person', 'Look up a person by email address.'),
            'clearbit_enrich_combined' => $this->tool(ClearbitEnrichCombined::class, 'Enrich Person and Company', 'Look up a person and associated company by email address.'),
            'clearbit_enrich_company' => $this->tool(ClearbitEnrichCompany::class, 'Enrich Company', 'Look up company metrics, categorization, and social profiles by domain.'),
            'clearbit_reveal' => $this->tool(ClearbitReveal::class, 'Reveal Company', 'Identify the company behind an IP address.'),
            'clearbit_prospect' => $this->tool(ClearbitProspect::class, 'Prospect People', 'Find people by domain, role, seniority, title, or company.'),
            'clearbit_list_autocomplete' => $this->tool(ClearbitListAutocomplete::class, 'Company Autocomplete', 'Search for companies by name with the public autocomplete API.'),
            'clearbit_name_to_domain' => $this->tool(ClearbitNameToDomain::class, 'Name to Domain', 'Find a company domain and logo by company name.'),
            'clearbit_discovery_search' => $this->tool(ClearbitDiscoverySearch::class, 'Discovery Search', 'Search Clearbit Discovery companies.'),
            'clearbit_calculate_risk' => $this->tool(ClearbitCalculateRisk::class, 'Calculate Risk', 'Calculate a Clearbit Risk score from signup attributes.'),
            'clearbit_api_get' => $this->tool(ClearbitApiGet::class, 'Clearbit API GET', 'Call a read-only Clearbit endpoint on a named API host.'),
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/clearbit.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Person API Base URL', 'required' => false, 'default' => 'https://person.clearbit.com/v2'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Optional context with an account key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the Clearbit service for default or account-scoped credentials.
     *
     * @param  array<string, mixed>  $context  Optional context with an account key.
     */
    private function resolveService(array $context = []): ClearbitService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new ClearbitService(
                apiKey: $creds->get('clearbit', 'api_key', '', $account),
                baseUrl: $creds->get('clearbit', 'url', 'https://person.clearbit.com/v2', $account),
            );
        }

        return app(ClearbitService::class);
    }

    /**
     * Build standard tool metadata.
     *
     * @return array<string, mixed>
     */
    private function tool(string $class, string $name, string $description): array
    {
        return [
            'class' => $class,
            'type' => 'read',
            'name' => $name,
            'description' => $description,
            'icon' => 'ph:wrench',
        ];
    }
}
