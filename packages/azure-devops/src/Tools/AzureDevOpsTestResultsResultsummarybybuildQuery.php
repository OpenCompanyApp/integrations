<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * GET /{organization}/{project}/_apis/testresults/resultsummarybybuild.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/resultsummarybybuild.
 */
class AzureDevOpsTestResultsResultsummarybybuildQuery extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_results_resultsummarybybuild_query';
    protected const DESCRIPTION = 'GET /{organization}/{project}/_apis/testresults/resultsummarybybuild

Official Azure DevOps REST API 7.2 endpoint: GET https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/resultsummarybybuild (spec: testResults/7.2/testResults.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'build_id' => ['type' => 'number', 'required' => false, 'description' => 'query parameter `buildId`.'], 'publish_context' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `publishContext`.'], 'include_failure_details' => ['type' => 'boolean', 'required' => false, 'description' => 'query parameter `includeFailureDetails`.'], 'build_to_compare_branch_name' => ['type' => 'string', 'required' => false, 'description' => 'Branch name.'], 'build_to_compare_build_system' => ['type' => 'string', 'required' => false, 'description' => 'Build system.'], 'build_to_compare_definition_id' => ['type' => 'number', 'required' => false, 'description' => 'Build Definition ID.'], 'build_to_compare_id' => ['type' => 'number', 'required' => false, 'description' => 'Build ID.'], 'build_to_compare_number' => ['type' => 'string', 'required' => false, 'description' => 'Build Number.'], 'build_to_compare_repository_id' => ['type' => 'string', 'required' => false, 'description' => 'Repository ID.'], 'build_to_compare_uri' => ['type' => 'string', 'required' => false, 'description' => 'Build URI.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vstmr.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testresults/resultsummarybybuild';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['buildId' => 'build_id', 'publishContext' => 'publish_context', 'includeFailureDetails' => 'include_failure_details', 'buildToCompare.branchName' => 'build_to_compare_branch_name', 'buildToCompare.buildSystem' => 'build_to_compare_build_system', 'buildToCompare.definitionId' => 'build_to_compare_definition_id', 'buildToCompare.id' => 'build_to_compare_id', 'buildToCompare.number' => 'build_to_compare_number', 'buildToCompare.repositoryId' => 'build_to_compare_repository_id', 'buildToCompare.uri' => 'build_to_compare_uri', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
