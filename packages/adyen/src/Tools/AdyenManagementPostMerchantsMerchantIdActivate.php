<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Request to activate a merchant account.
 *
 * Executes the official Adyen management API operation post-merchants-merchantId-activate.
 */
class AdyenManagementPostMerchantsMerchantIdActivate extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_post_merchants_merchant_id_activate';
}
