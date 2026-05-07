<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * PATCH /{organization}/_apis/securityroles/scopes/{scopeId}/roleassignments/resources/{resourceId}.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://dev.azure.com/{organization}/_apis/securityroles/scopes/{scopeId}/roleassignments/resources/{resourceId}.
 */
class AzureDevOpsSecurityRolesRoleassignmentsRemoveRoleAssignments extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_security_roles_roleassignments_remove_role_assignments';
    protected const DESCRIPTION = 'PATCH /{organization}/_apis/securityroles/scopes/{scopeId}/roleassignments/resources/{resourceId}

Official Azure DevOps REST API 7.2 endpoint: PATCH https://dev.azure.com/{organization}/_apis/securityroles/scopes/{scopeId}/roleassignments/resources/{resourceId} (spec: securityRoles/7.2/securityRoles.json).';
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Azure DevOps Swagger schema.'], 'scope_id' => ['type' => 'string', 'required' => true, 'description' => 'path parameter `scopeId`.'], 'resource_id' => ['type' => 'string', 'required' => true, 'description' => 'path parameter `resourceId`.'], 'organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/securityroles/scopes/{scopeId}/roleassignments/resources/{resourceId}';
    protected const PATH_PARAMS = ['scopeId' => 'scope_id', 'resourceId' => 'resource_id', 'organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
