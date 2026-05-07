<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets the service endpoints and patch new authorization parameters.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{project}/_apis/serviceendpoint/endpoints.
 */
class AzureDevOpsServiceEndpointEndpointsGetServiceEndpointsWithRefreshedAuthentication extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_service_endpoint_endpoints_get_service_endpoints_with_refreshed_authentication';
    protected const DESCRIPTION = 'Gets the service endpoints and patch new authorization parameters

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{project}/_apis/serviceendpoint/endpoints (spec: serviceEndpoint/7.2/serviceEndpoint.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Scope, Validity of Token requested.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'endpoint_ids' => ['type' => 'string', 'required' => false, 'description' => 'Ids of the service endpoints.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.4`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/serviceendpoint/endpoints';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['endpointIds' => 'endpoint_ids', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.4';
}
