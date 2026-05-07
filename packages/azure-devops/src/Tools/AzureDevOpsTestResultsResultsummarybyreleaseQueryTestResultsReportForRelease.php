<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * GET /{organization}/{project}/_apis/testresults/resultsummarybyrelease.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/resultsummarybyrelease.
 */
class AzureDevOpsTestResultsResultsummarybyreleaseQueryTestResultsReportForRelease extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_results_resultsummarybyrelease_query_test_results_report_for_release';
    protected const DESCRIPTION = 'GET /{organization}/{project}/_apis/testresults/resultsummarybyrelease

Official Azure DevOps REST API 7.2 endpoint: GET https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/resultsummarybyrelease (spec: testResults/7.2/testResults.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'release_id' => ['type' => 'number', 'required' => false, 'description' => 'query parameter `releaseId`.'], 'release_env_id' => ['type' => 'number', 'required' => false, 'description' => 'query parameter `releaseEnvId`.'], 'publish_context' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `publishContext`.'], 'include_failure_details' => ['type' => 'boolean', 'required' => false, 'description' => 'query parameter `includeFailureDetails`.'], 'release_to_compare_attempt' => ['type' => 'number', 'required' => false, 'description' => 'Number of Release Attempt.'], 'release_to_compare_creation_date' => ['type' => 'string', 'required' => false, 'description' => 'Release Creation Date(UTC).'], 'release_to_compare_definition_id' => ['type' => 'number', 'required' => false, 'description' => 'Release definition ID.'], 'release_to_compare_environment_creation_date' => ['type' => 'string', 'required' => false, 'description' => 'Environment creation Date(UTC).'], 'release_to_compare_environment_definition_id' => ['type' => 'number', 'required' => false, 'description' => 'Release environment definition ID.'], 'release_to_compare_environment_definition_name' => ['type' => 'string', 'required' => false, 'description' => 'Release environment definition name.'], 'release_to_compare_environment_id' => ['type' => 'number', 'required' => false, 'description' => 'Release environment ID.'], 'release_to_compare_environment_name' => ['type' => 'string', 'required' => false, 'description' => 'Release environment name.'], 'release_to_compare_id' => ['type' => 'number', 'required' => false, 'description' => 'Release ID.'], 'release_to_compare_name' => ['type' => 'string', 'required' => false, 'description' => 'Release name.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vstmr.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testresults/resultsummarybyrelease';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['releaseId' => 'release_id', 'releaseEnvId' => 'release_env_id', 'publishContext' => 'publish_context', 'includeFailureDetails' => 'include_failure_details', 'releaseToCompare.attempt' => 'release_to_compare_attempt', 'releaseToCompare.creationDate' => 'release_to_compare_creation_date', 'releaseToCompare.definitionId' => 'release_to_compare_definition_id', 'releaseToCompare.environmentCreationDate' => 'release_to_compare_environment_creation_date', 'releaseToCompare.environmentDefinitionId' => 'release_to_compare_environment_definition_id', 'releaseToCompare.environmentDefinitionName' => 'release_to_compare_environment_definition_name', 'releaseToCompare.environmentId' => 'release_to_compare_environment_id', 'releaseToCompare.environmentName' => 'release_to_compare_environment_name', 'releaseToCompare.id' => 'release_to_compare_id', 'releaseToCompare.name' => 'release_to_compare_name', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
