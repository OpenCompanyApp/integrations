<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Create or update one or more access control lists. All data that currently exists for the ACLs supplied will be overwritten..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/_apis/accesscontrollists/{securityNamespaceId}.
 */
class AzureDevOpsSecurityAccessControlListsSetAccessControlLists extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_security_access_control_lists_set_access_control_lists';
    protected const DESCRIPTION = 'Create or update one or more access control lists. All data that currently exists for the ACLs supplied will be overwritten.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/_apis/accesscontrollists/{securityNamespaceId} (spec: security/7.2/security.json).';
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'A list of ACLs to create or update.'], 'security_namespace_id' => ['type' => 'string', 'required' => true, 'description' => 'Security namespace identifier.'], 'organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/accesscontrollists/{securityNamespaceId}';
    protected const PATH_PARAMS = ['securityNamespaceId' => 'security_namespace_id', 'organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
