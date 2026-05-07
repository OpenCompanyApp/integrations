<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Delete a package version with an npm scope from the recycle bin. The project parameter must be supplied if the feed was created in a project. If the feed is not associated with any project, omit the project parameter from the request..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://pkgs.dev.azure.com/{organization}/{project}/_apis/packaging/feeds/{feedId}/npm/RecycleBin/packages/@{packageScope}/{unscopedPackageName}/versions/{packageVersion}.
 */
class AzureDevOpsArtifactsPackageTypesNpmDeleteScopedPackageVersionFromRecycleBin extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_artifacts_package_types_npm_delete_scoped_package_version_from_recycle_bin';
    protected const DESCRIPTION = 'Delete a package version with an npm scope from the recycle bin. The project parameter must be supplied if the feed was created in a project. If the feed is not associated with any project, omit the project parameter from the request.

Official Azure DevOps REST API 7.2 endpoint: DELETE https://pkgs.dev.azure.com/{organization}/{project}/_apis/packaging/feeds/{feedId}/npm/RecycleBin/packages/@{packageScope}/{unscopedPackageName}/versions/{packageVersion} (spec: artifactsPackageTypes/7.2/npm.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'feed_id' => ['type' => 'string', 'required' => true, 'description' => 'Name or ID of the feed.'], 'package_scope' => ['type' => 'string', 'required' => true, 'description' => 'Scope of the package (the \'scope\' part of @scope/name).'], 'unscoped_package_name' => ['type' => 'string', 'required' => true, 'description' => 'Name of the package (the \'name\' part of @scope/name).'], 'package_version' => ['type' => 'string', 'required' => true, 'description' => 'Version of the package.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'pkgs.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/packaging/feeds/{feedId}/npm/RecycleBin/packages/@{packageScope}/{unscopedPackageName}/versions/{packageVersion}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'feedId' => 'feed_id', 'packageScope' => 'package_scope', 'unscopedPackageName' => 'unscoped_package_name', 'packageVersion' => 'package_version', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
