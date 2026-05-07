<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Creates a new service endpoint.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/_apis/serviceendpoint/endpoints.
 */
class AzureDevOpsServiceEndpointEndpointsCreate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_service_endpoint_endpoints_create';
    protected const DESCRIPTION = 'Creates a new service endpoint

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/_apis/serviceendpoint/endpoints (spec: serviceEndpoint/7.2/serviceEndpoint.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Service endpoint to create'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.4`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/serviceendpoint/endpoints';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.4';
}
