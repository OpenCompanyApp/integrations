<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get User Entitlement for a user..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vsaex.dev.azure.com/{organization}/_apis/userentitlements/{userId}.
 */
class AzureDevOpsMemberEntitlementManagementUserEntitlementsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_member_entitlement_management_user_entitlements_get';
    protected const DESCRIPTION = 'Get User Entitlement for a user.

Official Azure DevOps REST API 7.2 endpoint: GET https://vsaex.dev.azure.com/{organization}/_apis/userentitlements/{userId} (spec: memberEntitlementManagement/7.2/memberEntitlementManagement.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'user_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the user.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.5`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vsaex.dev.azure.com';
    protected const PATH = '/{organization}/_apis/userentitlements/{userId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'userId' => 'user_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.5';
}
