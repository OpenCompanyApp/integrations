<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get information about a package and all its versions within the recycle bin. The project parameter must be supplied if the feed was created in a project. If the feed is not associated with any project, omit the project parameter from the request..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://feeds.dev.azure.com/{organization}/{project}/_apis/packaging/Feeds/{feedId}/RecycleBin/Packages/{packageId}.
 */
class AzureDevOpsArtifactsRecycleBinGetRecycleBinPackage extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_artifacts_recycle_bin_get_recycle_bin_package';
    protected const DESCRIPTION = 'Get information about a package and all its versions within the recycle bin. The project parameter must be supplied if the feed was created in a project. If the feed is not associated with any project, omit the project parameter from the request.

Official Azure DevOps REST API 7.2 endpoint: GET https://feeds.dev.azure.com/{organization}/{project}/_apis/packaging/Feeds/{feedId}/RecycleBin/Packages/{packageId} (spec: artifacts/7.2/feed.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'feed_id' => ['type' => 'string', 'required' => true, 'description' => 'Name or Id of the feed.'], 'package_id' => ['type' => 'string', 'required' => true, 'description' => 'The package Id (GUID Id, not the package name).'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'include_urls' => ['type' => 'boolean', 'required' => false, 'description' => 'True to return REST Urls with the response. Default is True.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'feeds.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/packaging/Feeds/{feedId}/RecycleBin/Packages/{packageId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'feedId' => 'feed_id', 'packageId' => 'package_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['includeUrls' => 'include_urls', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
