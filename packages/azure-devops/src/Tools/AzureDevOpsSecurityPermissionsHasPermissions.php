<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Evaluates whether the caller has the specified permissions on the specified set of security tokens..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/permissions/{securityNamespaceId}/{permissions}.
 */
class AzureDevOpsSecurityPermissionsHasPermissions extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_security_permissions_has_permissions';
    protected const DESCRIPTION = 'Evaluates whether the caller has the specified permissions on the specified set of security tokens.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/permissions/{securityNamespaceId}/{permissions} (spec: security/7.2/security.json).';
    protected const PARAMETERS = ['security_namespace_id' => ['type' => 'string', 'required' => true, 'description' => 'Security namespace identifier.'], 'organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'permissions' => ['type' => 'number', 'required' => true, 'description' => 'Permissions to evaluate.'], 'tokens' => ['type' => 'string', 'required' => false, 'description' => 'One or more security tokens to evaluate.'], 'always_allow_administrators' => ['type' => 'boolean', 'required' => false, 'description' => 'If true and if the caller is an administrator, always return true.'], 'delimiter' => ['type' => 'string', 'required' => false, 'description' => 'Optional security token separator. Defaults to ",".'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/permissions/{securityNamespaceId}/{permissions}';
    protected const PATH_PARAMS = ['securityNamespaceId' => 'security_namespace_id', 'organization' => 'organization', 'permissions' => 'permissions'];
    protected const QUERY_PARAMS = ['tokens' => 'tokens', 'alwaysAllowAdministrators' => 'always_allow_administrators', 'delimiter' => 'delimiter', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
