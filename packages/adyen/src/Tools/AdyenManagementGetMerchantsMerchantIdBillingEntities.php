<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get a list of billing entities.
 *
 * Executes the official Adyen management API operation get-merchants-merchantId-billingEntities.
 */
class AdyenManagementGetMerchantsMerchantIdBillingEntities extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_merchants_merchant_id_billing_entities';
}
