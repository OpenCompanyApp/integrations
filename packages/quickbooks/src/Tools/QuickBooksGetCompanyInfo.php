<?php

namespace OpenCompany\Integrations\QuickBooks\Tools;

use OpenCompany\Integrations\QuickBooks\QuickBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve QuickBooks company information for the connected realm.
 *
 * Returns company name, legal name, address, and other company details.
 */
class QuickBooksGetCompanyInfo implements Tool
{
    /**
     * @param  QuickBooksService  $service  The QuickBooks API client
     */
    public function __construct(
        private QuickBooksService $service,
    ) {}

    public function name(): string
    {
        return 'quickbooks_get_company_info';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve QuickBooks company information for the connected realm.
        Returns company name, legal name, address, and fiscal year details.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Retrieve QuickBooks company information.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('QuickBooks integration is not configured.');
            }

            $result = $this->service->getCompanyInfo();
            $company = $result['CompanyInfo'] ?? $result;

            return ToolResult::success([
                'id' => $company['Id'] ?? '',
                'company_name' => $company['CompanyName'] ?? '',
                'legal_name' => $company['LegalName'] ?? null,
                'fiscal_year_start_month' => $company['FiscalYearStartMonth'] ?? null,
                'country' => $company['Country'] ?? null,
                'email' => $company['Email']['Address'] ?? null,
                'phone' => $company['PrimaryPhone']['FreeFormNumber'] ?? null,
                'address' => [
                    'line1' => $company['CompanyAddr']['Line1'] ?? null,
                    'city' => $company['CompanyAddr']['City'] ?? null,
                    'state' => $company['CompanyAddr']['CountrySubDivisionCode'] ?? null,
                    'postal_code' => $company['CompanyAddr']['PostalCode'] ?? null,
                    'country' => $company['CompanyAddr']['Country'] ?? null,
                ],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
