<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * POST /{organization}/{project}/_apis/testresults/results/query.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/results/query.
 */
class AzureDevOpsTestResultsResultsGetTestResultsByQueryWiql extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_results_results_get_test_results_by_query_wiql';
    protected const DESCRIPTION = 'POST /{organization}/{project}/_apis/testresults/results/query

Official Azure DevOps REST API 7.2 endpoint: POST https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/results/query (spec: testResults/7.2/testResults.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Azure DevOps Swagger schema.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'include_result_details' => ['type' => 'boolean', 'required' => false, 'description' => 'query parameter `includeResultDetails`.'], 'include_iteration_details' => ['type' => 'boolean', 'required' => false, 'description' => 'query parameter `includeIterationDetails`.'], 'skip' => ['type' => 'number', 'required' => false, 'description' => 'query parameter `$skip`.'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'query parameter `$top`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'vstmr.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testresults/results/query';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['includeResultDetails' => 'include_result_details', 'includeIterationDetails' => 'include_iteration_details', '$skip' => 'skip', '$top' => 'top', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
