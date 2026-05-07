<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Generate new API key.
 *
 * Executes the official Adyen management API operation post-merchants-merchantId-apiCredentials-apiCredentialId-generateApiKey.
 */
class AdyenManagementPostMerchantsMerchantIdApiCredentialsApiCredentialIdGenerateApiKey extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_post_merchants_merchant_id_api_credentials_api_credential_id_generate_api_key';
}
