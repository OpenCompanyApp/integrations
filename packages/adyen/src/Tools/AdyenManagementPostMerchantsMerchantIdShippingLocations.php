<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Create a shipping location.
 *
 * Executes the official Adyen management API operation post-merchants-merchantId-shippingLocations.
 */
class AdyenManagementPostMerchantsMerchantIdShippingLocations extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_post_merchants_merchant_id_shipping_locations';
}
