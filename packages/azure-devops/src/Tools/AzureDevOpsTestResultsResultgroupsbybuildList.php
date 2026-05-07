<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * GET /{organization}/{project}/_apis/testresults/resultgroupsbybuild.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/resultgroupsbybuild.
 */
class AzureDevOpsTestResultsResultgroupsbybuildList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_results_resultgroupsbybuild_list';
    protected const DESCRIPTION = 'GET /{organization}/{project}/_apis/testresults/resultgroupsbybuild

Official Azure DevOps REST API 7.2 endpoint: GET https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/resultgroupsbybuild (spec: testResults/7.2/testResults.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'build_id' => ['type' => 'number', 'required' => false, 'description' => 'query parameter `buildId`.'], 'publish_context' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `publishContext`.'], 'fields' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `fields`.'], 'continuation_token' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `continuationToken`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vstmr.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testresults/resultgroupsbybuild';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['buildId' => 'build_id', 'publishContext' => 'publish_context', 'fields' => 'fields', 'continuationToken' => 'continuation_token', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
