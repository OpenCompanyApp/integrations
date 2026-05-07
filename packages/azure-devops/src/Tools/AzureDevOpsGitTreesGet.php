<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * The Tree endpoint returns the collection of objects underneath the specified tree. Trees are folders in a Git repository. Repositories have both a name and an identifier. Identifiers are globally unique, but several projects may contain a repository of the same name. You don't need to include the project if you specify a repository by ID. However, if you specify a repository by name, you must also specify the project (by name or ID..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/trees/{sha1}.
 */
class AzureDevOpsGitTreesGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_trees_get';
    protected const DESCRIPTION = 'The Tree endpoint returns the collection of objects underneath the specified tree. Trees are folders in a Git repository. Repositories have both a name and an identifier. Identifiers are globally unique, but several projects may contain a repository of the same name. You don\'t need to include the project if you specify a repository by ID. However, if you specify a repository by name, you must also specify the project (by name or ID.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/trees/{sha1} (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'repository_id' => ['type' => 'string', 'required' => true, 'description' => 'Repository Id.'], 'sha1' => ['type' => 'string', 'required' => true, 'description' => 'SHA1 hash of the tree object.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'project_id' => ['type' => 'string', 'required' => false, 'description' => 'Project Id.'], 'recursive' => ['type' => 'boolean', 'required' => false, 'description' => 'Search recursively. Include trees underneath this tree. Default is false.'], 'file_name' => ['type' => 'string', 'required' => false, 'description' => 'Name to use if a .zip file is returned. Default is the object ID.'], 'format' => ['type' => 'string', 'required' => false, 'description' => 'Use "zip". Defaults to the MIME type set in the Accept header.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryId}/trees/{sha1}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'repositoryId' => 'repository_id', 'sha1' => 'sha1', 'project' => 'project'];
    protected const QUERY_PARAMS = ['projectId' => 'project_id', 'recursive' => 'recursive', 'fileName' => 'file_name', '$format' => 'format', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
