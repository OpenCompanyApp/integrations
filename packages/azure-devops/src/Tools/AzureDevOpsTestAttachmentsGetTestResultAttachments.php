<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get list of test result attachments reference..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/test/Runs/{runId}/Results/{testCaseResultId}/attachments.
 */
class AzureDevOpsTestAttachmentsGetTestResultAttachments extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_attachments_get_test_result_attachments';
    protected const DESCRIPTION = 'Get list of test result attachments reference.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/test/Runs/{runId}/Results/{testCaseResultId}/attachments (spec: test/7.2/test.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'run_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the test run that contains the result.'], 'test_case_result_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the test result.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/test/Runs/{runId}/Results/{testCaseResultId}/attachments';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'runId' => 'run_id', 'testCaseResultId' => 'test_case_result_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
