<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Create a test session.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{project}/{team}/_apis/test/session.
 */
class AzureDevOpsTestSessionCreate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_session_create';
    protected const DESCRIPTION = 'Create a test session

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{project}/{team}/_apis/test/session (spec: test/7.2/test.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Test session details for creation'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'team' => ['type' => 'string', 'required' => true, 'description' => 'Team ID or team name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/{team}/_apis/test/session';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'team' => 'team'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
