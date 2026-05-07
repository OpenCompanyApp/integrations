<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Create a rule.
 *
 * Executes the official Adyen management API operation post-merchants-merchantId-splitConfigurations-splitConfigurationId.
 */
class AdyenManagementPostMerchantsMerchantIdSplitConfigurationsSplitConfigurationId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_post_merchants_merchant_id_split_configurations_split_configuration_id';
}
