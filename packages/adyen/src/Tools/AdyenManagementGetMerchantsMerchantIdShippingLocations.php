<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get a list of shipping locations.
 *
 * Executes the official Adyen management API operation get-merchants-merchantId-shippingLocations.
 */
class AdyenManagementGetMerchantsMerchantIdShippingLocations extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_merchants_merchant_id_shipping_locations';
}
