<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get terminal action.
 *
 * Executes the official Adyen management API operation get-companies-companyId-terminalActions-actionId.
 */
class AdyenManagementGetCompaniesCompanyIdTerminalActionsActionId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_companies_company_id_terminal_actions_action_id';
}
