<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Share service endpoint across projects.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://dev.azure.com/{organization}/_apis/serviceendpoint/endpoints/{endpointId}.
 */
class AzureDevOpsServiceEndpointEndpointsShareServiceEndpoint extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_service_endpoint_endpoints_share_service_endpoint';
    protected const DESCRIPTION = 'Share service endpoint across projects

Official Azure DevOps REST API 7.2 endpoint: PATCH https://dev.azure.com/{organization}/_apis/serviceendpoint/endpoints/{endpointId} (spec: serviceEndpoint/7.2/serviceEndpoint.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Project reference details of the target project'], 'endpoint_id' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint Id of the endpoint to share'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.4`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/serviceendpoint/endpoints/{endpointId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'endpointId' => 'endpoint_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.4';
}
