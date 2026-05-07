<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Update the terminal logo.
 *
 * Executes the official Adyen management API operation patch-companies-companyId-terminalLogos.
 */
class AdyenManagementPatchCompaniesCompanyIdTerminalLogos extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_patch_companies_company_id_terminal_logos';
}
