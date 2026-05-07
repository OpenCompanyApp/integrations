<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * <p>Gets the coverage status for the last successful build of a definition, optionally scoped to a specific branch</p>.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/codecoverage/status/{definition}.
 */
class AzureDevOpsTestResultsStatusGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_results_status_get';
    protected const DESCRIPTION = '<p>Gets the coverage status for the last successful build of a definition, optionally scoped to a specific branch</p>

Official Azure DevOps REST API 7.2 endpoint: GET https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/codecoverage/status/{definition} (spec: testResults/7.2/testResults.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'definition' => ['type' => 'string', 'required' => true, 'description' => 'The ID or name of the definition.'], 'branch_name' => ['type' => 'string', 'required' => false, 'description' => 'The branch name.'], 'label' => ['type' => 'string', 'required' => false, 'description' => 'The String to replace the default text on the left side of the badge.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vstmr.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testresults/codecoverage/status/{definition}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'definition' => 'definition'];
    protected const QUERY_PARAMS = ['branchName' => 'branch_name', 'label' => 'label', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
