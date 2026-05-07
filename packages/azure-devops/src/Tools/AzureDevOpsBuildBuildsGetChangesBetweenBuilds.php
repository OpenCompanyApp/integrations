<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets the changes made to the repository between two given builds..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/build/changes.
 */
class AzureDevOpsBuildBuildsGetChangesBetweenBuilds extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_builds_get_changes_between_builds';
    protected const DESCRIPTION = 'Gets the changes made to the repository between two given builds.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/build/changes (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'from_build_id' => ['type' => 'number', 'required' => false, 'description' => 'The ID of the first build.'], 'to_build_id' => ['type' => 'number', 'required' => false, 'description' => 'The ID of the last build.'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'The maximum number of changes to return.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/build/changes';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['fromBuildId' => 'from_build_id', 'toBuildId' => 'to_build_id', '$top' => 'top', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
