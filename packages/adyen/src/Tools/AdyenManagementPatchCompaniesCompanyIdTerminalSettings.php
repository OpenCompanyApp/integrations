<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Update terminal settings.
 *
 * Executes the official Adyen management API operation patch-companies-companyId-terminalSettings.
 */
class AdyenManagementPatchCompaniesCompanyIdTerminalSettings extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_patch_companies_company_id_terminal_settings';
}
