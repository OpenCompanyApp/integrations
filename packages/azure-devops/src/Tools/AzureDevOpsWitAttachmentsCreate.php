<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Uploads an attachment. On accounts with higher attachment upload limits (>130MB), you will need to use chunked upload. To upload an attachment in multiple chunks, you first need to [**Start a Chunked Upload**](#start_a_chunked_upload) and then follow the example from the **Upload Chunk** section..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{project}/_apis/wit/attachments.
 */
class AzureDevOpsWitAttachmentsCreate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_attachments_create';
    protected const DESCRIPTION = 'Uploads an attachment. On accounts with higher attachment upload limits (>130MB), you will need to use chunked upload. To upload an attachment in multiple chunks, you first need to [**Start a Chunked Upload**](#start_a_chunked_upload) and then follow the example from the **Upload Chunk** section.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{project}/_apis/wit/attachments (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Raw payload: provide `content` as a string and optional `content_type`.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'file_name' => ['type' => 'string', 'required' => false, 'description' => 'The name of the file'], 'upload_type' => ['type' => 'string', 'required' => false, 'description' => 'Attachment upload type: Simple or Chunked'], 'area_path' => ['type' => 'string', 'required' => false, 'description' => 'Target project Area Path'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.4`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wit/attachments';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['fileName' => 'file_name', 'uploadType' => 'upload_type', 'areaPath' => 'area_path', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'octet';
    protected const API_VERSION = '7.2-preview.4';
}
