<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Set the upstreaming behavior of a (scoped) package within the context of a feed The package does not need to necessarily exist in the feed prior to setting the behavior. This assists with packages that are not yet ingested from an upstream, yet the feed owner wants to apply a specific behavior on the first ingestion..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://pkgs.dev.azure.com/{organization}/{project}/_apis/packaging/feeds/{feedId}/npm/packages/{packageName}/upstreaming.
 */
class AzureDevOpsArtifactsPackageTypesNpmSetUpstreamingBehavior extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_artifacts_package_types_npm_set_upstreaming_behavior';
    protected const DESCRIPTION = 'Set the upstreaming behavior of a (scoped) package within the context of a feed The package does not need to necessarily exist in the feed prior to setting the behavior. This assists with packages that are not yet ingested from an upstream, yet the feed owner wants to apply a specific behavior on the first ingestion.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://pkgs.dev.azure.com/{organization}/{project}/_apis/packaging/feeds/{feedId}/npm/packages/{packageName}/upstreaming (spec: artifactsPackageTypes/7.2/npm.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'feed_id' => ['type' => 'string', 'required' => true, 'description' => 'The name or id of the feed'], 'package_name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the package'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The behavior to apply to the scoped package within the scope of the feed'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'pkgs.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/packaging/feeds/{feedId}/npm/packages/{packageName}/upstreaming';
    protected const PATH_PARAMS = ['organization' => 'organization', 'feedId' => 'feed_id', 'packageName' => 'package_name', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
