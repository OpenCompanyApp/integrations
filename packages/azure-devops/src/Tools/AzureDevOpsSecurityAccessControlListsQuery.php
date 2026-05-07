<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Return a list of access control lists for the specified security namespace and token. All ACLs in the security namespace will be retrieved if no optional parameters are provided. Note that the response will include all project IDs, including projects the current user does not have access to..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/accesscontrollists/{securityNamespaceId}.
 */
class AzureDevOpsSecurityAccessControlListsQuery extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_security_access_control_lists_query';
    protected const DESCRIPTION = 'Return a list of access control lists for the specified security namespace and token. All ACLs in the security namespace will be retrieved if no optional parameters are provided. Note that the response will include all project IDs, including projects the current user does not have access to.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/accesscontrollists/{securityNamespaceId} (spec: security/7.2/security.json).';
    protected const PARAMETERS = ['security_namespace_id' => ['type' => 'string', 'required' => true, 'description' => 'Security namespace identifier.'], 'organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'token' => ['type' => 'string', 'required' => false, 'description' => 'Security token'], 'descriptors' => ['type' => 'string', 'required' => false, 'description' => 'An optional filter string containing a list of identity descriptors separated by \',\' whose ACEs should be retrieved. If this is left null, entire ACLs will be returned.'], 'include_extended_info' => ['type' => 'boolean', 'required' => false, 'description' => 'If true, populate the extended information properties for the access control entries contained in the returned lists.'], 'recurse' => ['type' => 'boolean', 'required' => false, 'description' => 'If true and this is a hierarchical namespace, return child ACLs of the specified token.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/accesscontrollists/{securityNamespaceId}';
    protected const PATH_PARAMS = ['securityNamespaceId' => 'security_namespace_id', 'organization' => 'organization'];
    protected const QUERY_PARAMS = ['token' => 'token', 'descriptors' => 'descriptors', 'includeExtendedInfo' => 'include_extended_info', 'recurse' => 'recurse', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
