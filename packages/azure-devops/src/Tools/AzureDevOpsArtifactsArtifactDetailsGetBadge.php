<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Generate a SVG badge for the latest version of a package. The generated SVG is typically used as the image in an HTML link which takes users to the feed containing the package to accelerate discovery and consumption. The project parameter must be supplied if the feed was created in a project. If the feed is not associated with any project, omit the project parameter from the request..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://feeds.dev.azure.com/{organization}/{project}/_apis/public/packaging/Feeds/{feedId}/Packages/{packageId}/badge.
 */
class AzureDevOpsArtifactsArtifactDetailsGetBadge extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_artifacts_artifact_details_get_badge';
    protected const DESCRIPTION = 'Generate a SVG badge for the latest version of a package. The generated SVG is typically used as the image in an HTML link which takes users to the feed containing the package to accelerate discovery and consumption. The project parameter must be supplied if the feed was created in a project. If the feed is not associated with any project, omit the project parameter from the request.

Official Azure DevOps REST API 7.2 endpoint: GET https://feeds.dev.azure.com/{organization}/{project}/_apis/public/packaging/Feeds/{feedId}/Packages/{packageId}/badge (spec: artifacts/7.2/feed.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'feed_id' => ['type' => 'string', 'required' => true, 'description' => 'Name or Id of the feed.'], 'package_id' => ['type' => 'string', 'required' => true, 'description' => 'Id of the package (GUID Id, not name).'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'feeds.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/public/packaging/Feeds/{feedId}/Packages/{packageId}/badge';
    protected const PATH_PARAMS = ['organization' => 'organization', 'feedId' => 'feed_id', 'packageId' => 'package_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
