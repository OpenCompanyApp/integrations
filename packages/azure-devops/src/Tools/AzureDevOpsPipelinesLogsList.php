<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a list of logs from a pipeline run..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/pipelines/{pipelineId}/runs/{runId}/logs.
 */
class AzureDevOpsPipelinesLogsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_pipelines_logs_list';
    protected const DESCRIPTION = 'Get a list of logs from a pipeline run.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/pipelines/{pipelineId}/runs/{runId}/logs (spec: pipelines/7.2/pipelines.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'pipeline_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the pipeline.'], 'run_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the run of that pipeline.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Expand options. Default is None.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/pipelines/{pipelineId}/runs/{runId}/logs';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'pipelineId' => 'pipeline_id', 'runId' => 'run_id'];
    protected const QUERY_PARAMS = ['$expand' => 'expand', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
