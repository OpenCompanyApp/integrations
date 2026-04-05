<?php

namespace OpenCompany\Integrations\Pipedrive;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveCreatePerson;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveGetPerson;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveUpdatePerson;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveSearchPersons;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveCreateOrganization;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveGetOrganization;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveUpdateOrganization;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveSearchOrganizations;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveCreateDeal;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveGetDeal;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveUpdateDeal;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveListDeals;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveCreateNote;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveListPipelines;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveListStages;

/**
 * Registers all Pipedrive tools and provides integration metadata, configuration schema, and connection testing.
 *
 * Exposes 15 tools covering persons, organizations, deals, notes, pipelines, and stages
 * via the ToolProvider contract.
 */
class PipedriveToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'pipedrive';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'crm, contacts, deals, pipelines',
            'description' => 'CRM platform',
            'icon' => 'ph:chart-line-up',
            'logo' => 'simple-icons:pipedrive',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Pipedrive',
            'description' => 'CRM persons, organizations, deals, notes, pipelines, and stages',
            'icon' => 'ph:chart-line-up',
            'logo' => 'simple-icons:pipedrive',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.pipedrive.com/docs/api/v1',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Your Pipedrive API token',
                'hint' => 'Found in Pipedrive Settings → Personal Preferences → API.',
                'required' => true,
            ],
            [
                'key' => 'company_domain',
                'type' => 'text',
                'label' => 'Company Domain',
                'placeholder' => 'https://company.pipedrive.com',
                'hint' => 'Your Pipedrive company domain URL.',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the Pipedrive connection using the provided credentials.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'api_token' and 'company_domain'
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';
        $companyDomain = $config['company_domain'] ?? '';

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'API token is required. Find it in Pipedrive Settings → Personal Preferences → API.'];
        }

        if (empty($companyDomain)) {
            return ['success' => false, 'error' => 'Company domain is required.'];
        }

        try {
            $baseUrl = rtrim($companyDomain, '/');
            $response = Http::withHeaders([
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/api/v1/users/me', [
                'api_token' => $apiToken,
            ]);

            if ($response->successful()) {
                $body = $response->json() ?? [];
                $data = $body['data'] ?? [];
                $name = $data['name'] ?? 'Unknown';

                return [
                    'success' => true,
                    'message' => "Connected to Pipedrive as {$name}.",
                ];
            }

            return [
                'success' => false,
                'error' => 'Pipedrive API error (' . $response->status() . '): ' . $response->body(),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return [
            'api_token'       => 'nullable|string',
            'company_domain'  => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            // Persons
            'pipedrive_create_person' => [
                'class' => PipedriveCreatePerson::class,
                'type' => 'write',
                'name' => 'Create Person',
                'description' => 'Create a new person in Pipedrive.',
                'icon' => 'ph:user-plus',
            ],
            'pipedrive_get_person' => [
                'class' => PipedriveGetPerson::class,
                'type' => 'read',
                'name' => 'Get Person',
                'description' => 'Retrieve a Pipedrive person by ID.',
                'icon' => 'ph:user',
            ],
            'pipedrive_update_person' => [
                'class' => PipedriveUpdatePerson::class,
                'type' => 'write',
                'name' => 'Update Person',
                'description' => 'Update an existing Pipedrive person.',
                'icon' => 'ph:pencil-simple',
            ],
            'pipedrive_search_persons' => [
                'class' => PipedriveSearchPersons::class,
                'type' => 'read',
                'name' => 'Search Persons',
                'description' => 'Search Pipedrive persons by term.',
                'icon' => 'ph:magnifying-glass',
            ],
            // Organizations
            'pipedrive_create_organization' => [
                'class' => PipedriveCreateOrganization::class,
                'type' => 'write',
                'name' => 'Create Organization',
                'description' => 'Create a new organization in Pipedrive.',
                'icon' => 'ph:buildings',
            ],
            'pipedrive_get_organization' => [
                'class' => PipedriveGetOrganization::class,
                'type' => 'read',
                'name' => 'Get Organization',
                'description' => 'Retrieve a Pipedrive organization by ID.',
                'icon' => 'ph:building',
            ],
            'pipedrive_update_organization' => [
                'class' => PipedriveUpdateOrganization::class,
                'type' => 'write',
                'name' => 'Update Organization',
                'description' => 'Update an existing Pipedrive organization.',
                'icon' => 'ph:pencil-simple',
            ],
            'pipedrive_search_organizations' => [
                'class' => PipedriveSearchOrganizations::class,
                'type' => 'read',
                'name' => 'Search Organizations',
                'description' => 'Search Pipedrive organizations by term.',
                'icon' => 'ph:magnifying-glass',
            ],
            // Deals
            'pipedrive_create_deal' => [
                'class' => PipedriveCreateDeal::class,
                'type' => 'write',
                'name' => 'Create Deal',
                'description' => 'Create a new deal in Pipedrive.',
                'icon' => 'ph:currency-dollar',
            ],
            'pipedrive_get_deal' => [
                'class' => PipedriveGetDeal::class,
                'type' => 'read',
                'name' => 'Get Deal',
                'description' => 'Retrieve a Pipedrive deal by ID.',
                'icon' => 'ph:handshake',
            ],
            'pipedrive_update_deal' => [
                'class' => PipedriveUpdateDeal::class,
                'type' => 'write',
                'name' => 'Update Deal',
                'description' => 'Update an existing Pipedrive deal.',
                'icon' => 'ph:pencil-simple',
            ],
            'pipedrive_list_deals' => [
                'class' => PipedriveListDeals::class,
                'type' => 'read',
                'name' => 'List Deals',
                'description' => 'List Pipedrive deals with optional filters.',
                'icon' => 'ph:list',
            ],
            // Notes
            'pipedrive_create_note' => [
                'class' => PipedriveCreateNote::class,
                'type' => 'write',
                'name' => 'Create Note',
                'description' => 'Create a note attached to a deal, person, or organization.',
                'icon' => 'ph:note',
            ],
            // Pipelines & Stages
            'pipedrive_list_pipelines' => [
                'class' => PipedriveListPipelines::class,
                'type' => 'read',
                'name' => 'List Pipelines',
                'description' => 'List all Pipedrive pipelines.',
                'icon' => 'ph:funnel',
            ],
            'pipedrive_list_stages' => [
                'class' => PipedriveListStages::class,
                'type' => 'read',
                'name' => 'List Stages',
                'description' => 'List Pipedrive stages, optionally filtered by pipeline.',
                'icon' => 'ph:list-bullets',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/pipedrive.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'company_domain', 'type' => 'text', 'label' => 'Company Domain', 'required' => true],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the PipedriveService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): PipedriveService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new PipedriveService(
                apiToken: $creds->get('pipedrive', 'api_token', '', $account),
                companyDomain: $creds->get('pipedrive', 'company_domain', 'https://company.pipedrive.com', $account),
            );
        }

        return app(PipedriveService::class);
    }
}
