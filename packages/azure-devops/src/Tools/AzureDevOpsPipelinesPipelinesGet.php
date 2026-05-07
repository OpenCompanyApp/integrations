<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets a pipeline, optionally at the specified version.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/pipelines/{pipelineId}.
 */
class AzureDevOpsPipelinesPipelinesGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_pipelines_pipelines_get';
    protected const DESCRIPTION = 'Gets a pipeline, optionally at the specified version

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/pipelines/{pipelineId} (spec: pipelines/7.2/pipelines.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'pipeline_id' => ['type' => 'number', 'required' => true, 'description' => 'The pipeline ID'], 'pipeline_version' => ['type' => 'number', 'required' => false, 'description' => 'The pipeline version'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/pipelines/{pipelineId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'pipelineId' => 'pipeline_id'];
    protected const QUERY_PARAMS = ['pipelineVersion' => 'pipeline_version', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
