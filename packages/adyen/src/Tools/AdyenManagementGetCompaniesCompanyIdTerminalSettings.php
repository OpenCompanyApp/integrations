<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get terminal settings.
 *
 * Executes the official Adyen management API operation get-companies-companyId-terminalSettings.
 */
class AdyenManagementGetCompaniesCompanyIdTerminalSettings extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_companies_company_id_terminal_settings';
}
