<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Update the service endpoints..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PUT https://dev.azure.com/{organization}/_apis/serviceendpoint/endpoints.
 */
class AzureDevOpsServiceEndpointEndpointsUpdateServiceEndpoints extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_service_endpoint_endpoints_update_service_endpoints';
    protected const DESCRIPTION = 'Update the service endpoints.

Official Azure DevOps REST API 7.2 endpoint: PUT https://dev.azure.com/{organization}/_apis/serviceendpoint/endpoints (spec: serviceEndpoint/7.2/serviceEndpoint.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Names of the service endpoints to update.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.4`.']];
    protected const METHOD = 'PUT';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/serviceendpoint/endpoints';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.4';
}
