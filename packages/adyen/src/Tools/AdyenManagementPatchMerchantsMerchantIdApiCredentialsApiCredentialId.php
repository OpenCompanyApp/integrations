<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Update an API credential.
 *
 * Executes the official Adyen management API operation patch-merchants-merchantId-apiCredentials-apiCredentialId.
 */
class AdyenManagementPatchMerchantsMerchantIdApiCredentialsApiCredentialId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_patch_merchants_merchant_id_api_credentials_api_credential_id';
}
