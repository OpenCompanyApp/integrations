<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * GetTaskAttachmentContent API is deprecated. Use GetReleaseTaskAttachmentContent API instead..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vsrm.dev.azure.com/{organization}/{project}/_apis/release/releases/{releaseId}/environments/{environmentId}/attempts/{attemptId}/timelines/{timelineId}/records/{recordId}/attachments/{type}/{name}.
 */
class AzureDevOpsReleaseAttachmentsGetTaskAttachmentContent extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_release_attachments_get_task_attachment_content';
    protected const DESCRIPTION = 'GetTaskAttachmentContent API is deprecated. Use GetReleaseTaskAttachmentContent API instead.

Official Azure DevOps REST API 7.2 endpoint: GET https://vsrm.dev.azure.com/{organization}/{project}/_apis/release/releases/{releaseId}/environments/{environmentId}/attempts/{attemptId}/timelines/{timelineId}/records/{recordId}/attachments/{type}/{name} (spec: release/7.2/release.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'release_id' => ['type' => 'number', 'required' => true, 'description' => 'Id of the release.'], 'environment_id' => ['type' => 'number', 'required' => true, 'description' => 'Id of the release environment.'], 'attempt_id' => ['type' => 'number', 'required' => true, 'description' => 'Attempt number of deployment.'], 'timeline_id' => ['type' => 'string', 'required' => true, 'description' => 'Timeline Id of the task.'], 'record_id' => ['type' => 'string', 'required' => true, 'description' => 'Record Id of attachment.'], 'type' => ['type' => 'string', 'required' => true, 'description' => 'Type of the attachment.'], 'name' => ['type' => 'string', 'required' => true, 'description' => 'Name of the attachment.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vsrm.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/release/releases/{releaseId}/environments/{environmentId}/attempts/{attemptId}/timelines/{timelineId}/records/{recordId}/attachments/{type}/{name}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'releaseId' => 'release_id', 'environmentId' => 'environment_id', 'attemptId' => 'attempt_id', 'timelineId' => 'timeline_id', 'recordId' => 'record_id', 'type' => 'type', 'name' => 'name'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
