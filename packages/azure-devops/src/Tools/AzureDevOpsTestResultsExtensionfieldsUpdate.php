<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Returns details of the custom test field which is updated..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/extensionfields.
 */
class AzureDevOpsTestResultsExtensionfieldsUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_results_extensionfields_update';
    protected const DESCRIPTION = 'Returns details of the custom test field which is updated.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/extensionfields (spec: testResults/7.2/testResults.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Custom test field which has to be updated.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'vstmr.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testresults/extensionfields';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
