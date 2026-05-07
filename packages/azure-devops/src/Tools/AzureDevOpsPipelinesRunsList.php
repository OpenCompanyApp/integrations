<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets top 10000 runs for a particular pipeline..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/pipelines/{pipelineId}/runs.
 */
class AzureDevOpsPipelinesRunsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_pipelines_runs_list';
    protected const DESCRIPTION = 'Gets top 10000 runs for a particular pipeline.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/pipelines/{pipelineId}/runs (spec: pipelines/7.2/pipelines.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'pipeline_id' => ['type' => 'number', 'required' => true, 'description' => 'The pipeline id'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/pipelines/{pipelineId}/runs';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'pipelineId' => 'pipeline_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
