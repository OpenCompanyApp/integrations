<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * GET /{organization}/{project}/_apis/testresults/resultdetailsbyrelease.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/resultdetailsbyrelease.
 */
class AzureDevOpsTestResultsResultdetailsbyreleaseGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_results_resultdetailsbyrelease_get';
    protected const DESCRIPTION = 'GET /{organization}/{project}/_apis/testresults/resultdetailsbyrelease

Official Azure DevOps REST API 7.2 endpoint: GET https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/resultdetailsbyrelease (spec: testResults/7.2/testResults.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'release_id' => ['type' => 'number', 'required' => false, 'description' => 'query parameter `releaseId`.'], 'release_env_id' => ['type' => 'number', 'required' => false, 'description' => 'query parameter `releaseEnvId`.'], 'publish_context' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `publishContext`.'], 'group_by' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `groupBy`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `$orderby`.'], 'should_include_results' => ['type' => 'boolean', 'required' => false, 'description' => 'query parameter `shouldIncludeResults`.'], 'query_run_summary_for_in_progress' => ['type' => 'boolean', 'required' => false, 'description' => 'query parameter `queryRunSummaryForInProgress`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vstmr.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testresults/resultdetailsbyrelease';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['releaseId' => 'release_id', 'releaseEnvId' => 'release_env_id', 'publishContext' => 'publish_context', 'groupBy' => 'group_by', '$filter' => 'filter', '$orderby' => 'orderby', 'shouldIncludeResults' => 'should_include_results', 'queryRunSummaryForInProgress' => 'query_run_summary_for_in_progress', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
