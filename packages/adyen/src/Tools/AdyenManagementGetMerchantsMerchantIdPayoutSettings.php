<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get a list of payout settings.
 *
 * Executes the official Adyen management API operation get-merchants-merchantId-payoutSettings.
 */
class AdyenManagementGetMerchantsMerchantIdPayoutSettings extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_merchants_merchant_id_payout_settings';
}
