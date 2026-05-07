<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a list of pipelines..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/pipelines.
 */
class AzureDevOpsPipelinesPipelinesList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_pipelines_pipelines_list';
    protected const DESCRIPTION = 'Get a list of pipelines.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/pipelines (spec: pipelines/7.2/pipelines.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'order_by' => ['type' => 'string', 'required' => false, 'description' => 'A sort expression. Defaults to "name asc"'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'The maximum number of pipelines to return'], 'continuation_token' => ['type' => 'string', 'required' => false, 'description' => 'A continuation token from a previous request, to retrieve the next page of results'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/pipelines';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['orderBy' => 'order_by', '$top' => 'top', 'continuationToken' => 'continuation_token', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
