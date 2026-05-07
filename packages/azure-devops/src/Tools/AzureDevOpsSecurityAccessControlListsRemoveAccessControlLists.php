<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Remove access control lists under the specfied security namespace..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://dev.azure.com/{organization}/_apis/accesscontrollists/{securityNamespaceId}.
 */
class AzureDevOpsSecurityAccessControlListsRemoveAccessControlLists extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_security_access_control_lists_remove_access_control_lists';
    protected const DESCRIPTION = 'Remove access control lists under the specfied security namespace.

Official Azure DevOps REST API 7.2 endpoint: DELETE https://dev.azure.com/{organization}/_apis/accesscontrollists/{securityNamespaceId} (spec: security/7.2/security.json).';
    protected const PARAMETERS = ['security_namespace_id' => ['type' => 'string', 'required' => true, 'description' => 'Security namespace identifier.'], 'organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'tokens' => ['type' => 'string', 'required' => false, 'description' => 'One or more comma-separated security tokens'], 'recurse' => ['type' => 'boolean', 'required' => false, 'description' => 'If true and this is a hierarchical namespace, also remove child ACLs of the specified tokens.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/accesscontrollists/{securityNamespaceId}';
    protected const PATH_PARAMS = ['securityNamespaceId' => 'security_namespace_id', 'organization' => 'organization'];
    protected const QUERY_PARAMS = ['tokens' => 'tokens', 'recurse' => 'recurse', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
