<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Uploads an attachment chunk. Before performing [**Upload a Chunk**](#upload-a-chunk), make sure to have an attachment id returned in **Start a Chunked Upload** example on **Create** section. Specify the byte range of the chunk using Content-Length. For example: "Content - Length": "bytes 0 - 39999 / 50000" for the first 40000 bytes of a 50000 byte file..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PUT https://dev.azure.com/{organization}/{project}/_apis/wit/attachments/{id}.
 */
class AzureDevOpsWitAttachmentsUploadChunk extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_attachments_upload_chunk';
    protected const DESCRIPTION = 'Uploads an attachment chunk. Before performing [**Upload a Chunk**](#upload-a-chunk), make sure to have an attachment id returned in **Start a Chunked Upload** example on **Create** section. Specify the byte range of the chunk using Content-Length. For example: "Content - Length": "bytes 0 - 39999 / 50000" for the first 40000 bytes of a 50000 byte file.

Official Azure DevOps REST API 7.2 endpoint: PUT https://dev.azure.com/{organization}/{project}/_apis/wit/attachments/{id} (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Raw payload: provide `content` as a string and optional `content_type`.'], 'id' => ['type' => 'string', 'required' => true, 'description' => 'The id of the attachment'], 'content_range_header' => ['type' => 'string', 'required' => false, 'description' => 'starting and ending byte positions for chunked file upload, format is "Content-Range": "bytes 0-10000/50000"'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'file_name' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `fileName`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.4`.']];
    protected const METHOD = 'PUT';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wit/attachments/{id}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'id' => 'id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['fileName' => 'file_name', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = ['contentRangeHeader' => 'content_range_header'];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'octet';
    protected const API_VERSION = '7.2-preview.4';
}
