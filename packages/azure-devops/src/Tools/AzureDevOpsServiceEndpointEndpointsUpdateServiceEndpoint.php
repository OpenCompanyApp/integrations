<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Update the service endpoint.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PUT https://dev.azure.com/{organization}/_apis/serviceendpoint/endpoints/{endpointId}.
 */
class AzureDevOpsServiceEndpointEndpointsUpdateServiceEndpoint extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_service_endpoint_endpoints_update_service_endpoint';
    protected const DESCRIPTION = 'Update the service endpoint

Official Azure DevOps REST API 7.2 endpoint: PUT https://dev.azure.com/{organization}/_apis/serviceendpoint/endpoints/{endpointId} (spec: serviceEndpoint/7.2/serviceEndpoint.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Updated data for the endpoint'], 'endpoint_id' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint Id of the endpoint to update'], 'operation' => ['type' => 'string', 'required' => false, 'description' => 'operation type'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.4`.']];
    protected const METHOD = 'PUT';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/serviceendpoint/endpoints/{endpointId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'endpointId' => 'endpoint_id'];
    protected const QUERY_PARAMS = ['operation' => 'operation', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.4';
}
