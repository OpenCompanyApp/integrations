<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Returns List of custom test fields for the given custom test field scope..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/extensionfields.
 */
class AzureDevOpsTestResultsExtensionfieldsQuery extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_results_extensionfields_query';
    protected const DESCRIPTION = 'Returns List of custom test fields for the given custom test field scope.

Official Azure DevOps REST API 7.2 endpoint: GET https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/extensionfields (spec: testResults/7.2/testResults.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'scope_filter' => ['type' => 'string', 'required' => false, 'description' => 'Scope of custom test fields which are to be returned.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vstmr.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testresults/extensionfields';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['scopeFilter' => 'scope_filter', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
