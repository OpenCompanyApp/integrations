<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Lists of all the session token details of the personal access tokens (PATs) for a particular user..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vssps.dev.azure.com/{organization}/_apis/tokenadmin/personalaccesstokens/{subjectDescriptor}.
 */
class AzureDevOpsTokenAdminPersonalAccessTokensList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_token_admin_personal_access_tokens_list';
    protected const DESCRIPTION = 'Lists of all the session token details of the personal access tokens (PATs) for a particular user.

Official Azure DevOps REST API 7.2 endpoint: GET https://vssps.dev.azure.com/{organization}/_apis/tokenadmin/personalaccesstokens/{subjectDescriptor} (spec: tokenAdmin/7.2/tokenAdmin.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'subject_descriptor' => ['type' => 'string', 'required' => true, 'description' => 'The descriptor of the target user.'], 'page_size' => ['type' => 'number', 'required' => false, 'description' => 'The maximum number of results to return on each page.'], 'continuation_token' => ['type' => 'string', 'required' => false, 'description' => 'An opaque data blob that allows the next page of data to resume immediately after where the previous page ended. The only reliable way to know if there is more data left is the presence of a continuation token.'], 'is_public' => ['type' => 'boolean', 'required' => false, 'description' => 'Set to false for PAT tokens and true for SSH tokens.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vssps.dev.azure.com';
    protected const PATH = '/{organization}/_apis/tokenadmin/personalaccesstokens/{subjectDescriptor}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'subjectDescriptor' => 'subject_descriptor'];
    protected const QUERY_PARAMS = ['pageSize' => 'page_size', 'continuationToken' => 'continuation_token', 'isPublic' => 'is_public', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
