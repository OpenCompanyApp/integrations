<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Disables a service principal. The service principal will still be visible, but membership checks for the service principal will return false..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://vssps.dev.azure.com/{organization}/_apis/graph/serviceprincipals/{servicePrincipalDescriptor}.
 */
class AzureDevOpsGraphServicePrincipalsDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_graph_service_principals_delete';
    protected const DESCRIPTION = 'Disables a service principal. The service principal will still be visible, but membership checks for the service principal will return false.

Official Azure DevOps REST API 7.2 endpoint: DELETE https://vssps.dev.azure.com/{organization}/_apis/graph/serviceprincipals/{servicePrincipalDescriptor} (spec: graph/7.2/graph.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'service_principal_descriptor' => ['type' => 'string', 'required' => true, 'description' => 'The descriptor of the service principal to delete.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'vssps.dev.azure.com';
    protected const PATH = '/{organization}/_apis/graph/serviceprincipals/{servicePrincipalDescriptor}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'servicePrincipalDescriptor' => 'service_principal_descriptor'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
