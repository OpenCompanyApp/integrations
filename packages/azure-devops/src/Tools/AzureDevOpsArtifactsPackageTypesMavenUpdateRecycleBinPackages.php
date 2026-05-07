<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Delete or restore several package versions from the recycle bin. The project parameter must be supplied if the feed was created in a project. If the feed is not associated with any project, omit the project parameter from the request..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://pkgs.dev.azure.com/{organization}/{project}/_apis/packaging/feeds/{feed}/maven/RecycleBin/packagesBatch.
 */
class AzureDevOpsArtifactsPackageTypesMavenUpdateRecycleBinPackages extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_artifacts_package_types_maven_update_recycle_bin_packages';
    protected const DESCRIPTION = 'Delete or restore several package versions from the recycle bin. The project parameter must be supplied if the feed was created in a project. If the feed is not associated with any project, omit the project parameter from the request.

Official Azure DevOps REST API 7.2 endpoint: POST https://pkgs.dev.azure.com/{organization}/{project}/_apis/packaging/feeds/{feed}/maven/RecycleBin/packagesBatch (spec: artifactsPackageTypes/7.2/maven.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Information about the packages to update, the operation to perform, and its associated data.'], 'feed' => ['type' => 'string', 'required' => true, 'description' => 'path parameter `feed`.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'pkgs.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/packaging/feeds/{feed}/maven/RecycleBin/packagesBatch';
    protected const PATH_PARAMS = ['organization' => 'organization', 'feed' => 'feed', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
