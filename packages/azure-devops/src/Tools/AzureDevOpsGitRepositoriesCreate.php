<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Create a git repository in a team project..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{project}/_apis/git/repositories.
 */
class AzureDevOpsGitRepositoriesCreate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_repositories_create';
    protected const DESCRIPTION = 'Create a git repository in a team project.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{project}/_apis/git/repositories (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Specify the repo name, team project and/or parent repository. Team project information can be omitted from gitRepositoryToCreate if the request is project-scoped (i.e., includes project Id).'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'source_ref' => ['type' => 'string', 'required' => false, 'description' => '[optional] Specify the source refs to use while creating a fork repo'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['sourceRef' => 'source_ref', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
