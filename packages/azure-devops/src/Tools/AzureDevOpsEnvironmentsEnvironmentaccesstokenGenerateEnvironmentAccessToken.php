<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * GET a PAT token for creating and deleting deployment targets in an environment..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{project}/_apis/pipelines/environments/environmentaccesstoken/{environmentId}.
 */
class AzureDevOpsEnvironmentsEnvironmentaccesstokenGenerateEnvironmentAccessToken extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_environments_environmentaccesstoken_generate_environment_access_token';
    protected const DESCRIPTION = 'GET a PAT token for creating and deleting deployment targets in an environment.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{project}/_apis/pipelines/environments/environmentaccesstoken/{environmentId} (spec: environments/7.2/environments.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'environment_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the environment in which deployment targets are managed.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.'], 'body' => ['type' => 'object', 'required' => false, 'description' => 'Request body matching the official Azure DevOps Swagger schema.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/pipelines/environments/environmentaccesstoken/{environmentId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'environmentId' => 'environment_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
