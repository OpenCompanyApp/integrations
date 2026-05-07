<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Permanently delete an attachment..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://dev.azure.com/{organization}/{project}/_apis/wit/attachments/{id}.
 */
class AzureDevOpsWitAttachmentsDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_attachments_delete';
    protected const DESCRIPTION = 'Permanently delete an attachment.

Official Azure DevOps REST API 7.2 endpoint: DELETE https://dev.azure.com/{organization}/{project}/_apis/wit/attachments/{id} (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'id' => ['type' => 'string', 'required' => true, 'description' => 'Attachment ID'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.4`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wit/attachments/{id}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'id' => 'id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.4';
}
