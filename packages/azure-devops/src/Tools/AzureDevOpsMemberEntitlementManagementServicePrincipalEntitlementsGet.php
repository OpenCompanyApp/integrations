<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get Service principal Entitlement for a service principal..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vsaex.dev.azure.com/{organization}/_apis/serviceprincipalentitlements/{servicePrincipalId}.
 */
class AzureDevOpsMemberEntitlementManagementServicePrincipalEntitlementsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_member_entitlement_management_service_principal_entitlements_get';
    protected const DESCRIPTION = 'Get Service principal Entitlement for a service principal.

Official Azure DevOps REST API 7.2 endpoint: GET https://vsaex.dev.azure.com/{organization}/_apis/serviceprincipalentitlements/{servicePrincipalId} (spec: memberEntitlementManagement/7.2/memberEntitlementManagement.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'service_principal_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the service principal.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vsaex.dev.azure.com';
    protected const PATH = '/{organization}/_apis/serviceprincipalentitlements/{servicePrincipalId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'servicePrincipalId' => 'service_principal_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
