<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Removes the specified permissions on a security token for a user or group..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://dev.azure.com/{organization}/_apis/permissions/{securityNamespaceId}/{permissions}.
 */
class AzureDevOpsSecurityPermissionsRemovePermission extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_security_permissions_remove_permission';
    protected const DESCRIPTION = 'Removes the specified permissions on a security token for a user or group.

Official Azure DevOps REST API 7.2 endpoint: DELETE https://dev.azure.com/{organization}/_apis/permissions/{securityNamespaceId}/{permissions} (spec: security/7.2/security.json).';
    protected const PARAMETERS = ['security_namespace_id' => ['type' => 'string', 'required' => true, 'description' => 'Security namespace identifier.'], 'descriptor' => ['type' => 'string', 'required' => false, 'description' => 'Identity descriptor of the user to remove permissions for.'], 'organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'permissions' => ['type' => 'number', 'required' => true, 'description' => 'Permissions to remove.'], 'token' => ['type' => 'string', 'required' => false, 'description' => 'Security token to remove permissions for.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/permissions/{securityNamespaceId}/{permissions}';
    protected const PATH_PARAMS = ['securityNamespaceId' => 'security_namespace_id', 'organization' => 'organization', 'permissions' => 'permissions'];
    protected const QUERY_PARAMS = ['descriptor' => 'descriptor', 'token' => 'token', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
