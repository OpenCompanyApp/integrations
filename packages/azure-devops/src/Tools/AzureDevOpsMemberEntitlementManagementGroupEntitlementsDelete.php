<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Delete a group entitlement..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://vsaex.dev.azure.com/{organization}/_apis/groupentitlements/{groupId}.
 */
class AzureDevOpsMemberEntitlementManagementGroupEntitlementsDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_member_entitlement_management_group_entitlements_delete';
    protected const DESCRIPTION = 'Delete a group entitlement.

Official Azure DevOps REST API 7.2 endpoint: DELETE https://vsaex.dev.azure.com/{organization}/_apis/groupentitlements/{groupId} (spec: memberEntitlementManagement/7.2/memberEntitlementManagement.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'group_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the group to delete.'], 'rule_option' => ['type' => 'string', 'required' => false, 'description' => 'RuleOption [ApplyGroupRule/TestApplyGroupRule] - specifies if the rules defined in group entitlement should be deleted and the changes are applied to it’s members (default option) or just be tested'], 'remove_group_membership' => ['type' => 'boolean', 'required' => false, 'description' => 'Optional parameter that specifies whether the group with the given ID should be removed from all other groups'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'vsaex.dev.azure.com';
    protected const PATH = '/{organization}/_apis/groupentitlements/{groupId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'groupId' => 'group_id'];
    protected const QUERY_PARAMS = ['ruleOption' => 'rule_option', 'removeGroupMembership' => 'remove_group_membership', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
