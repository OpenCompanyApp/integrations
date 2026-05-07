<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Delete the specified environment..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://dev.azure.com/{organization}/{project}/_apis/pipelines/environments/{environmentId}.
 */
class AzureDevOpsEnvironmentsEnvironmentsDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_environments_environments_delete';
    protected const DESCRIPTION = 'Delete the specified environment.

Official Azure DevOps REST API 7.2 endpoint: DELETE https://dev.azure.com/{organization}/{project}/_apis/pipelines/environments/{environmentId} (spec: environments/7.2/environments.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'environment_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the environment.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/pipelines/environments/{environmentId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'environmentId' => 'environment_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
