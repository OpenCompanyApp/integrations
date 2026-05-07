<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Converts a definition to YAML, optionally at a specific revision..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/build/definitions/{definitionId}/yaml.
 */
class AzureDevOpsBuildYamlGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_yaml_get';
    protected const DESCRIPTION = 'Converts a definition to YAML, optionally at a specific revision.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/build/definitions/{definitionId}/yaml (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'definition_id' => ['type' => 'number', 'required' => true, 'description' => 'The ID of the definition.'], 'revision' => ['type' => 'number', 'required' => false, 'description' => 'The revision number to retrieve. If this is not specified, the latest version will be returned.'], 'min_metrics_time' => ['type' => 'string', 'required' => false, 'description' => 'If specified, indicates the date from which metrics should be included.'], 'property_filters' => ['type' => 'string', 'required' => false, 'description' => 'A comma-delimited list of properties to include in the results.'], 'include_latest_builds' => ['type' => 'boolean', 'required' => false, 'description' => 'query parameter `includeLatestBuilds`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/build/definitions/{definitionId}/yaml';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'definitionId' => 'definition_id'];
    protected const QUERY_PARAMS = ['revision' => 'revision', 'minMetricsTime' => 'min_metrics_time', 'propertyFilters' => 'property_filters', 'includeLatestBuilds' => 'include_latest_builds', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
