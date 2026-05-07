<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Reprocess Android App.
 *
 * Executes the official Adyen management API operation patch-companies-companyId-androidApps-id.
 */
class AdyenManagementPatchCompaniesCompanyIdAndroidAppsId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_patch_companies_company_id_android_apps_id';
}
