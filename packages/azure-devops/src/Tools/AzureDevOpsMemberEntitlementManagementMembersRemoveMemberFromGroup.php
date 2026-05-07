<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Remove a member from a Group..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://vsaex.dev.azure.com/{organization}/_apis/GroupEntitlements/{groupId}/members/{memberId}.
 */
class AzureDevOpsMemberEntitlementManagementMembersRemoveMemberFromGroup extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_member_entitlement_management_members_remove_member_from_group';
    protected const DESCRIPTION = 'Remove a member from a Group.

Official Azure DevOps REST API 7.2 endpoint: DELETE https://vsaex.dev.azure.com/{organization}/_apis/GroupEntitlements/{groupId}/members/{memberId} (spec: memberEntitlementManagement/7.2/memberEntitlementManagement.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'group_id' => ['type' => 'string', 'required' => true, 'description' => 'Id of the group.'], 'member_id' => ['type' => 'string', 'required' => true, 'description' => 'Id of the member to remove.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'vsaex.dev.azure.com';
    protected const PATH = '/{organization}/_apis/GroupEntitlements/{groupId}/members/{memberId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'groupId' => 'group_id', 'memberId' => 'member_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
