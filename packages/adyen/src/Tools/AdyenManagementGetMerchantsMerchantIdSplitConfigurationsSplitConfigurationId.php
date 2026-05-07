<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get a split configuration profile.
 *
 * Executes the official Adyen management API operation get-merchants-merchantId-splitConfigurations-splitConfigurationId.
 */
class AdyenManagementGetMerchantsMerchantIdSplitConfigurationsSplitConfigurationId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_merchants_merchant_id_split_configurations_split_configuration_id';
}
