<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a list of test runs..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/test/runs.
 */
class AzureDevOpsTestRunsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_runs_list';
    protected const DESCRIPTION = 'Get a list of test runs.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/test/runs (spec: test/7.2/test.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'build_uri' => ['type' => 'string', 'required' => false, 'description' => 'URI of the build that the runs used.'], 'owner' => ['type' => 'string', 'required' => false, 'description' => 'Team foundation ID of the owner of the runs.'], 'tmi_run_id' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `tmiRunId`.'], 'plan_id' => ['type' => 'number', 'required' => false, 'description' => 'ID of the test plan that the runs are a part of.'], 'include_run_details' => ['type' => 'boolean', 'required' => false, 'description' => 'If true, include all the properties of the runs.'], 'automated' => ['type' => 'boolean', 'required' => false, 'description' => 'If true, only returns automated runs.'], 'skip' => ['type' => 'number', 'required' => false, 'description' => 'Number of test runs to skip.'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'Number of test runs to return.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/test/runs';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['buildUri' => 'build_uri', 'owner' => 'owner', 'tmiRunId' => 'tmi_run_id', 'planId' => 'plan_id', 'includeRunDetails' => 'include_run_details', 'automated' => 'automated', '$skip' => 'skip', '$top' => 'top', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}
