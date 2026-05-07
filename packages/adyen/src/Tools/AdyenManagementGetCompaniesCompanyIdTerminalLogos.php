<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get the terminal logo.
 *
 * Executes the official Adyen management API operation get-companies-companyId-terminalLogos.
 */
class AdyenManagementGetCompaniesCompanyIdTerminalLogos extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_companies_company_id_terminal_logos';
}
