<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Add a service principal, assign license and extensions and make them a member of a project group in an account. NOTE: If you are working with AAD app registration, you can find service principal of your app in enterprise applications, and make sure to use service principal's object id as originId parameter in the request body.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://vsaex.dev.azure.com/{organization}/_apis/serviceprincipalentitlements.
 */
class AzureDevOpsMemberEntitlementManagementServicePrincipalEntitlementsAdd extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_member_entitlement_management_service_principal_entitlements_add';
    protected const DESCRIPTION = 'Add a service principal, assign license and extensions and make them a member of a project group in an account. NOTE: If you are working with AAD app registration, you can find service principal of your app in enterprise applications, and make sure to use service principal\'s object id as originId parameter in the request body

Official Azure DevOps REST API 7.2 endpoint: POST https://vsaex.dev.azure.com/{organization}/_apis/serviceprincipalentitlements (spec: memberEntitlementManagement/7.2/memberEntitlementManagement.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'ServicePrincipalEntitlement object specifying License, Extensions and Project/Team groups the service principal should be added to.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'vsaex.dev.azure.com';
    protected const PATH = '/{organization}/_apis/serviceprincipalentitlements';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
