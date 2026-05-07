<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * DELETE /{organization}/{project}/_apis/testresults/runs/{runId}/results/{testCaseResultId}/attachments/{attachmentId}.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/runs/{runId}/results/{testCaseResultId}/attachments/{attachmentId}.
 */
class AzureDevOpsTestResultsAttachmentsDeleteTestResultAttachment extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_results_attachments_delete_test_result_attachment';
    protected const DESCRIPTION = 'DELETE /{organization}/{project}/_apis/testresults/runs/{runId}/results/{testCaseResultId}/attachments/{attachmentId}

Official Azure DevOps REST API 7.2 endpoint: DELETE https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/runs/{runId}/results/{testCaseResultId}/attachments/{attachmentId} (spec: testResults/7.2/testResults.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'run_id' => ['type' => 'number', 'required' => true, 'description' => 'path parameter `runId`.'], 'test_case_result_id' => ['type' => 'number', 'required' => true, 'description' => 'path parameter `testCaseResultId`.'], 'attachment_id' => ['type' => 'number', 'required' => true, 'description' => 'path parameter `attachmentId`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'vstmr.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testresults/runs/{runId}/results/{testCaseResultId}/attachments/{attachmentId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'runId' => 'run_id', 'testCaseResultId' => 'test_case_result_id', 'attachmentId' => 'attachment_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
