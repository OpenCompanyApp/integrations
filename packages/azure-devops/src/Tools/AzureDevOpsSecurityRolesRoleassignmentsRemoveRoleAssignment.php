<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Remove the role assignment on a resource.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://dev.azure.com/{organization}/_apis/securityroles/scopes/{scopeId}/roleassignments/resources/{resourceId}/{identityId}.
 */
class AzureDevOpsSecurityRolesRoleassignmentsRemoveRoleAssignment extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_security_roles_roleassignments_remove_role_assignment';
    protected const DESCRIPTION = 'Remove the role assignment on a resource

Official Azure DevOps REST API 7.2 endpoint: DELETE https://dev.azure.com/{organization}/_apis/securityroles/scopes/{scopeId}/roleassignments/resources/{resourceId}/{identityId} (spec: securityRoles/7.2/securityRoles.json).';
    protected const PARAMETERS = ['scope_id' => ['type' => 'string', 'required' => true, 'description' => 'Id of the assigned scope'], 'resource_id' => ['type' => 'string', 'required' => true, 'description' => 'Id of the resource on which the role is to be removed'], 'identity_id' => ['type' => 'string', 'required' => true, 'description' => 'Identity on which the assignment is to be removed'], 'organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/securityroles/scopes/{scopeId}/roleassignments/resources/{resourceId}/{identityId}';
    protected const PATH_PARAMS = ['scopeId' => 'scope_id', 'resourceId' => 'resource_id', 'identityId' => 'identity_id', 'organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
