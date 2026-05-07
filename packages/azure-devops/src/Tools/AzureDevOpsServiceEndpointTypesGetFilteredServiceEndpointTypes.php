<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get service endpoint types with passed types filter..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/_apis/serviceendpoint/types.
 */
class AzureDevOpsServiceEndpointTypesGetFilteredServiceEndpointTypes extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_service_endpoint_types_get_filtered_service_endpoint_types';
    protected const DESCRIPTION = 'Get service endpoint types with passed types filter.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/_apis/serviceendpoint/types (spec: serviceEndpoint/7.2/serviceEndpoint.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Filter to limit returned types'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/serviceendpoint/types';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
