<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets the changes associated with a build.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/build/builds/{buildId}/changes.
 */
class AzureDevOpsBuildBuildsGetBuildChanges extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_builds_get_build_changes';
    protected const DESCRIPTION = 'Gets the changes associated with a build

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/build/builds/{buildId}/changes (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'build_id' => ['type' => 'number', 'required' => true, 'description' => 'path parameter `buildId`.'], 'continuation_token' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `continuationToken`.'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'The maximum number of changes to return'], 'include_source_change' => ['type' => 'boolean', 'required' => false, 'description' => 'query parameter `includeSourceChange`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/build/builds/{buildId}/changes';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'buildId' => 'build_id'];
    protected const QUERY_PARAMS = ['continuationToken' => 'continuation_token', '$top' => 'top', 'includeSourceChange' => 'include_source_change', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
