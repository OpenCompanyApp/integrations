<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get service endpoint execution records..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/serviceendpoint/{endpointId}/executionhistory.
 */
class AzureDevOpsServiceEndpointExecutionhistoryList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_service_endpoint_executionhistory_list';
    protected const DESCRIPTION = 'Get service endpoint execution records.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/serviceendpoint/{endpointId}/executionhistory (spec: serviceEndpoint/7.2/serviceEndpoint.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'endpoint_id' => ['type' => 'string', 'required' => true, 'description' => 'Id of the service endpoint.'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'Number of service endpoint execution records to get.'], 'continuation_token' => ['type' => 'number', 'required' => false, 'description' => 'A continuation token, returned by a previous call to this method, that can be used to return the next set of records'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/serviceendpoint/{endpointId}/executionhistory';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'endpointId' => 'endpoint_id'];
    protected const QUERY_PARAMS = ['top' => 'top', 'continuationToken' => 'continuation_token', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
