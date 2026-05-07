<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Create an annotated tag. Repositories have both a name and an identifier. Identifiers are globally unique, but several projects may contain a repository of the same name. You don't need to include the project if you specify a repository by ID. However, if you specify a repository by name, you must also specify the project (by name or ID)..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/annotatedtags.
 */
class AzureDevOpsGitAnnotatedTagsCreate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_annotated_tags_create';
    protected const DESCRIPTION = 'Create an annotated tag. Repositories have both a name and an identifier. Identifiers are globally unique, but several projects may contain a repository of the same name. You don\'t need to include the project if you specify a repository by ID. However, if you specify a repository by name, you must also specify the project (by name or ID).

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/annotatedtags (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Object containing details of tag to be created.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'repository_id' => ['type' => 'string', 'required' => true, 'description' => 'ID or name of the repository.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryId}/annotatedtags';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'repositoryId' => 'repository_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
