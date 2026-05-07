<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Delete a service principal from the account. The delete operation includes unassigning Extensions and Licenses and removing the service principal from all project memberships. The service principal would continue to have access to the account if it is member of an AAD group, that is added directly to the account..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://vsaex.dev.azure.com/{organization}/_apis/serviceprincipalentitlements/{servicePrincipalId}.
 */
class AzureDevOpsMemberEntitlementManagementServicePrincipalEntitlementsDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_member_entitlement_management_service_principal_entitlements_delete';
    protected const DESCRIPTION = 'Delete a service principal from the account. The delete operation includes unassigning Extensions and Licenses and removing the service principal from all project memberships. The service principal would continue to have access to the account if it is member of an AAD group, that is added directly to the account.

Official Azure DevOps REST API 7.2 endpoint: DELETE https://vsaex.dev.azure.com/{organization}/_apis/serviceprincipalentitlements/{servicePrincipalId} (spec: memberEntitlementManagement/7.2/memberEntitlementManagement.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'service_principal_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the service principal.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'vsaex.dev.azure.com';
    protected const PATH = '/{organization}/_apis/serviceprincipalentitlements/{servicePrincipalId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'servicePrincipalId' => 'service_principal_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
