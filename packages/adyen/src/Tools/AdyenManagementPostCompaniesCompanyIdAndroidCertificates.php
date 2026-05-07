<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Upload Android Certificate.
 *
 * Executes the official Adyen management API operation post-companies-companyId-androidCertificates.
 */
class AdyenManagementPostCompaniesCompanyIdAndroidCertificates extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_post_companies_company_id_android_certificates';
}
