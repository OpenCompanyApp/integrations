<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Update the split logic.
 *
 * Executes the official Adyen management API operation patch-merchants-merchantId-splitConfigurations-splitConfigurationId-rules-ruleId-splitLogic-splitLogicId.
 */
class AdyenManagementPatchMerchantsMerchantIdSplitConfigurationsSplitConfigurationIdRulesRuleIdSplitLogicSplitLogicId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_patch_merchants_merchant_id_split_configurations_split_configuration_id_rules_rule_id_split_logic_split_logic_id';
}
