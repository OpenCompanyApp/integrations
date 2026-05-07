<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Remove the specified ACEs from the ACL belonging to the specified token..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://dev.azure.com/{organization}/_apis/accesscontrolentries/{securityNamespaceId}.
 */
class AzureDevOpsSecurityAccessControlEntriesRemoveAccessControlEntries extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_security_access_control_entries_remove_access_control_entries';
    protected const DESCRIPTION = 'Remove the specified ACEs from the ACL belonging to the specified token.

Official Azure DevOps REST API 7.2 endpoint: DELETE https://dev.azure.com/{organization}/_apis/accesscontrolentries/{securityNamespaceId} (spec: security/7.2/security.json).';
    protected const PARAMETERS = ['security_namespace_id' => ['type' => 'string', 'required' => true, 'description' => 'Security namespace identifier.'], 'organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'token' => ['type' => 'string', 'required' => false, 'description' => 'The token whose ACL should be modified.'], 'descriptors' => ['type' => 'string', 'required' => false, 'description' => 'String containing a list of identity descriptors separated by \',\' whose entries should be removed.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/accesscontrolentries/{securityNamespaceId}';
    protected const PATH_PARAMS = ['securityNamespaceId' => 'security_namespace_id', 'organization' => 'organization'];
    protected const QUERY_PARAMS = ['token' => 'token', 'descriptors' => 'descriptors', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
