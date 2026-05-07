<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get Item Metadata and/or Content for a collection of items. The download parameter is to indicate whether the content should be available as a download or just sent as a stream in the response. Doesn't apply to zipped content which is always returned as a download..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/items.
 */
class AzureDevOpsGitItemsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_items_list';
    protected const DESCRIPTION = 'Get Item Metadata and/or Content for a collection of items. The download parameter is to indicate whether the content should be available as a download or just sent as a stream in the response. Doesn\'t apply to zipped content which is always returned as a download.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/items (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'repository_id' => ['type' => 'string', 'required' => true, 'description' => 'The name or ID of the repository.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'scope_path' => ['type' => 'string', 'required' => false, 'description' => 'The path scope. The default is null.'], 'recursion_level' => ['type' => 'string', 'required' => false, 'description' => 'The recursion level of this request. The default is \'none\', no recursion.'], 'include_content_metadata' => ['type' => 'boolean', 'required' => false, 'description' => 'Set to true to include content metadata. Default is false.'], 'latest_processed_change' => ['type' => 'boolean', 'required' => false, 'description' => 'Set to true to include the latest changes. Default is false.'], 'download' => ['type' => 'boolean', 'required' => false, 'description' => 'Set to true to download the response as a file. Default is false.'], 'include_links' => ['type' => 'boolean', 'required' => false, 'description' => 'Set to true to include links to items. Default is false.'], 'format' => ['type' => 'string', 'required' => false, 'description' => 'If specified, this overrides the HTTP Accept request header to return either \'json\' or \'zip\'. If $format is specified, then api-version should also be specified as a query parameter.'], 'version_descriptor_version' => ['type' => 'string', 'required' => false, 'description' => 'Version string identifier (name of tag/branch, SHA1 of commit)'], 'version_descriptor_version_options' => ['type' => 'string', 'required' => false, 'description' => 'Version options - Specify additional modifiers to version (e.g Previous)'], 'version_descriptor_version_type' => ['type' => 'string', 'required' => false, 'description' => 'Version type (branch, tag, or commit). Determines how Id is interpreted'], 'zip_for_unix' => ['type' => 'boolean', 'required' => false, 'description' => 'Set to true to keep the file permissions for unix (and POSIX) systems like executables and symlinks'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryId}/items';
    protected const PATH_PARAMS = ['organization' => 'organization', 'repositoryId' => 'repository_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['scopePath' => 'scope_path', 'recursionLevel' => 'recursion_level', 'includeContentMetadata' => 'include_content_metadata', 'latestProcessedChange' => 'latest_processed_change', 'download' => 'download', 'includeLinks' => 'include_links', '$format' => 'format', 'versionDescriptor.version' => 'version_descriptor_version', 'versionDescriptor.versionOptions' => 'version_descriptor_version_options', 'versionDescriptor.versionType' => 'version_descriptor_version_type', 'zipForUnix' => 'zip_for_unix', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
