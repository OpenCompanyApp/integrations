<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Add a user, assign license and extensions and make them a member of a project group in an account..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://vsaex.dev.azure.com/{organization}/_apis/userentitlements.
 */
class AzureDevOpsMemberEntitlementManagementUserEntitlementsAdd extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_member_entitlement_management_user_entitlements_add';
    protected const DESCRIPTION = 'Add a user, assign license and extensions and make them a member of a project group in an account.

Official Azure DevOps REST API 7.2 endpoint: POST https://vsaex.dev.azure.com/{organization}/_apis/userentitlements (spec: memberEntitlementManagement/7.2/memberEntitlementManagement.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'UserEntitlement object specifying License, Extensions and Project/Team groups the user should be added to.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.5`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'vsaex.dev.azure.com';
    protected const PATH = '/{organization}/_apis/userentitlements';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.5';
}
