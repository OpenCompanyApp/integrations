<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Given a ResourceType and ResourceId, returns authorized definitions for that resource..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/pipelines/pipelinepermissions/{resourceType}/{resourceId}.
 */
class AzureDevOpsApprovalsAndChecksPipelinePermissionsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_approvals_and_checks_pipeline_permissions_get';
    protected const DESCRIPTION = 'Given a ResourceType and ResourceId, returns authorized definitions for that resource.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/pipelines/pipelinepermissions/{resourceType}/{resourceId} (spec: approvalsAndChecks/7.2/pipelinePermissions.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'resource_type' => ['type' => 'string', 'required' => true, 'description' => 'path parameter `resourceType`.'], 'resource_id' => ['type' => 'string', 'required' => true, 'description' => 'path parameter `resourceId`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/pipelines/pipelinepermissions/{resourceType}/{resourceId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'resourceType' => 'resource_type', 'resourceId' => 'resource_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
