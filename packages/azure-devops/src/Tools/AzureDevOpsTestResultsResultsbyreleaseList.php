<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * GET /{organization}/{project}/_apis/testresults/resultsbyrelease.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/resultsbyrelease.
 */
class AzureDevOpsTestResultsResultsbyreleaseList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_results_resultsbyrelease_list';
    protected const DESCRIPTION = 'GET /{organization}/{project}/_apis/testresults/resultsbyrelease

Official Azure DevOps REST API 7.2 endpoint: GET https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/resultsbyrelease (spec: testResults/7.2/testResults.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'release_id' => ['type' => 'number', 'required' => false, 'description' => 'query parameter `releaseId`.'], 'release_envid' => ['type' => 'number', 'required' => false, 'description' => 'query parameter `releaseEnvid`.'], 'publish_context' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `publishContext`.'], 'outcomes' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `outcomes`.'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'query parameter `$top`.'], 'continuation_token' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `continuationToken`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vstmr.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testresults/resultsbyrelease';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['releaseId' => 'release_id', 'releaseEnvid' => 'release_envid', 'publishContext' => 'publish_context', 'outcomes' => 'outcomes', '$top' => 'top', 'continuationToken' => 'continuation_token', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
