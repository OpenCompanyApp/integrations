<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get details about a specific package. The project parameter must be supplied if the feed was created in a project. If the feed is not associated with any project, omit the project parameter from the request..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://feeds.dev.azure.com/{organization}/{project}/_apis/packaging/Feeds/{feedId}/packages/{packageId}.
 */
class AzureDevOpsArtifactsArtifactDetailsGetPackage extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_artifacts_artifact_details_get_package';
    protected const DESCRIPTION = 'Get details about a specific package. The project parameter must be supplied if the feed was created in a project. If the feed is not associated with any project, omit the project parameter from the request.

Official Azure DevOps REST API 7.2 endpoint: GET https://feeds.dev.azure.com/{organization}/{project}/_apis/packaging/Feeds/{feedId}/packages/{packageId} (spec: artifacts/7.2/feed.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'feed_id' => ['type' => 'string', 'required' => true, 'description' => 'Name or Id of the feed.'], 'package_id' => ['type' => 'string', 'required' => true, 'description' => 'The package Id (GUID Id, not the package name).'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'include_all_versions' => ['type' => 'boolean', 'required' => false, 'description' => 'True to return all versions of the package in the response. Default is false (latest version only).'], 'include_urls' => ['type' => 'boolean', 'required' => false, 'description' => 'True to return REST Urls with the response. Default is True.'], 'is_listed' => ['type' => 'boolean', 'required' => false, 'description' => 'Only applicable for NuGet packages, setting it for other package types will result in a 404. If false, delisted package versions will be returned. Use this to filter the response when includeAllVersions is set to true. Default is unset (do not return delisted packages).'], 'is_release' => ['type' => 'boolean', 'required' => false, 'description' => 'Only applicable for Nuget packages. Use this to filter the response when includeAllVersions is set to true. Default is True (only return packages without prerelease versioning).'], 'include_deleted' => ['type' => 'boolean', 'required' => false, 'description' => 'Return deleted or unpublished versions of packages in the response. Default is False.'], 'include_description' => ['type' => 'boolean', 'required' => false, 'description' => 'Return the description for every version of each package in the response. Default is False.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'feeds.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/packaging/Feeds/{feedId}/packages/{packageId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'feedId' => 'feed_id', 'packageId' => 'package_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['includeAllVersions' => 'include_all_versions', 'includeUrls' => 'include_urls', 'isListed' => 'is_listed', 'isRelease' => 'is_release', 'includeDeleted' => 'include_deleted', 'includeDescription' => 'include_description', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
