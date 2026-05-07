<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a list of accounts for a specific owner or a specific member. One of the following parameters is required: ownerId, memberId..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://app.vssps.visualstudio.com/_apis/accounts.
 */
class AzureDevOpsAccountAccountsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_account_accounts_list';
    protected const DESCRIPTION = 'Get a list of accounts for a specific owner or a specific member. One of the following parameters is required: ownerId, memberId.

Official Azure DevOps REST API 7.2 endpoint: GET https://app.vssps.visualstudio.com/_apis/accounts (spec: account/7.2/accounts.json).';
    protected const PARAMETERS = ['owner_id' => ['type' => 'string', 'required' => false, 'description' => 'ID for the owner of the accounts.'], 'member_id' => ['type' => 'string', 'required' => false, 'description' => 'ID for a member of the accounts.'], 'properties' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `properties`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'app.vssps.visualstudio.com';
    protected const PATH = '/_apis/accounts';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = ['ownerId' => 'owner_id', 'memberId' => 'member_id', 'properties' => 'properties', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
