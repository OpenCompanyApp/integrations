<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Create a split configuration profile.
 *
 * Executes the official Adyen management API operation post-merchants-merchantId-splitConfigurations.
 */
class AdyenManagementPostMerchantsMerchantIdSplitConfigurations extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_post_merchants_merchant_id_split_configurations';
}
