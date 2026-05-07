<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * GET /{organization}/{project}/_apis/testresults/runs.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/runs.
 */
class AzureDevOpsTestResultsRunsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_results_runs_list';
    protected const DESCRIPTION = 'GET /{organization}/{project}/_apis/testresults/runs

Official Azure DevOps REST API 7.2 endpoint: GET https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/runs (spec: testResults/7.2/testResults.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'build_uri' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `buildUri`.'], 'owner' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `owner`.'], 'tmi_run_id' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `tmiRunId`.'], 'plan_id' => ['type' => 'number', 'required' => false, 'description' => 'query parameter `planId`.'], 'include_run_details' => ['type' => 'boolean', 'required' => false, 'description' => 'query parameter `includeRunDetails`.'], 'automated' => ['type' => 'boolean', 'required' => false, 'description' => 'query parameter `automated`.'], 'skip' => ['type' => 'number', 'required' => false, 'description' => 'query parameter `$skip`.'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'query parameter `$top`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vstmr.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testresults/runs';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['buildUri' => 'build_uri', 'owner' => 'owner', 'tmiRunId' => 'tmi_run_id', 'planId' => 'plan_id', 'includeRunDetails' => 'include_run_details', 'automated' => 'automated', '$skip' => 'skip', '$top' => 'top', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
