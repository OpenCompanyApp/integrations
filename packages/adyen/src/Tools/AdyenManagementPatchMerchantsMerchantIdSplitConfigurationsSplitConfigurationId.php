<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Update the description of the split configuration profile.
 *
 * Executes the official Adyen management API operation patch-merchants-merchantId-splitConfigurations-splitConfigurationId.
 */
class AdyenManagementPatchMerchantsMerchantIdSplitConfigurationsSplitConfigurationId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_patch_merchants_merchant_id_split_configurations_split_configuration_id';
}
