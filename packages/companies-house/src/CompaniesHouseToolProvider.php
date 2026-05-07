<?php

namespace OpenCompany\Integrations\CompaniesHouse;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHouseAdvancedSearchCompanies;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHouseCharge;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHouseCharges;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHouseCompanyProfile;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHouseDisqualifiedOfficerCorporate;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHouseDisqualifiedOfficerNatural;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHouseExemptions;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHouseFilingHistory;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHouseFilingHistoryItem;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHouseInsolvency;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHouseOfficerAppointment;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHouseOfficerAppointments;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHouseOfficers;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHousePscCorporateEntity;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHousePscCorporateEntityBeneficialOwner;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHousePscIndividual;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHousePscIndividualBeneficialOwner;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHousePscLegalPerson;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHousePscLegalPersonBeneficialOwner;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHousePscList;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHousePscStatement;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHousePscStatements;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHousePscSuperSecure;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHousePscSuperSecureBeneficialOwner;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHouseRegisteredOfficeAddress;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHouseRegisters;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHouseSearchAll;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHouseSearchCompanies;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHouseSearchDisqualifiedOfficers;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHouseSearchOfficers;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHouseUkEstablishments;

/**
 * Tool catalog and configuration metadata for Companies House.
 *
 * Exposes official Companies House public-data endpoints for company search,
 * company records, filings, officers, charges, PSCs, and disqualified officers.
 */
class CompaniesHouseToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => ['Requires a Companies House API key. The key is sent as the Basic auth username with an empty password.'],
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
        return 'companies-house';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Companies House',
            'description' => 'UK company profiles, filings, officers, charges, PSCs, and disqualified officers',
            'icon' => 'ph:buildings',
            'logo' => 'ph:buildings',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Companies House',
            'description' => 'Official UK Companies House Public Data API for company search, filings, officers, charges, PSC records, insolvency, and disqualified officers.',
            'icon' => 'ph:buildings',
            'logo' => 'ph:buildings',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://developer.company-information.service.gov.uk/api/docs/',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'Companies House API key', 'hint' => 'Required for all Companies House API calls.', 'required' => true],
        ];
    }

    /**
     * Verify Companies House credentials with a lightweight company search.
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

        try {
            $response = Http::acceptJson()
                ->withBasicAuth($apiKey, '')
                ->timeout(20)
                ->get('https://api.company-information.service.gov.uk/search/companies', [
                    'q' => 'opencompany',
                    'items_per_page' => 1,
                ]);

            return $response->successful()
                ? ['success' => true, 'message' => 'Companies House credentials verified.']
                : ['success' => false, 'error' => 'Companies House API returned HTTP '.$response->status().'.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['api_key' => 'required|string'];
    }

    public function tools(): array
    {
        return [
            'companies_house_search_all' => ['class' => CompaniesHouseSearchAll::class, 'type' => 'read', 'name' => 'Search All', 'description' => 'Search companies, officers, and disqualified officers.', 'icon' => 'ph:magnifying-glass'],
            'companies_house_search_companies' => ['class' => CompaniesHouseSearchCompanies::class, 'type' => 'read', 'name' => 'Search Companies', 'description' => 'Search companies by name or number.', 'icon' => 'ph:buildings'],
            'companies_house_advanced_search_companies' => ['class' => CompaniesHouseAdvancedSearchCompanies::class, 'type' => 'read', 'name' => 'Advanced Company Search', 'description' => 'Search companies using official advanced filters.', 'icon' => 'ph:funnel'],
            'companies_house_search_officers' => ['class' => CompaniesHouseSearchOfficers::class, 'type' => 'read', 'name' => 'Search Officers', 'description' => 'Search company officers.', 'icon' => 'ph:user-list'],
            'companies_house_search_disqualified_officers' => ['class' => CompaniesHouseSearchDisqualifiedOfficers::class, 'type' => 'read', 'name' => 'Search Disqualified Officers', 'description' => 'Search disqualified officers.', 'icon' => 'ph:prohibit'],
            'companies_house_company_profile' => ['class' => CompaniesHouseCompanyProfile::class, 'type' => 'read', 'name' => 'Company Profile', 'description' => 'Retrieve a company profile.', 'icon' => 'ph:building-office'],
            'companies_house_registered_office_address' => ['class' => CompaniesHouseRegisteredOfficeAddress::class, 'type' => 'read', 'name' => 'Registered Office Address', 'description' => 'Retrieve a registered office address.', 'icon' => 'ph:map-pin'],
            'companies_house_officers' => ['class' => CompaniesHouseOfficers::class, 'type' => 'read', 'name' => 'Officers', 'description' => 'List company officers.', 'icon' => 'ph:users'],
            'companies_house_officer_appointment' => ['class' => CompaniesHouseOfficerAppointment::class, 'type' => 'read', 'name' => 'Officer Appointment', 'description' => 'Retrieve one company officer appointment.', 'icon' => 'ph:user-focus'],
            'companies_house_officer_appointments' => ['class' => CompaniesHouseOfficerAppointments::class, 'type' => 'read', 'name' => 'Officer Appointments', 'description' => 'List appointments for an officer.', 'icon' => 'ph:briefcase'],
            'companies_house_registers' => ['class' => CompaniesHouseRegisters::class, 'type' => 'read', 'name' => 'Registers', 'description' => 'Retrieve company registers.', 'icon' => 'ph:book-open'],
            'companies_house_filing_history' => ['class' => CompaniesHouseFilingHistory::class, 'type' => 'read', 'name' => 'Filing History', 'description' => 'List company filing history.', 'icon' => 'ph:files'],
            'companies_house_filing_history_item' => ['class' => CompaniesHouseFilingHistoryItem::class, 'type' => 'read', 'name' => 'Filing History Item', 'description' => 'Retrieve one filing history item.', 'icon' => 'ph:file-text'],
            'companies_house_charges' => ['class' => CompaniesHouseCharges::class, 'type' => 'read', 'name' => 'Charges', 'description' => 'List company charges.', 'icon' => 'ph:bank'],
            'companies_house_charge' => ['class' => CompaniesHouseCharge::class, 'type' => 'read', 'name' => 'Charge', 'description' => 'Retrieve one company charge.', 'icon' => 'ph:receipt'],
            'companies_house_insolvency' => ['class' => CompaniesHouseInsolvency::class, 'type' => 'read', 'name' => 'Insolvency', 'description' => 'Retrieve insolvency information.', 'icon' => 'ph:warning'],
            'companies_house_exemptions' => ['class' => CompaniesHouseExemptions::class, 'type' => 'read', 'name' => 'Exemptions', 'description' => 'Retrieve company disclosure exemptions.', 'icon' => 'ph:shield-check'],
            'companies_house_uk_establishments' => ['class' => CompaniesHouseUkEstablishments::class, 'type' => 'read', 'name' => 'UK Establishments', 'description' => 'List UK establishments for an overseas company.', 'icon' => 'ph:map-trifold'],
            'companies_house_psc_list' => ['class' => CompaniesHousePscList::class, 'type' => 'read', 'name' => 'PSC List', 'description' => 'List persons with significant control.', 'icon' => 'ph:identification-card'],
            'companies_house_psc_statements' => ['class' => CompaniesHousePscStatements::class, 'type' => 'read', 'name' => 'PSC Statements', 'description' => 'List PSC statements.', 'icon' => 'ph:note'],
            'companies_house_psc_individual' => ['class' => CompaniesHousePscIndividual::class, 'type' => 'read', 'name' => 'PSC Individual', 'description' => 'Retrieve an individual PSC.', 'icon' => 'ph:user'],
            'companies_house_psc_corporate_entity' => ['class' => CompaniesHousePscCorporateEntity::class, 'type' => 'read', 'name' => 'PSC Corporate Entity', 'description' => 'Retrieve a corporate-entity PSC.', 'icon' => 'ph:building'],
            'companies_house_psc_legal_person' => ['class' => CompaniesHousePscLegalPerson::class, 'type' => 'read', 'name' => 'PSC Legal Person', 'description' => 'Retrieve a legal-person PSC.', 'icon' => 'ph:scales'],
            'companies_house_psc_super_secure' => ['class' => CompaniesHousePscSuperSecure::class, 'type' => 'read', 'name' => 'PSC Super Secure', 'description' => 'Retrieve a super-secure PSC.', 'icon' => 'ph:lock-key'],
            'companies_house_psc_individual_beneficial_owner' => ['class' => CompaniesHousePscIndividualBeneficialOwner::class, 'type' => 'read', 'name' => 'PSC Individual Beneficial Owner', 'description' => 'Retrieve an individual beneficial owner PSC.', 'icon' => 'ph:user-switch'],
            'companies_house_psc_corporate_entity_beneficial_owner' => ['class' => CompaniesHousePscCorporateEntityBeneficialOwner::class, 'type' => 'read', 'name' => 'PSC Corporate Beneficial Owner', 'description' => 'Retrieve a corporate-entity beneficial owner PSC.', 'icon' => 'ph:buildings'],
            'companies_house_psc_legal_person_beneficial_owner' => ['class' => CompaniesHousePscLegalPersonBeneficialOwner::class, 'type' => 'read', 'name' => 'PSC Legal Beneficial Owner', 'description' => 'Retrieve a legal-person beneficial owner PSC.', 'icon' => 'ph:scales'],
            'companies_house_psc_super_secure_beneficial_owner' => ['class' => CompaniesHousePscSuperSecureBeneficialOwner::class, 'type' => 'read', 'name' => 'PSC Super Secure Beneficial Owner', 'description' => 'Retrieve a super-secure beneficial owner PSC.', 'icon' => 'ph:lock'],
            'companies_house_psc_statement' => ['class' => CompaniesHousePscStatement::class, 'type' => 'read', 'name' => 'PSC Statement', 'description' => 'Retrieve one PSC statement.', 'icon' => 'ph:file'],
            'companies_house_disqualified_officer_natural' => ['class' => CompaniesHouseDisqualifiedOfficerNatural::class, 'type' => 'read', 'name' => 'Natural Disqualified Officer', 'description' => 'Retrieve a natural disqualified officer.', 'icon' => 'ph:user-minus'],
            'companies_house_disqualified_officer_corporate' => ['class' => CompaniesHouseDisqualifiedOfficerCorporate::class, 'type' => 'read', 'name' => 'Corporate Disqualified Officer', 'description' => 'Retrieve a corporate disqualified officer.', 'icon' => 'ph:building-office'],
        ];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'Companies House API key', 'hint' => 'Required for all Companies House API calls.', 'required' => true],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a Companies House tool from the catalog class name.
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
    private function resolveService(array $context = []): CompaniesHouseService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new CompaniesHouseService(apiKey: $creds->get('companies-house', 'api_key', '', $account));
        }

        return app(CompaniesHouseService::class);
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/companies-house.md';
    }
}
