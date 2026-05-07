<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get a list of terminal actions.
 *
 * Executes the official Adyen management API operation get-companies-companyId-terminalActions.
 */
class AdyenManagementGetCompaniesCompanyIdTerminalActions extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_companies_company_id_terminal_actions';
}
