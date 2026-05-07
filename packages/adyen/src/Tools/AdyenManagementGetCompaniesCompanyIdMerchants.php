<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get a list of merchant accounts.
 *
 * Executes the official Adyen management API operation get-companies-companyId-merchants.
 */
class AdyenManagementGetCompaniesCompanyIdMerchants extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_companies_company_id_merchants';
}
