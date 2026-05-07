<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Delete a split configuration profile.
 *
 * Executes the official Adyen management API operation delete-merchants-merchantId-splitConfigurations-splitConfigurationId.
 */
class AdyenManagementDeleteMerchantsMerchantIdSplitConfigurationsSplitConfigurationId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_delete_merchants_merchant_id_split_configurations_split_configuration_id';
}
