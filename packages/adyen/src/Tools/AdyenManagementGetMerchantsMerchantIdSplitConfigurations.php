<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get a list of split configuration profiles.
 *
 * Executes the official Adyen management API operation get-merchants-merchantId-splitConfigurations.
 */
class AdyenManagementGetMerchantsMerchantIdSplitConfigurations extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_merchants_merchant_id_split_configurations';
}
