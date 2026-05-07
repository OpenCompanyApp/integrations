<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets build metrics for a definition..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/build/definitions/{definitionId}/metrics.
 */
class AzureDevOpsBuildMetricsGetDefinitionMetrics extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_metrics_get_definition_metrics';
    protected const DESCRIPTION = 'Gets build metrics for a definition.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/build/definitions/{definitionId}/metrics (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'definition_id' => ['type' => 'number', 'required' => true, 'description' => 'The ID of the definition.'], 'min_metrics_time' => ['type' => 'string', 'required' => false, 'description' => 'The date from which to calculate metrics.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/build/definitions/{definitionId}/metrics';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'definitionId' => 'definition_id'];
    protected const QUERY_PARAMS = ['minMetricsTime' => 'min_metrics_time', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
