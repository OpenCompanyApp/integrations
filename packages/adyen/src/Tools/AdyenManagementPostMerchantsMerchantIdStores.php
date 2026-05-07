<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Create a store.
 *
 * Executes the official Adyen management API operation post-merchants-merchantId-stores.
 */
class AdyenManagementPostMerchantsMerchantIdStores extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_post_merchants_merchant_id_stores';
}
