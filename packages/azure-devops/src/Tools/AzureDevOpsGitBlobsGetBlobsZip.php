<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets one or more blobs in a zip file download..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/blobs.
 */
class AzureDevOpsGitBlobsGetBlobsZip extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_blobs_get_blobs_zip';
    protected const DESCRIPTION = 'Gets one or more blobs in a zip file download.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/blobs (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Blob IDs (SHA1 hashes) to be returned in the zip file.'], 'repository_id' => ['type' => 'string', 'required' => true, 'description' => 'The name or ID of the repository.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'filename' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `filename`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryId}/blobs';
    protected const PATH_PARAMS = ['organization' => 'organization', 'repositoryId' => 'repository_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['filename' => 'filename', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
