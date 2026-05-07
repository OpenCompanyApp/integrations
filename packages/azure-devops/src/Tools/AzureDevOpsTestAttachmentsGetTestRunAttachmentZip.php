<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Download a test run attachment by its ID..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/test/Runs/{runId}/attachments/{attachmentId}.
 */
class AzureDevOpsTestAttachmentsGetTestRunAttachmentZip extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_attachments_get_test_run_attachment_zip';
    protected const DESCRIPTION = 'Download a test run attachment by its ID.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/test/Runs/{runId}/attachments/{attachmentId} (spec: test/7.2/test.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'run_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the test run whose attachment has to be downloaded.'], 'attachment_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the test run attachment to be downloaded.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/test/Runs/{runId}/attachments/{attachmentId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'runId' => 'run_id', 'attachmentId' => 'attachment_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
