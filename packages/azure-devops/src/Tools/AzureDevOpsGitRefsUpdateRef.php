<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Lock or Unlock a branch..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/refs.
 */
class AzureDevOpsGitRefsUpdateRef extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_refs_update_ref';
    protected const DESCRIPTION = 'Lock or Unlock a branch.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/refs (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The ref update action (lock/unlock) to perform'], 'repository_id' => ['type' => 'string', 'required' => true, 'description' => 'The name or ID of the repository.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'The name of the branch to lock/unlock'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'project_id' => ['type' => 'string', 'required' => false, 'description' => 'ID or name of the team project. Optional if specifying an ID for repository.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryId}/refs';
    protected const PATH_PARAMS = ['organization' => 'organization', 'repositoryId' => 'repository_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['filter' => 'filter', 'projectId' => 'project_id', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
