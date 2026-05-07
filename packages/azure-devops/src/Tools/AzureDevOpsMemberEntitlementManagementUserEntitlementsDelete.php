<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Delete a user from the account. The delete operation includes unassigning Extensions and Licenses and removing the user from all project memberships. The user would continue to have access to the account if she is member of an AAD group, that is added directly to the account..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://vsaex.dev.azure.com/{organization}/_apis/userentitlements/{userId}.
 */
class AzureDevOpsMemberEntitlementManagementUserEntitlementsDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_member_entitlement_management_user_entitlements_delete';
    protected const DESCRIPTION = 'Delete a user from the account. The delete operation includes unassigning Extensions and Licenses and removing the user from all project memberships. The user would continue to have access to the account if she is member of an AAD group, that is added directly to the account.

Official Azure DevOps REST API 7.2 endpoint: DELETE https://vsaex.dev.azure.com/{organization}/_apis/userentitlements/{userId} (spec: memberEntitlementManagement/7.2/memberEntitlementManagement.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'user_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the user.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.5`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'vsaex.dev.azure.com';
    protected const PATH = '/{organization}/_apis/userentitlements/{userId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'userId' => 'user_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.5';
}
