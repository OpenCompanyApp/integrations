<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get the upstreaming behavior of a package within the context of a feed.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://pkgs.dev.azure.com/{organization}/{project}/_apis/packaging/feeds/{feed}/maven/groups/{groupId}/artifacts/{artifactId}/upstreaming.
 */
class AzureDevOpsArtifactsPackageTypesMavenGetUpstreamingBehavior extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_artifacts_package_types_maven_get_upstreaming_behavior';
    protected const DESCRIPTION = 'Get the upstreaming behavior of a package within the context of a feed

Official Azure DevOps REST API 7.2 endpoint: GET https://pkgs.dev.azure.com/{organization}/{project}/_apis/packaging/feeds/{feed}/maven/groups/{groupId}/artifacts/{artifactId}/upstreaming (spec: artifactsPackageTypes/7.2/maven.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'feed' => ['type' => 'string', 'required' => true, 'description' => 'The name or id of the feed'], 'group_id' => ['type' => 'string', 'required' => true, 'description' => 'The group id of the package'], 'artifact_id' => ['type' => 'string', 'required' => true, 'description' => 'The artifact id of the package'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'pkgs.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/packaging/feeds/{feed}/maven/groups/{groupId}/artifacts/{artifactId}/upstreaming';
    protected const PATH_PARAMS = ['organization' => 'organization', 'feed' => 'feed', 'groupId' => 'group_id', 'artifactId' => 'artifact_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
