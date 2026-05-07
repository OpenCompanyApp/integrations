<?php

namespace OpenCompany\Integrations\OpenFda;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\OpenFda\Tools\OpenFdaAnimalVeterinaryEvent;
use OpenCompany\Integrations\OpenFda\Tools\OpenFdaCosmeticEvent;
use OpenCompany\Integrations\OpenFda\Tools\OpenFdaDevice510k;
use OpenCompany\Integrations\OpenFda\Tools\OpenFdaDeviceClassification;
use OpenCompany\Integrations\OpenFda\Tools\OpenFdaDeviceCovid19Serology;
use OpenCompany\Integrations\OpenFda\Tools\OpenFdaDeviceEnforcement;
use OpenCompany\Integrations\OpenFda\Tools\OpenFdaDeviceEvent;
use OpenCompany\Integrations\OpenFda\Tools\OpenFdaDevicePma;
use OpenCompany\Integrations\OpenFda\Tools\OpenFdaDeviceRecall;
use OpenCompany\Integrations\OpenFda\Tools\OpenFdaDeviceRegistrationListing;
use OpenCompany\Integrations\OpenFda\Tools\OpenFdaDeviceUdi;
use OpenCompany\Integrations\OpenFda\Tools\OpenFdaDrugDrugsFda;
use OpenCompany\Integrations\OpenFda\Tools\OpenFdaDrugEnforcement;
use OpenCompany\Integrations\OpenFda\Tools\OpenFdaDrugEvent;
use OpenCompany\Integrations\OpenFda\Tools\OpenFdaDrugLabel;
use OpenCompany\Integrations\OpenFda\Tools\OpenFdaDrugNdc;
use OpenCompany\Integrations\OpenFda\Tools\OpenFdaDrugShortages;
use OpenCompany\Integrations\OpenFda\Tools\OpenFdaFoodEnforcement;
use OpenCompany\Integrations\OpenFda\Tools\OpenFdaFoodEvent;
use OpenCompany\Integrations\OpenFda\Tools\OpenFdaOtherHistoricalDocument;
use OpenCompany\Integrations\OpenFda\Tools\OpenFdaOtherNsde;
use OpenCompany\Integrations\OpenFda\Tools\OpenFdaOtherSubstance;
use OpenCompany\Integrations\OpenFda\Tools\OpenFdaOtherUnii;
use OpenCompany\Integrations\OpenFda\Tools\OpenFdaTobaccoProblem;

/**
 * Tool catalog and metadata for openFDA.
 *
 * Exposes official public dataset endpoints across drug, device, food, animal,
 * cosmetic, tobacco, and other FDA data families.
 */
class OpenFdaToolProvider implements ToolProvider, HasIntegrationCapabilities
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
                'notes' => ['openFDA can be queried without credentials at low volume. Pass api_key per call for higher daily limits.'],
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
        return 'openfda';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'openFDA',
            'description' => 'FDA public datasets for drugs, devices, food, recalls, events, and regulated products',
            'icon' => 'ph:first-aid-kit',
            'logo' => 'ph:first-aid-kit',
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
            'name' => 'openFDA',
            'description' => 'Public openFDA APIs for drug, device, food, animal, cosmetic, tobacco, and other FDA datasets with shared search, count, sort, and paging support.',
            'icon' => 'ph:first-aid-kit',
            'logo' => 'ph:first-aid-kit',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://open.fda.gov/apis/',
        ];
    }

    public function tools(): array
    {
        return [
            'openfda_drug_event' => ['class' => OpenFdaDrugEvent::class, 'type' => 'read', 'name' => 'Drug Event', 'description' => 'Query FAERS drug adverse event reports.', 'icon' => 'ph:pill'],
            'openfda_drug_label' => ['class' => OpenFdaDrugLabel::class, 'type' => 'read', 'name' => 'Drug Label', 'description' => 'Query structured product labeling records.', 'icon' => 'ph:file-text'],
            'openfda_drug_enforcement' => ['class' => OpenFdaDrugEnforcement::class, 'type' => 'read', 'name' => 'Drug Enforcement', 'description' => 'Query drug recall enforcement reports.', 'icon' => 'ph:warning'],
            'openfda_drug_ndc' => ['class' => OpenFdaDrugNdc::class, 'type' => 'read', 'name' => 'Drug NDC', 'description' => 'Query NDC directory product listings.', 'icon' => 'ph:barcode'],
            'openfda_drug_drugsfda' => ['class' => OpenFdaDrugDrugsFda::class, 'type' => 'read', 'name' => 'Drugs@FDA', 'description' => 'Query Drugs@FDA application data.', 'icon' => 'ph:clipboard-text'],
            'openfda_drug_shortages' => ['class' => OpenFdaDrugShortages::class, 'type' => 'read', 'name' => 'Drug Shortages', 'description' => 'Query FDA drug shortage data.', 'icon' => 'ph:chart-line-down'],
            'openfda_device_510k' => ['class' => OpenFdaDevice510k::class, 'type' => 'read', 'name' => 'Device 510(k)', 'description' => 'Query medical device 510(k) clearances.', 'icon' => 'ph:certificate'],
            'openfda_device_classification' => ['class' => OpenFdaDeviceClassification::class, 'type' => 'read', 'name' => 'Device Classification', 'description' => 'Query device classification records.', 'icon' => 'ph:list-checks'],
            'openfda_device_enforcement' => ['class' => OpenFdaDeviceEnforcement::class, 'type' => 'read', 'name' => 'Device Enforcement', 'description' => 'Query device recall enforcement reports.', 'icon' => 'ph:warning'],
            'openfda_device_event' => ['class' => OpenFdaDeviceEvent::class, 'type' => 'read', 'name' => 'Device Event', 'description' => 'Query MAUDE medical device adverse events.', 'icon' => 'ph:activity'],
            'openfda_device_pma' => ['class' => OpenFdaDevicePma::class, 'type' => 'read', 'name' => 'Device PMA', 'description' => 'Query premarket approval records.', 'icon' => 'ph:stamp'],
            'openfda_device_recall' => ['class' => OpenFdaDeviceRecall::class, 'type' => 'read', 'name' => 'Device Recall', 'description' => 'Query device recall records.', 'icon' => 'ph:arrow-counter-clockwise'],
            'openfda_device_registrationlisting' => ['class' => OpenFdaDeviceRegistrationListing::class, 'type' => 'read', 'name' => 'Device Registration Listing', 'description' => 'Query device establishment registration and listing records.', 'icon' => 'ph:buildings'],
            'openfda_device_udi' => ['class' => OpenFdaDeviceUdi::class, 'type' => 'read', 'name' => 'Device UDI', 'description' => 'Query GUDID device identification records.', 'icon' => 'ph:identification-card'],
            'openfda_device_covid19_serology' => ['class' => OpenFdaDeviceCovid19Serology::class, 'type' => 'read', 'name' => 'COVID-19 Serology', 'description' => 'Query COVID-19 serology test evaluations.', 'icon' => 'ph:virus'],
            'openfda_food_enforcement' => ['class' => OpenFdaFoodEnforcement::class, 'type' => 'read', 'name' => 'Food Enforcement', 'description' => 'Query food recall enforcement reports.', 'icon' => 'ph:fork-knife'],
            'openfda_food_event' => ['class' => OpenFdaFoodEvent::class, 'type' => 'read', 'name' => 'Food Event', 'description' => 'Query CAERS food, dietary supplement, and cosmetic adverse event reports.', 'icon' => 'ph:activity'],
            'openfda_animal_veterinary_event' => ['class' => OpenFdaAnimalVeterinaryEvent::class, 'type' => 'read', 'name' => 'Animal Veterinary Event', 'description' => 'Query animal and veterinary adverse event reports.', 'icon' => 'ph:first-aid'],
            'openfda_cosmetic_event' => ['class' => OpenFdaCosmeticEvent::class, 'type' => 'read', 'name' => 'Cosmetic Event', 'description' => 'Query cosmetic adverse event reports.', 'icon' => 'ph:sparkle'],
            'openfda_tobacco_problem' => ['class' => OpenFdaTobaccoProblem::class, 'type' => 'read', 'name' => 'Tobacco Problem', 'description' => 'Query tobacco product problem reports.', 'icon' => 'ph:warning-octagon'],
            'openfda_other_nsde' => ['class' => OpenFdaOtherNsde::class, 'type' => 'read', 'name' => 'NSDE', 'description' => 'Query National Substance Data Exchange records.', 'icon' => 'ph:database'],
            'openfda_other_substance' => ['class' => OpenFdaOtherSubstance::class, 'type' => 'read', 'name' => 'Substance', 'description' => 'Query FDA substance records.', 'icon' => 'ph:flask'],
            'openfda_other_unii' => ['class' => OpenFdaOtherUnii::class, 'type' => 'read', 'name' => 'UNII', 'description' => 'Query Unique Ingredient Identifier records.', 'icon' => 'ph:fingerprint'],
            'openfda_other_historicaldocument' => ['class' => OpenFdaOtherHistoricalDocument::class, 'type' => 'read', 'name' => 'Historical Documents', 'description' => 'Query openFDA historical documents.', 'icon' => 'ph:archive'],
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
     * Create an openFDA tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional context, unused for public endpoints.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class(app(OpenFdaService::class));
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/openfda.md';
    }
}
