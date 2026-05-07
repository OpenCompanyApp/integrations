<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Add a payout setting.
 *
 * Executes the official Adyen management API operation post-merchants-merchantId-payoutSettings.
 */
class AdyenManagementPostMerchantsMerchantIdPayoutSettings extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_post_merchants_merchant_id_payout_settings';
}
