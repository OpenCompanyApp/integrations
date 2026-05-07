<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a single blob. Repositories have both a name and an identifier. Identifiers are globally unique, but several projects may contain a repository of the same name. You don't need to include the project if you specify a repository by ID. However, if you specify a repository by name, you must also specify the project (by name or ID)..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/blobs/{sha1}.
 */
class AzureDevOpsGitBlobsGetBlob extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_blobs_get_blob';
    protected const DESCRIPTION = 'Get a single blob. Repositories have both a name and an identifier. Identifiers are globally unique, but several projects may contain a repository of the same name. You don\'t need to include the project if you specify a repository by ID. However, if you specify a repository by name, you must also specify the project (by name or ID).

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/blobs/{sha1} (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'repository_id' => ['type' => 'string', 'required' => true, 'description' => 'The name or ID of the repository.'], 'sha1' => ['type' => 'string', 'required' => true, 'description' => 'SHA1 hash of the file. You can get the SHA1 of a file using the "Git/Items/Get Item" endpoint.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'download' => ['type' => 'boolean', 'required' => false, 'description' => 'If true, prompt for a download rather than rendering in a browser. Note: this value defaults to true if $format is zip'], 'file_name' => ['type' => 'string', 'required' => false, 'description' => 'Provide a fileName to use for a download.'], 'format' => ['type' => 'string', 'required' => false, 'description' => 'Options: json, zip, text, octetstream. If not set, defaults to the MIME type set in the Accept header.'], 'resolve_lfs' => ['type' => 'boolean', 'required' => false, 'description' => 'If true, try to resolve a blob to its LFS contents, if it\'s an LFS pointer file. Only compatible with octet-stream Accept headers or $format types'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryId}/blobs/{sha1}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'repositoryId' => 'repository_id', 'sha1' => 'sha1', 'project' => 'project'];
    protected const QUERY_PARAMS = ['download' => 'download', 'fileName' => 'file_name', '$format' => 'format', 'resolveLfs' => 'resolve_lfs', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
