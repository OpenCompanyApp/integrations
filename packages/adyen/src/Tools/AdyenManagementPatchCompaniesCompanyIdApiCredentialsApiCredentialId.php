<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Update an API credential..
 *
 * Executes the official Adyen management API operation patch-companies-companyId-apiCredentials-apiCredentialId.
 */
class AdyenManagementPatchCompaniesCompanyIdApiCredentialsApiCredentialId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_patch_companies_company_id_api_credentials_api_credential_id';
}
