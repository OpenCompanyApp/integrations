<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Returns details of the custom test field for the specified testExtensionFieldId..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/extensionfields/{testExtensionFieldId}.
 */
class AzureDevOpsTestResultsExtensionfieldsDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_results_extensionfields_delete';
    protected const DESCRIPTION = 'Returns details of the custom test field for the specified testExtensionFieldId.

Official Azure DevOps REST API 7.2 endpoint: DELETE https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/extensionfields/{testExtensionFieldId} (spec: testResults/7.2/testResults.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'test_extension_field_id' => ['type' => 'number', 'required' => true, 'description' => 'Custom test field id which has to be deleted.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'vstmr.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testresults/extensionfields/{testExtensionFieldId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'testExtensionFieldId' => 'test_extension_field_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
