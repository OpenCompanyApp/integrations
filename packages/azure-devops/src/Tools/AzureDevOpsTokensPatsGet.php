<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets a single personal access token (PAT)..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vssps.dev.azure.com/{organization}/_apis/tokens/pats.
 */
class AzureDevOpsTokensPatsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_tokens_pats_get';
    protected const DESCRIPTION = 'Gets a single personal access token (PAT).

Official Azure DevOps REST API 7.2 endpoint: GET https://vssps.dev.azure.com/{organization}/_apis/tokens/pats (spec: tokens/7.2/tokens.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'authorization_id' => ['type' => 'string', 'required' => false, 'description' => 'The authorizationId identifying a single, unique personal access token (PAT)'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vssps.dev.azure.com';
    protected const PATH = '/{organization}/_apis/tokens/pats';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['authorizationId' => 'authorization_id', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
