<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Restore a package version from the recycle bin to its associated feed. The project parameter must be supplied if the feed was created in a project. If the feed is not associated with any project, omit the project parameter from the request..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://pkgs.dev.azure.com/{organization}/{project}/_apis/packaging/feeds/{feedId}/cargo/RecycleBin/packages/{packageName}/versions/{packageVersion}.
 */
class AzureDevOpsArtifactsPackageTypesCargoRestorePackageVersionFromRecycleBin extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_artifacts_package_types_cargo_restore_package_version_from_recycle_bin';
    protected const DESCRIPTION = 'Restore a package version from the recycle bin to its associated feed. The project parameter must be supplied if the feed was created in a project. If the feed is not associated with any project, omit the project parameter from the request.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://pkgs.dev.azure.com/{organization}/{project}/_apis/packaging/feeds/{feedId}/cargo/RecycleBin/packages/{packageName}/versions/{packageVersion} (spec: artifactsPackageTypes/7.2/cargoApi-AzureArtifacts.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Set the \'Deleted\' state to \'false\' to restore the package to its feed.'], 'feed_id' => ['type' => 'string', 'required' => true, 'description' => 'Name or ID of the feed.'], 'package_name' => ['type' => 'string', 'required' => true, 'description' => 'Name of the package.'], 'package_version' => ['type' => 'string', 'required' => true, 'description' => 'Version of the package.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'pkgs.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/packaging/feeds/{feedId}/cargo/RecycleBin/packages/{packageName}/versions/{packageVersion}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'feedId' => 'feed_id', 'packageName' => 'package_name', 'packageVersion' => 'package_version', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
