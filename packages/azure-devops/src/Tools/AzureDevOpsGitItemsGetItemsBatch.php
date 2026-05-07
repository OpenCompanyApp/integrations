<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Retrieves a batch of items in a repo / project for a given list of paths or a long path.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/itemsbatch.
 */
class AzureDevOpsGitItemsGetItemsBatch extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_items_get_items_batch';
    protected const DESCRIPTION = 'Retrieves a batch of items in a repo / project for a given list of paths or a long path

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/itemsbatch (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request data attributes: ItemDescriptors, IncludeContentMetadata, LatestProcessedChange, IncludeLinks. ItemDescriptors: Collection of items to fetch, including path, version, and recursion level. IncludeContentMetadata: Whether to include metadata for all items LatestProcessedChange: Whether to include shallow ref to commit that last changed each item. IncludeLinks: Whether to include the _links field on the shallow references.'], 'repository_id' => ['type' => 'string', 'required' => true, 'description' => 'The name or ID of the repository'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryId}/itemsbatch';
    protected const PATH_PARAMS = ['organization' => 'organization', 'repositoryId' => 'repository_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
