<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Update entitlements (License Rule, Extensions Rule, Project memberships etc.) for a group..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://vsaex.dev.azure.com/{organization}/_apis/groupentitlements/{groupId}.
 */
class AzureDevOpsMemberEntitlementManagementGroupEntitlementsUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_member_entitlement_management_group_entitlements_update';
    protected const DESCRIPTION = 'Update entitlements (License Rule, Extensions Rule, Project memberships etc.) for a group.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://vsaex.dev.azure.com/{organization}/_apis/groupentitlements/{groupId} (spec: memberEntitlementManagement/7.2/memberEntitlementManagement.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'JsonPatchDocument containing the operations to perform on the group.'], 'group_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the group.'], 'rule_option' => ['type' => 'string', 'required' => false, 'description' => 'RuleOption [ApplyGroupRule/TestApplyGroupRule] - specifies if the rules defined in group entitlement should be updated and the changes are applied to it’s members (default option) or just be tested'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'vsaex.dev.azure.com';
    protected const PATH = '/{organization}/_apis/groupentitlements/{groupId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'groupId' => 'group_id'];
    protected const QUERY_PARAMS = ['ruleOption' => 'rule_option', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
