<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Edit the entitlements (License, Extensions, Projects, Teams etc) for a service principal..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://vsaex.dev.azure.com/{organization}/_apis/serviceprincipalentitlements/{servicePrincipalId}.
 */
class AzureDevOpsMemberEntitlementManagementServicePrincipalEntitlementsUpdateServicePrincipalEntitlement extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_member_entitlement_management_service_principal_entitlements_update_service_principal_entitlement';
    protected const DESCRIPTION = 'Edit the entitlements (License, Extensions, Projects, Teams etc) for a service principal.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://vsaex.dev.azure.com/{organization}/_apis/serviceprincipalentitlements/{servicePrincipalId} (spec: memberEntitlementManagement/7.2/memberEntitlementManagement.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'JsonPatchDocument containing the operations to perform on the service principal.'], 'service_principal_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the service principal.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'vsaex.dev.azure.com';
    protected const PATH = '/{organization}/_apis/serviceprincipalentitlements/{servicePrincipalId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'servicePrincipalId' => 'service_principal_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
