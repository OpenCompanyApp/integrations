<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Query for packages within the recycle bin. The project parameter must be supplied if the feed was created in a project. If the feed is not associated with any project, omit the project parameter from the request..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://feeds.dev.azure.com/{organization}/{project}/_apis/packaging/Feeds/{feedId}/RecycleBin/Packages.
 */
class AzureDevOpsArtifactsRecycleBinGetRecycleBinPackages extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_artifacts_recycle_bin_get_recycle_bin_packages';
    protected const DESCRIPTION = 'Query for packages within the recycle bin. The project parameter must be supplied if the feed was created in a project. If the feed is not associated with any project, omit the project parameter from the request.

Official Azure DevOps REST API 7.2 endpoint: GET https://feeds.dev.azure.com/{organization}/{project}/_apis/packaging/Feeds/{feedId}/RecycleBin/Packages (spec: artifacts/7.2/feed.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'feed_id' => ['type' => 'string', 'required' => true, 'description' => 'Name or Id of the feed.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'protocol_type' => ['type' => 'string', 'required' => false, 'description' => 'Type of package (e.g. NuGet, npm, ...).'], 'package_name_query' => ['type' => 'string', 'required' => false, 'description' => 'Filter to packages matching this name.'], 'include_urls' => ['type' => 'boolean', 'required' => false, 'description' => 'True to return REST Urls with the response. Default is True.'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'Get the top N packages.'], 'skip' => ['type' => 'number', 'required' => false, 'description' => 'Skip the first N packages.'], 'include_all_versions' => ['type' => 'boolean', 'required' => false, 'description' => 'True to return all versions of the package in the response. Default is false (latest version only).'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'feeds.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/packaging/Feeds/{feedId}/RecycleBin/Packages';
    protected const PATH_PARAMS = ['organization' => 'organization', 'feedId' => 'feed_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['protocolType' => 'protocol_type', 'packageNameQuery' => 'package_name_query', 'includeUrls' => 'include_urls', '$top' => 'top', '$skip' => 'skip', 'includeAllVersions' => 'include_all_versions', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
