<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get role assignments for the resource.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/securityroles/scopes/{scopeId}/roleassignments/resources/{resourceId}.
 */
class AzureDevOpsSecurityRolesRoleassignmentsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_security_roles_roleassignments_list';
    protected const DESCRIPTION = 'Get role assignments for the resource

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/securityroles/scopes/{scopeId}/roleassignments/resources/{resourceId} (spec: securityRoles/7.2/securityRoles.json).';
    protected const PARAMETERS = ['scope_id' => ['type' => 'string', 'required' => true, 'description' => 'Id of the assigned scope'], 'resource_id' => ['type' => 'string', 'required' => true, 'description' => 'Id of the resource that is assigned the scope'], 'organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/securityroles/scopes/{scopeId}/roleassignments/resources/{resourceId}';
    protected const PATH_PARAMS = ['scopeId' => 'scope_id', 'resourceId' => 'resource_id', 'organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
