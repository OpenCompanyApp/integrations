<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets the list of attachments of a specific type that are associated with a build..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/build/builds/{buildId}/attachments/{type}.
 */
class AzureDevOpsBuildAttachmentsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_attachments_list';
    protected const DESCRIPTION = 'Gets the list of attachments of a specific type that are associated with a build.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/build/builds/{buildId}/attachments/{type} (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'build_id' => ['type' => 'number', 'required' => true, 'description' => 'The ID of the build.'], 'type' => ['type' => 'string', 'required' => true, 'description' => 'The type of attachment.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/build/builds/{buildId}/attachments/{type}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'buildId' => 'build_id', 'type' => 'type'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
