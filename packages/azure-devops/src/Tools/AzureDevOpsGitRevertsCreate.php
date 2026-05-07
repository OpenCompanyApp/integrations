<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Starts the operation to create a new branch which reverts changes introduced by either a specific commit or commits that are associated to a pull request..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/reverts.
 */
class AzureDevOpsGitRevertsCreate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_reverts_create';
    protected const DESCRIPTION = 'Starts the operation to create a new branch which reverts changes introduced by either a specific commit or commits that are associated to a pull request.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/reverts (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Azure DevOps Swagger schema.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'repository_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the repository.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryId}/reverts';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'repositoryId' => 'repository_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
