<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets a specific attachment..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/build/builds/{buildId}/{timelineId}/{recordId}/attachments/{type}/{name}.
 */
class AzureDevOpsBuildAttachmentsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_attachments_get';
    protected const DESCRIPTION = 'Gets a specific attachment.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/build/builds/{buildId}/{timelineId}/{recordId}/attachments/{type}/{name} (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'build_id' => ['type' => 'number', 'required' => true, 'description' => 'The ID of the build.'], 'timeline_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the timeline.'], 'record_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the timeline record.'], 'type' => ['type' => 'string', 'required' => true, 'description' => 'The type of the attachment.'], 'name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the attachment.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/build/builds/{buildId}/{timelineId}/{recordId}/attachments/{type}/{name}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'buildId' => 'build_id', 'timelineId' => 'timeline_id', 'recordId' => 'record_id', 'type' => 'type', 'name' => 'name'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
