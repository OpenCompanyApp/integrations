<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Queues a project to be deleted. Use the [GetOperation](../../operations/operations/get) to periodically check for delete project status..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://dev.azure.com/{organization}/_apis/projects/{projectId}.
 */
class AzureDevOpsCoreProjectsDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_core_projects_delete';
    protected const DESCRIPTION = 'Queues a project to be deleted. Use the [GetOperation](../../operations/operations/get) to periodically check for delete project status.

Official Azure DevOps REST API 7.2 endpoint: DELETE https://dev.azure.com/{organization}/_apis/projects/{projectId} (spec: core/7.2/core.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project id of the project to delete.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.4`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/projects/{projectId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'projectId' => 'project_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.4';
}
