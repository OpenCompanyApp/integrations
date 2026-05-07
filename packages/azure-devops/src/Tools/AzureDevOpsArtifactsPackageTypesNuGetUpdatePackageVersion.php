<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Set mutable state on a package version. The project parameter must be supplied if the feed was created in a project. If the feed is not associated with any project, omit the project parameter from the request..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://pkgs.dev.azure.com/{organization}/{project}/_apis/packaging/feeds/{feedId}/nuget/packages/{packageName}/versions/{packageVersion}.
 */
class AzureDevOpsArtifactsPackageTypesNuGetUpdatePackageVersion extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_artifacts_package_types_nu_get_update_package_version';
    protected const DESCRIPTION = 'Set mutable state on a package version. The project parameter must be supplied if the feed was created in a project. If the feed is not associated with any project, omit the project parameter from the request.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://pkgs.dev.azure.com/{organization}/{project}/_apis/packaging/feeds/{feedId}/nuget/packages/{packageName}/versions/{packageVersion} (spec: artifactsPackageTypes/7.2/nuGet.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'New state to apply to the referenced package.'], 'feed_id' => ['type' => 'string', 'required' => true, 'description' => 'Name or ID of the feed.'], 'package_name' => ['type' => 'string', 'required' => true, 'description' => 'Name of the package to update.'], 'package_version' => ['type' => 'string', 'required' => true, 'description' => 'Version of the package to update.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'pkgs.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/packaging/feeds/{feedId}/nuget/packages/{packageName}/versions/{packageVersion}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'feedId' => 'feed_id', 'packageName' => 'package_name', 'packageVersion' => 'package_version', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
