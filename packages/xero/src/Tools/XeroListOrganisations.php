<?php

namespace OpenCompany\Integrations\Xero\Tools;

use OpenCompany\Integrations\Xero\XeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List connected Xero organisations.
 *
 * Returns organisation details including name, legal name, currency, and country.
 */
class XeroListOrganisations implements Tool
{
    /**
     * @param  XeroService  $service  The Xero API client
     */
    public function __construct(
        private XeroService $service,
    ) {}

    public function name(): string
    {
        return 'xero_list_organisations';
    }

    public function description(): string
    {
        return <<<'MD'
        List connected Xero organisations.
        Returns organisation details including name, legal name, currency, and country.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List connected Xero organisations.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Xero integration is not configured.');
            }

            $result = $this->service->listOrganisations();

            $orgs = array_map(function (array $o) {
                return [
                    'id' => $o['OrganisationID'] ?? '',
                    'name' => $o['Name'] ?? '',
                    'legal_name' => $o['LegalName'] ?? '',
                    'short_code' => $o['ShortCode'] ?? '',
                    'country' => $o['CountryCode'] ?? '',
                    'currency' => $o['BaseCurrency'] ?? '',
                    'organisation_type' => $o['OrganisationType'] ?? '',
                    'registration_number' => $o['RegistrationNumber'] ?? null,
                    'tax_number' => $o['TaxNumber'] ?? null,
                ];
            }, $result['Organisations'] ?? []);

            return ToolResult::success([
                'organisations' => $orgs,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
