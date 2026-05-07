<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get a list of Android apps.
 *
 * Executes the official Adyen management API operation get-companies-companyId-androidApps.
 */
class AdyenManagementGetCompaniesCompanyIdAndroidApps extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_companies_company_id_android_apps';
}
