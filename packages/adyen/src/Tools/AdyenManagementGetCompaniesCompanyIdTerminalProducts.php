<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get a list of terminal products.
 *
 * Executes the official Adyen management API operation get-companies-companyId-terminalProducts.
 */
class AdyenManagementGetCompaniesCompanyIdTerminalProducts extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_companies_company_id_terminal_products';
}
