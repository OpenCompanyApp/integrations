<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get Android app.
 *
 * Executes the official Adyen management API operation get-companies-companyId-androidApps-id.
 */
class AdyenManagementGetCompaniesCompanyIdAndroidAppsId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_companies_company_id_android_apps_id';
}
