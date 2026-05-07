<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Create a group entitlement with license rule, extension rule..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://vsaex.dev.azure.com/{organization}/_apis/groupentitlements.
 */
class AzureDevOpsMemberEntitlementManagementGroupEntitlementsAdd extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_member_entitlement_management_group_entitlements_add';
    protected const DESCRIPTION = 'Create a group entitlement with license rule, extension rule.

Official Azure DevOps REST API 7.2 endpoint: POST https://vsaex.dev.azure.com/{organization}/_apis/groupentitlements (spec: memberEntitlementManagement/7.2/memberEntitlementManagement.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'GroupEntitlement object specifying License Rule, Extensions Rule for the group. Based on the rules the members of the group will be given licenses and extensions. The Group Entitlement can be used to add the group to another project level groups'], 'rule_option' => ['type' => 'string', 'required' => false, 'description' => 'RuleOption [ApplyGroupRule/TestApplyGroupRule] - specifies if the rules defined in group entitlement should be created and applied to it’s members (default option) or just be tested'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'vsaex.dev.azure.com';
    protected const PATH = '/{organization}/_apis/groupentitlements';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['ruleOption' => 'rule_option', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
