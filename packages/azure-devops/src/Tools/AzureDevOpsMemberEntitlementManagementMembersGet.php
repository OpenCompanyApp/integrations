<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get direct members of a Group..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vsaex.dev.azure.com/{organization}/_apis/GroupEntitlements/{groupId}/members.
 */
class AzureDevOpsMemberEntitlementManagementMembersGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_member_entitlement_management_members_get';
    protected const DESCRIPTION = 'Get direct members of a Group.

Official Azure DevOps REST API 7.2 endpoint: GET https://vsaex.dev.azure.com/{organization}/_apis/GroupEntitlements/{groupId}/members (spec: memberEntitlementManagement/7.2/memberEntitlementManagement.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'group_id' => ['type' => 'string', 'required' => true, 'description' => 'Id of the Group.'], 'max_results' => ['type' => 'number', 'required' => false, 'description' => 'Maximum number of results to retrieve.'], 'paging_token' => ['type' => 'string', 'required' => false, 'description' => 'Paging Token from the previous page fetched. If the \'pagingToken\' is null, the results would be fetched from the beginning of the Members List.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vsaex.dev.azure.com';
    protected const PATH = '/{organization}/_apis/GroupEntitlements/{groupId}/members';
    protected const PATH_PARAMS = ['organization' => 'organization', 'groupId' => 'group_id'];
    protected const QUERY_PARAMS = ['maxResults' => 'max_results', 'pagingToken' => 'paging_token', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
