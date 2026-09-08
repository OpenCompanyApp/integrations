<?php

namespace OpenCompany\Integrations\OpenAlex;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexAutocomplete;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexGetAuthor;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexGetAward;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexGetChangefile;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexGetContinent;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexGetCountry;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexGetDomain;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexGetField;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexGetFunder;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexGetInstitution;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexGetInstitutionType;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexGetKeyword;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexGetLanguage;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexGetLicense;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexGetPublisher;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexGetSdg;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexGetSource;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexGetSourceType;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexGetSubfield;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexGetTopic;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexGetWork;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexGetWorkType;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexListAuthors;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexListAwards;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexListChangefiles;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexListContinents;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexListCountries;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexListDomains;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexListFields;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexListFunders;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexListInstitutionTypes;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexListInstitutions;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexListKeywords;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexListLanguages;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexListLicenses;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexListPublishers;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexListSdgs;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexListSourceTypes;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexListSources;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexListSubfields;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexListTopics;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexListWorks;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexListWorkTypes;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexRateLimit;

/**
 * Tool catalog and configuration metadata for OpenAlex.
 *
 * Exposes current non-deprecated OpenAlex entity endpoints, autocomplete,
 * rate-limit, and changefile utilities.
 */
class OpenAlexToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => ['Requires a free OpenAlex API key. Changefile endpoints may require a paid OpenAlex plan. Deprecated concepts endpoints are intentionally excluded; use topics.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string
    {
        return 'openalex';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'OpenAlex',
            'description' => 'Scholarly works, authors, sources, institutions, topics, and research metadata',
            'icon' => 'ph:books',
            'logo' => 'ph:books',
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
            'name' => 'OpenAlex',
            'description' => 'OpenAlex scholarly graph API for works, authors, sources, institutions, topics, funders, publishers, taxonomies, autocomplete, and changefiles.',
            'icon' => 'ph:books',
            'logo' => 'ph:books',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://developers.openalex.org/api-reference/introduction',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'OpenAlex API key', 'hint' => 'Free OpenAlex API key from openalex.org/settings/api.', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Base URL', 'default' => 'https://api.openalex.org', 'required' => false],
        ];
    }

    /**
     * Verify OpenAlex credentials with a lightweight works list request.
     *
     * @param  array<string, mixed>  $config  Credential settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided.'];
        }

        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.openalex.org'), '/');

        try {
            $response = Http::acceptJson()->timeout(20)->get($baseUrl.'/works', [
                'api_key' => $apiKey,
                'per_page' => 1,
                'select' => 'id,display_name',
            ]);

            return $response->successful()
                ? ['success' => true, 'message' => 'OpenAlex credentials verified.']
                : ['success' => false, 'error' => 'OpenAlex API returned HTTP '.$response->status().'.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'required|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'openalex_list_works' => ['class' => OpenAlexListWorks::class, 'type' => 'read', 'name' => 'List Works', 'description' => 'List, search, filter, sort, sample, or group works.', 'icon' => 'ph:article'],
            'openalex_get_work' => ['class' => OpenAlexGetWork::class, 'type' => 'read', 'name' => 'Get Work', 'description' => 'Get one work by OpenAlex ID, DOI, PMID, or supported external ID.', 'icon' => 'ph:article'],
            'openalex_list_authors' => ['class' => OpenAlexListAuthors::class, 'type' => 'read', 'name' => 'List Authors', 'description' => 'List, search, filter, sort, sample, or group authors.', 'icon' => 'ph:user-list'],
            'openalex_get_author' => ['class' => OpenAlexGetAuthor::class, 'type' => 'read', 'name' => 'Get Author', 'description' => 'Get one author by OpenAlex ID, ORCID, or supported external ID.', 'icon' => 'ph:user'],
            'openalex_list_sources' => ['class' => OpenAlexListSources::class, 'type' => 'read', 'name' => 'List Sources', 'description' => 'List, search, filter, sort, sample, or group sources.', 'icon' => 'ph:book-open'],
            'openalex_get_source' => ['class' => OpenAlexGetSource::class, 'type' => 'read', 'name' => 'Get Source', 'description' => 'Get one source by OpenAlex ID, ISSN, or supported external ID.', 'icon' => 'ph:book-open'],
            'openalex_list_institutions' => ['class' => OpenAlexListInstitutions::class, 'type' => 'read', 'name' => 'List Institutions', 'description' => 'List, search, filter, sort, sample, or group institutions.', 'icon' => 'ph:buildings'],
            'openalex_get_institution' => ['class' => OpenAlexGetInstitution::class, 'type' => 'read', 'name' => 'Get Institution', 'description' => 'Get one institution by OpenAlex ID, ROR, or supported external ID.', 'icon' => 'ph:buildings'],
            'openalex_list_topics' => ['class' => OpenAlexListTopics::class, 'type' => 'read', 'name' => 'List Topics', 'description' => 'List, search, filter, sort, sample, or group topics.', 'icon' => 'ph:tree-structure'],
            'openalex_get_topic' => ['class' => OpenAlexGetTopic::class, 'type' => 'read', 'name' => 'Get Topic', 'description' => 'Get one topic by OpenAlex ID.', 'icon' => 'ph:tree-structure'],
            'openalex_list_domains' => ['class' => OpenAlexListDomains::class, 'type' => 'read', 'name' => 'List Domains', 'description' => 'List, search, filter, sort, sample, or group domains.', 'icon' => 'ph:circles-three-plus'],
            'openalex_get_domain' => ['class' => OpenAlexGetDomain::class, 'type' => 'read', 'name' => 'Get Domain', 'description' => 'Get one domain by OpenAlex ID.', 'icon' => 'ph:circles-three-plus'],
            'openalex_list_fields' => ['class' => OpenAlexListFields::class, 'type' => 'read', 'name' => 'List Fields', 'description' => 'List, search, filter, sort, sample, or group fields.', 'icon' => 'ph:stack'],
            'openalex_get_field' => ['class' => OpenAlexGetField::class, 'type' => 'read', 'name' => 'Get Field', 'description' => 'Get one field by OpenAlex ID.', 'icon' => 'ph:stack'],
            'openalex_list_subfields' => ['class' => OpenAlexListSubfields::class, 'type' => 'read', 'name' => 'List Subfields', 'description' => 'List, search, filter, sort, sample, or group subfields.', 'icon' => 'ph:stack-simple'],
            'openalex_get_subfield' => ['class' => OpenAlexGetSubfield::class, 'type' => 'read', 'name' => 'Get Subfield', 'description' => 'Get one subfield by OpenAlex ID.', 'icon' => 'ph:stack-simple'],
            'openalex_list_sdgs' => ['class' => OpenAlexListSdgs::class, 'type' => 'read', 'name' => 'List SDGs', 'description' => 'List, search, filter, sort, sample, or group Sustainable Development Goals.', 'icon' => 'ph:globe-hemisphere-west'],
            'openalex_get_sdg' => ['class' => OpenAlexGetSdg::class, 'type' => 'read', 'name' => 'Get SDG', 'description' => 'Get one Sustainable Development Goal by OpenAlex ID.', 'icon' => 'ph:globe-hemisphere-west'],
            'openalex_list_countries' => ['class' => OpenAlexListCountries::class, 'type' => 'read', 'name' => 'List Countries', 'description' => 'List, search, filter, sort, sample, or group countries.', 'icon' => 'ph:map-trifold'],
            'openalex_get_country' => ['class' => OpenAlexGetCountry::class, 'type' => 'read', 'name' => 'Get Country', 'description' => 'Get one country by OpenAlex ID.', 'icon' => 'ph:map-trifold'],
            'openalex_list_continents' => ['class' => OpenAlexListContinents::class, 'type' => 'read', 'name' => 'List Continents', 'description' => 'List, search, filter, sort, sample, or group continents.', 'icon' => 'ph:globe'],
            'openalex_get_continent' => ['class' => OpenAlexGetContinent::class, 'type' => 'read', 'name' => 'Get Continent', 'description' => 'Get one continent by OpenAlex ID.', 'icon' => 'ph:globe'],
            'openalex_list_languages' => ['class' => OpenAlexListLanguages::class, 'type' => 'read', 'name' => 'List Languages', 'description' => 'List, search, filter, sort, sample, or group languages.', 'icon' => 'ph:translate'],
            'openalex_get_language' => ['class' => OpenAlexGetLanguage::class, 'type' => 'read', 'name' => 'Get Language', 'description' => 'Get one language by OpenAlex ID.', 'icon' => 'ph:translate'],
            'openalex_list_keywords' => ['class' => OpenAlexListKeywords::class, 'type' => 'read', 'name' => 'List Keywords', 'description' => 'List, search, filter, sort, sample, or group keywords.', 'icon' => 'ph:tag'],
            'openalex_get_keyword' => ['class' => OpenAlexGetKeyword::class, 'type' => 'read', 'name' => 'Get Keyword', 'description' => 'Get one keyword by OpenAlex ID.', 'icon' => 'ph:tag'],
            'openalex_list_publishers' => ['class' => OpenAlexListPublishers::class, 'type' => 'read', 'name' => 'List Publishers', 'description' => 'List, search, filter, sort, sample, or group publishers.', 'icon' => 'ph:factory'],
            'openalex_get_publisher' => ['class' => OpenAlexGetPublisher::class, 'type' => 'read', 'name' => 'Get Publisher', 'description' => 'Get one publisher by OpenAlex ID, Wikidata ID, or supported external ID.', 'icon' => 'ph:factory'],
            'openalex_list_funders' => ['class' => OpenAlexListFunders::class, 'type' => 'read', 'name' => 'List Funders', 'description' => 'List, search, filter, sort, sample, or group funders.', 'icon' => 'ph:hand-coins'],
            'openalex_get_funder' => ['class' => OpenAlexGetFunder::class, 'type' => 'read', 'name' => 'Get Funder', 'description' => 'Get one funder by OpenAlex ID.', 'icon' => 'ph:hand-coins'],
            'openalex_list_awards' => ['class' => OpenAlexListAwards::class, 'type' => 'read', 'name' => 'List Awards', 'description' => 'List, search, filter, sort, sample, or group awards.', 'icon' => 'ph:medal'],
            'openalex_get_award' => ['class' => OpenAlexGetAward::class, 'type' => 'read', 'name' => 'Get Award', 'description' => 'Get one award by OpenAlex ID.', 'icon' => 'ph:medal'],
            'openalex_list_work_types' => ['class' => OpenAlexListWorkTypes::class, 'type' => 'read', 'name' => 'List Work Types', 'description' => 'List OpenAlex work type enumerations.', 'icon' => 'ph:list-bullets'],
            'openalex_get_work_type' => ['class' => OpenAlexGetWorkType::class, 'type' => 'read', 'name' => 'Get Work Type', 'description' => 'Get one work type by OpenAlex ID.', 'icon' => 'ph:list-bullets'],
            'openalex_list_source_types' => ['class' => OpenAlexListSourceTypes::class, 'type' => 'read', 'name' => 'List Source Types', 'description' => 'List OpenAlex source type enumerations.', 'icon' => 'ph:list-bullets'],
            'openalex_get_source_type' => ['class' => OpenAlexGetSourceType::class, 'type' => 'read', 'name' => 'Get Source Type', 'description' => 'Get one source type by OpenAlex ID.', 'icon' => 'ph:list-bullets'],
            'openalex_list_institution_types' => ['class' => OpenAlexListInstitutionTypes::class, 'type' => 'read', 'name' => 'List Institution Types', 'description' => 'List OpenAlex institution type enumerations.', 'icon' => 'ph:list-bullets'],
            'openalex_get_institution_type' => ['class' => OpenAlexGetInstitutionType::class, 'type' => 'read', 'name' => 'Get Institution Type', 'description' => 'Get one institution type by OpenAlex ID.', 'icon' => 'ph:list-bullets'],
            'openalex_list_licenses' => ['class' => OpenAlexListLicenses::class, 'type' => 'read', 'name' => 'List Licenses', 'description' => 'List OpenAlex license enumerations.', 'icon' => 'ph:certificate'],
            'openalex_get_license' => ['class' => OpenAlexGetLicense::class, 'type' => 'read', 'name' => 'Get License', 'description' => 'Get one license by OpenAlex ID.', 'icon' => 'ph:certificate'],
            'openalex_autocomplete' => ['class' => OpenAlexAutocomplete::class, 'type' => 'read', 'name' => 'Autocomplete', 'description' => 'Get fast typeahead suggestions for supported OpenAlex entity types.', 'icon' => 'ph:magnifying-glass'],
            'openalex_rate_limit' => ['class' => OpenAlexRateLimit::class, 'type' => 'read', 'name' => 'Rate Limit', 'description' => 'Check current OpenAlex API-key rate-limit status.', 'icon' => 'ph:gauge'],
            'openalex_list_changefiles' => ['class' => OpenAlexListChangefiles::class, 'type' => 'read', 'name' => 'List Changefiles', 'description' => 'List available OpenAlex changefile dates.', 'icon' => 'ph:calendar'],
            'openalex_get_changefile' => ['class' => OpenAlexGetChangefile::class, 'type' => 'read', 'name' => 'Get Changefile', 'description' => 'Get OpenAlex changefile details for a date.', 'icon' => 'ph:calendar-check'],
        ];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'OpenAlex API key', 'hint' => 'Free OpenAlex API key from openalex.org/settings/api.', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Base URL', 'default' => 'https://api.openalex.org', 'required' => false],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create an OpenAlex tool from the catalog class name.
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
    private function resolveService(array $context = []): OpenAlexService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new OpenAlexService(
                apiKey: $creds->get('openalex', 'api_key', '', $account),
                baseUrl: $creds->get('openalex', 'url', 'https://api.openalex.org', $account),
            );
        }

        return app(OpenAlexService::class);
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/openalex.md';
    }
}
