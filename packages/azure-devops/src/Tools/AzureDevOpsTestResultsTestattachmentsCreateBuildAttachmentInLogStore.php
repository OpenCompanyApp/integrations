<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Creates an attachment in the LogStore for the specified buildId..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/uploadbuildattachments/{buildId}.
 */
class AzureDevOpsTestResultsTestattachmentsCreateBuildAttachmentInLogStore extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_results_testattachments_create_build_attachment_in_log_store';
    protected const DESCRIPTION = 'Creates an attachment in the LogStore for the specified buildId.

Official Azure DevOps REST API 7.2 endpoint: POST https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/uploadbuildattachments/{buildId} (spec: testResults/7.2/testResults.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Contains attachment info like stream, filename, comment, attachmentType'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'build_id' => ['type' => 'number', 'required' => true, 'description' => 'BuildId'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'vstmr.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testresults/uploadbuildattachments/{buildId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'buildId' => 'build_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
