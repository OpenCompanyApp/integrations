<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get a list of terminal models.
 *
 * Executes the official Adyen management API operation get-companies-companyId-terminalModels.
 */
class AdyenManagementGetCompaniesCompanyIdTerminalModels extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_companies_company_id_terminal_models';
}
