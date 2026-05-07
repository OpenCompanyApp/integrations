<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get the service endpoints by name..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/serviceendpoint/endpoints.
 */
class AzureDevOpsServiceEndpointEndpointsGetServiceEndpointsByNames extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_service_endpoint_endpoints_get_service_endpoints_by_names';
    protected const DESCRIPTION = 'Get the service endpoints by name.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/serviceendpoint/endpoints (spec: serviceEndpoint/7.2/serviceEndpoint.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'endpoint_names' => ['type' => 'string', 'required' => false, 'description' => 'Names of the service endpoints.'], 'type' => ['type' => 'string', 'required' => false, 'description' => 'Type of the service endpoints.'], 'auth_schemes' => ['type' => 'string', 'required' => false, 'description' => 'Authorization schemes used for service endpoints.'], 'owner' => ['type' => 'string', 'required' => false, 'description' => 'Owner for service endpoints.'], 'include_failed' => ['type' => 'boolean', 'required' => false, 'description' => 'Failed flag for service endpoints.'], 'include_details' => ['type' => 'boolean', 'required' => false, 'description' => 'Flag to include more details for service endpoints. This is for internal use only and the flag will be treated as false for all other requests'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.4`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/serviceendpoint/endpoints';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['endpointNames' => 'endpoint_names', 'type' => 'type', 'authSchemes' => 'auth_schemes', 'owner' => 'owner', 'includeFailed' => 'include_failed', 'includeDetails' => 'include_details', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.4';
}
