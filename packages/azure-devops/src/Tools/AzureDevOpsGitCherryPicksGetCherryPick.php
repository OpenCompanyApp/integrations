<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Retrieve information about a cherry pick operation by cherry pick Id..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/cherryPicks/{cherryPickId}.
 */
class AzureDevOpsGitCherryPicksGetCherryPick extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_cherry_picks_get_cherry_pick';
    protected const DESCRIPTION = 'Retrieve information about a cherry pick operation by cherry pick Id.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/cherryPicks/{cherryPickId} (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'cherry_pick_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the cherry pick.'], 'repository_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the repository.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryId}/cherryPicks/{cherryPickId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'cherryPickId' => 'cherry_pick_id', 'repositoryId' => 'repository_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
