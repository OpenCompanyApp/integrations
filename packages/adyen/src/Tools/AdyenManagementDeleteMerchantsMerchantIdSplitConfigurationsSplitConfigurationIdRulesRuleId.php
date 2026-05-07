<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Delete a rule.
 *
 * Executes the official Adyen management API operation delete-merchants-merchantId-splitConfigurations-splitConfigurationId-rules-ruleId.
 */
class AdyenManagementDeleteMerchantsMerchantIdSplitConfigurationsSplitConfigurationIdRulesRuleId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_delete_merchants_merchant_id_split_configurations_split_configuration_id_rules_rule_id';
}
