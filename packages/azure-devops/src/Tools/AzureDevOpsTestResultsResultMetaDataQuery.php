<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get list of test Result meta data details for corresponding testcasereferenceId.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/results/resultmetadata.
 */
class AzureDevOpsTestResultsResultMetaDataQuery extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_results_result_meta_data_query';
    protected const DESCRIPTION = 'Get list of test Result meta data details for corresponding testcasereferenceId

Official Azure DevOps REST API 7.2 endpoint: POST https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/results/resultmetadata (spec: testResults/7.2/testResults.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'TestCaseReference Ids of the test Result to be queried, comma separated list of valid ids (limit no. of ids 200).'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'details_to_include' => ['type' => 'string', 'required' => false, 'description' => 'Details to include with test results metadata. Default is None. Other values are FlakyIdentifiers.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.4`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'vstmr.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testresults/results/resultmetadata';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['detailsToInclude' => 'details_to_include', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.4';
}
