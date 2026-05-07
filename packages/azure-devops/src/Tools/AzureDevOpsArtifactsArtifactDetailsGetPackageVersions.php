<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a list of package versions, optionally filtering by state. The project parameter must be supplied if the feed was created in a project. If the feed is not associated with any project, omit the project parameter from the request..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://feeds.dev.azure.com/{organization}/{project}/_apis/packaging/Feeds/{feedId}/Packages/{packageId}/versions.
 */
class AzureDevOpsArtifactsArtifactDetailsGetPackageVersions extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_artifacts_artifact_details_get_package_versions';
    protected const DESCRIPTION = 'Get a list of package versions, optionally filtering by state. The project parameter must be supplied if the feed was created in a project. If the feed is not associated with any project, omit the project parameter from the request.

Official Azure DevOps REST API 7.2 endpoint: GET https://feeds.dev.azure.com/{organization}/{project}/_apis/packaging/Feeds/{feedId}/Packages/{packageId}/versions (spec: artifacts/7.2/feed.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'feed_id' => ['type' => 'string', 'required' => true, 'description' => 'Name or Id of the feed.'], 'package_id' => ['type' => 'string', 'required' => true, 'description' => 'Id of the package (GUID Id, not name).'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'include_urls' => ['type' => 'boolean', 'required' => false, 'description' => 'True to include urls for each version. Default is true.'], 'is_listed' => ['type' => 'boolean', 'required' => false, 'description' => 'Only applicable for NuGet packages. If false, delisted package versions will be returned.'], 'is_deleted' => ['type' => 'boolean', 'required' => false, 'description' => 'If set specifies whether to return only deleted or non-deleted versions of packages in the response. Default is unset (return all versions).'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'feeds.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/packaging/Feeds/{feedId}/Packages/{packageId}/versions';
    protected const PATH_PARAMS = ['organization' => 'organization', 'feedId' => 'feed_id', 'packageId' => 'package_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['includeUrls' => 'include_urls', 'isListed' => 'is_listed', 'isDeleted' => 'is_deleted', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
