<?php

namespace OpenCompany\Integrations\QuickBooks\Tools;

use OpenCompany\Integrations\QuickBooks\QuickBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get QuickBooks company information.
 *
 * Retrieves company details for the connected QuickBooks realm, including
 * company name, address, and legal name.
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
        Get QuickBooks company information for the connected realm.
        Returns company name, legal name, address, and other company details.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get QuickBooks company information.
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
                'legal_name' => $company['LegalName'] ?? '',
                'country' => $company['Country'] ?? '',
                'email' => $company['Email'] ?? [],
                'address' => $company['CompanyAddr'] ?? [],
                'phone' => $company['PrimaryPhone'] ?? [],
                'fiscal_year_start' => $company['FiscalYearStartMonth'] ?? '',
                'tax_year_start' => $company['TaxFormInfo'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
