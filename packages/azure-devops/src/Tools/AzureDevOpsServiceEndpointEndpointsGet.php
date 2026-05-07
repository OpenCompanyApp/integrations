<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get the service endpoint details..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/serviceendpoint/endpoints/{endpointId}.
 */
class AzureDevOpsServiceEndpointEndpointsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_service_endpoint_endpoints_get';
    protected const DESCRIPTION = 'Get the service endpoint details.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/serviceendpoint/endpoints/{endpointId} (spec: serviceEndpoint/7.2/serviceEndpoint.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'endpoint_id' => ['type' => 'string', 'required' => true, 'description' => 'Id of the service endpoint.'], 'action_filter' => ['type' => 'string', 'required' => false, 'description' => 'Action filter for the service connection. It specifies the action which can be performed on the service connection.'], 'load_confidential_data' => ['type' => 'boolean', 'required' => false, 'description' => 'Flag to include confidential details of service endpoint. This is for internal use only.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.4`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/serviceendpoint/endpoints/{endpointId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'endpointId' => 'endpoint_id'];
    protected const QUERY_PARAMS = ['actionFilter' => 'action_filter', 'loadConfidentialData' => 'load_confidential_data', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.4';
}
