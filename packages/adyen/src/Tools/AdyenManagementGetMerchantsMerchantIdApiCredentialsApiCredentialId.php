<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get an API credential.
 *
 * Executes the official Adyen management API operation get-merchants-merchantId-apiCredentials-apiCredentialId.
 */
class AdyenManagementGetMerchantsMerchantIdApiCredentialsApiCredentialId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_merchants_merchant_id_api_credentials_api_credential_id';
}
