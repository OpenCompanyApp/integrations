<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * List all security namespaces or just the specified namespace..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/securitynamespaces/{securityNamespaceId}.
 */
class AzureDevOpsSecuritySecurityNamespacesQuery extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_security_security_namespaces_query';
    protected const DESCRIPTION = 'List all security namespaces or just the specified namespace.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/securitynamespaces/{securityNamespaceId} (spec: security/7.2/security.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'security_namespace_id' => ['type' => 'string', 'required' => true, 'description' => 'Security namespace identifier.'], 'local_only' => ['type' => 'boolean', 'required' => false, 'description' => 'If true, retrieve only local security namespaces.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/securitynamespaces/{securityNamespaceId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'securityNamespaceId' => 'security_namespace_id'];
    protected const QUERY_PARAMS = ['localOnly' => 'local_only', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
