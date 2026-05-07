<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Set the upstreaming behavior of a package within the context of a feed The package does not need to necessarily exist in the feed prior to setting the behavior. This assists with packages that are not yet ingested from an upstream, yet the feed owner wants to apply a specific behavior on the first ingestion..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://pkgs.dev.azure.com/{organization}/{project}/_apis/packaging/feeds/{feed}/maven/groups/{groupId}/artifacts/{artifactId}/upstreaming.
 */
class AzureDevOpsArtifactsPackageTypesMavenSetUpstreamingBehavior extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_artifacts_package_types_maven_set_upstreaming_behavior';
    protected const DESCRIPTION = 'Set the upstreaming behavior of a package within the context of a feed The package does not need to necessarily exist in the feed prior to setting the behavior. This assists with packages that are not yet ingested from an upstream, yet the feed owner wants to apply a specific behavior on the first ingestion.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://pkgs.dev.azure.com/{organization}/{project}/_apis/packaging/feeds/{feed}/maven/groups/{groupId}/artifacts/{artifactId}/upstreaming (spec: artifactsPackageTypes/7.2/maven.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'feed' => ['type' => 'string', 'required' => true, 'description' => 'The name or id of the feed'], 'group_id' => ['type' => 'string', 'required' => true, 'description' => 'path parameter `groupId`.'], 'artifact_id' => ['type' => 'string', 'required' => true, 'description' => 'path parameter `artifactId`.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The behavior to apply to the package within the scope of the feed'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'pkgs.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/packaging/feeds/{feed}/maven/groups/{groupId}/artifacts/{artifactId}/upstreaming';
    protected const PATH_PARAMS = ['organization' => 'organization', 'feed' => 'feed', 'groupId' => 'group_id', 'artifactId' => 'artifact_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
