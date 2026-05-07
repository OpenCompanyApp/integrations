<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get summary of test results..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/metrics.
 */
class AzureDevOpsTestResultsMetricsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_results_metrics_get';
    protected const DESCRIPTION = 'Get summary of test results.

Official Azure DevOps REST API 7.2 endpoint: GET https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/metrics (spec: testResults/7.2/testResults.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'pipeline_id' => ['type' => 'number', 'required' => false, 'description' => 'Pipeline Id. This is same as build Id.'], 'stage_name' => ['type' => 'string', 'required' => false, 'description' => 'Name of the stage. Maximum supported length for name is 256 character.'], 'phase_name' => ['type' => 'string', 'required' => false, 'description' => 'Name of the phase. Maximum supported length for name is 256 character.'], 'job_name' => ['type' => 'string', 'required' => false, 'description' => 'Matrixing in YAML generates copies of a job with different inputs in matrix. JobName is the name of those input. Maximum supported length for name is 256 character.'], 'metric_names' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `metricNames`.'], 'group_by_node' => ['type' => 'boolean', 'required' => false, 'description' => 'Group summary for each node of the pipleine heirarchy'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vstmr.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testresults/metrics';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['pipelineId' => 'pipeline_id', 'stageName' => 'stage_name', 'phaseName' => 'phase_name', 'jobName' => 'job_name', 'metricNames' => 'metric_names', 'groupByNode' => 'group_by_node', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
