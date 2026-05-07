<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Fulfills Maven package file download requests by either returning the URL of the requested package file or, in the case of Azure DevOps Server (OnPrem), returning the content as a stream. The project parameter must be supplied if the feed was created in a project. If the feed is not associated with any project, omit the project parameter from the request..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://pkgs.dev.azure.com/{organization}/{project}/_apis/packaging/feeds/{feedId}/maven/{groupId}/{artifactId}/{version}/{fileName}/content.
 */
class AzureDevOpsArtifactsPackageTypesMavenDownloadPackage extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_artifacts_package_types_maven_download_package';
    protected const DESCRIPTION = 'Fulfills Maven package file download requests by either returning the URL of the requested package file or, in the case of Azure DevOps Server (OnPrem), returning the content as a stream. The project parameter must be supplied if the feed was created in a project. If the feed is not associated with any project, omit the project parameter from the request.

Official Azure DevOps REST API 7.2 endpoint: GET https://pkgs.dev.azure.com/{organization}/{project}/_apis/packaging/feeds/{feedId}/maven/{groupId}/{artifactId}/{version}/{fileName}/content (spec: artifactsPackageTypes/7.2/maven.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'feed_id' => ['type' => 'string', 'required' => true, 'description' => 'Name or ID of the feed.'], 'group_id' => ['type' => 'string', 'required' => true, 'description' => 'GroupId of the maven package'], 'artifact_id' => ['type' => 'string', 'required' => true, 'description' => 'ArtifactId of the maven package'], 'version' => ['type' => 'string', 'required' => true, 'description' => 'Version of the package'], 'file_name' => ['type' => 'string', 'required' => true, 'description' => 'File name to download'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'pkgs.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/packaging/feeds/{feedId}/maven/{groupId}/{artifactId}/{version}/{fileName}/content';
    protected const PATH_PARAMS = ['organization' => 'organization', 'feedId' => 'feed_id', 'groupId' => 'group_id', 'artifactId' => 'artifact_id', 'version' => 'version', 'fileName' => 'file_name', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
