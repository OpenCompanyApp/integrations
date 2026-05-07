<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get all the available groups details and for these groups get failed and aborted results..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/resultsgroupdetails.
 */
class AzureDevOpsTestResultsResultsgroupDetailsTestResultsGroupDetails extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_results_resultsgroup_details_test_results_group_details';
    protected const DESCRIPTION = 'Get all the available groups details and for these groups get failed and aborted results.

Official Azure DevOps REST API 7.2 endpoint: GET https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/resultsgroupdetails (spec: testResults/7.2/testResults.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'pipeline_id' => ['type' => 'number', 'required' => false, 'description' => 'Pipeline Id. This is same as build Id.'], 'stage_name' => ['type' => 'string', 'required' => false, 'description' => 'Name of the stage. Maximum supported length for name is 256 character.'], 'phase_name' => ['type' => 'string', 'required' => false, 'description' => 'Name of the phase. Maximum supported length for name is 256 character.'], 'job_name' => ['type' => 'string', 'required' => false, 'description' => 'Matrixing in YAML generates copies of a job with different inputs in matrix. JobName is the name of those input. Maximum supported length for name is 256 character.'], 'should_include_failed_and_aborted_results' => ['type' => 'boolean', 'required' => false, 'description' => 'If true, it will return Ids of failed and aborted results for each test group'], 'query_group_summary_for_in_progress' => ['type' => 'boolean', 'required' => false, 'description' => 'If true, it will calculate summary for InProgress runs as well.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vstmr.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testresults/resultsgroupdetails';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['pipelineId' => 'pipeline_id', 'stageName' => 'stage_name', 'phaseName' => 'phase_name', 'jobName' => 'job_name', 'shouldIncludeFailedAndAbortedResults' => 'should_include_failed_and_aborted_results', 'queryGroupSummaryForInProgress' => 'query_group_summary_for_in_progress', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
