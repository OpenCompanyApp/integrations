<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Creates a new personal access token (PAT) for the requesting user..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://vssps.dev.azure.com/{organization}/_apis/tokens/pats.
 */
class AzureDevOpsTokensPatsCreate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_tokens_pats_create';
    protected const DESCRIPTION = 'Creates a new personal access token (PAT) for the requesting user.

Official Azure DevOps REST API 7.2 endpoint: POST https://vssps.dev.azure.com/{organization}/_apis/tokens/pats (spec: tokens/7.2/tokens.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Azure DevOps Swagger schema.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'vssps.dev.azure.com';
    protected const PATH = '/{organization}/_apis/tokens/pats';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
