<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Permanently delete a package from a feed's recycle bin. The project parameter must be supplied if the feed was created in a project. If the feed is not associated with any project, omit the project parameter from the request..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://pkgs.dev.azure.com/{organization}/{project}/_apis/packaging/feeds/{feed}/maven/RecycleBin/groups/{groupId}/artifacts/{artifactId}/versions/{version}.
 */
class AzureDevOpsArtifactsPackageTypesMavenDeletePackageVersionFromRecycleBin extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_artifacts_package_types_maven_delete_package_version_from_recycle_bin';
    protected const DESCRIPTION = 'Permanently delete a package from a feed\'s recycle bin. The project parameter must be supplied if the feed was created in a project. If the feed is not associated with any project, omit the project parameter from the request.

Official Azure DevOps REST API 7.2 endpoint: DELETE https://pkgs.dev.azure.com/{organization}/{project}/_apis/packaging/feeds/{feed}/maven/RecycleBin/groups/{groupId}/artifacts/{artifactId}/versions/{version} (spec: artifactsPackageTypes/7.2/maven.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'feed' => ['type' => 'string', 'required' => true, 'description' => 'Name or ID of the feed.'], 'group_id' => ['type' => 'string', 'required' => true, 'description' => 'Group ID of the package.'], 'artifact_id' => ['type' => 'string', 'required' => true, 'description' => 'Artifact ID of the package.'], 'version' => ['type' => 'string', 'required' => true, 'description' => 'Version of the package.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'pkgs.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/packaging/feeds/{feed}/maven/RecycleBin/groups/{groupId}/artifacts/{artifactId}/versions/{version}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'feed' => 'feed', 'groupId' => 'group_id', 'artifactId' => 'artifact_id', 'version' => 'version', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
