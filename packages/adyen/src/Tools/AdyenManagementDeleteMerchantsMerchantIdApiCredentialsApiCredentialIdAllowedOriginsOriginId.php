<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Delete an allowed origin.
 *
 * Executes the official Adyen management API operation delete-merchants-merchantId-apiCredentials-apiCredentialId-allowedOrigins-originId.
 */
class AdyenManagementDeleteMerchantsMerchantIdApiCredentialsApiCredentialIdAllowedOriginsOriginId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_delete_merchants_merchant_id_api_credentials_api_credential_id_allowed_origins_origin_id';
}
