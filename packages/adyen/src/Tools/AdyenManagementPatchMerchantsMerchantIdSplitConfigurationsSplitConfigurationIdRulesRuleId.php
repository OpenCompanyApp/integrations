<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Update the split conditions.
 *
 * Executes the official Adyen management API operation patch-merchants-merchantId-splitConfigurations-splitConfigurationId-rules-ruleId.
 */
class AdyenManagementPatchMerchantsMerchantIdSplitConfigurationsSplitConfigurationIdRulesRuleId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_patch_merchants_merchant_id_split_configurations_split_configuration_id_rules_rule_id';
}
