<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Edit the entitlements (License, Extensions, Projects, Teams etc) for one or more service principals..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://vsaex.dev.azure.com/{organization}/_apis/serviceprincipalentitlements.
 */
class AzureDevOpsMemberEntitlementManagementServicePrincipalEntitlementsUpdateServicePrincipalEntitlements extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_member_entitlement_management_service_principal_entitlements_update_service_principal_entitlements';
    protected const DESCRIPTION = 'Edit the entitlements (License, Extensions, Projects, Teams etc) for one or more service principals.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://vsaex.dev.azure.com/{organization}/_apis/serviceprincipalentitlements (spec: memberEntitlementManagement/7.2/memberEntitlementManagement.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'JsonPatchDocument containing the operations to perform.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'vsaex.dev.azure.com';
    protected const PATH = '/{organization}/_apis/serviceprincipalentitlements';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
