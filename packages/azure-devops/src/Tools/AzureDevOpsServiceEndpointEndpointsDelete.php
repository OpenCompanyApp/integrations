<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Delete a service endpoint.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://dev.azure.com/{organization}/_apis/serviceendpoint/endpoints/{endpointId}.
 */
class AzureDevOpsServiceEndpointEndpointsDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_service_endpoint_endpoints_delete';
    protected const DESCRIPTION = 'Delete a service endpoint

Official Azure DevOps REST API 7.2 endpoint: DELETE https://dev.azure.com/{organization}/_apis/serviceendpoint/endpoints/{endpointId} (spec: serviceEndpoint/7.2/serviceEndpoint.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'endpoint_id' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint Id of endpoint to delete'], 'project_ids' => ['type' => 'string', 'required' => false, 'description' => 'project Ids from which endpoint needs to be deleted'], 'deep' => ['type' => 'boolean', 'required' => false, 'description' => 'delete the spn created by endpoint'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.4`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/serviceendpoint/endpoints/{endpointId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'endpointId' => 'endpoint_id'];
    protected const QUERY_PARAMS = ['projectIds' => 'project_ids', 'deep' => 'deep', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.4';
}
