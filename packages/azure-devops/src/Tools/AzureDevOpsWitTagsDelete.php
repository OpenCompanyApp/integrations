<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Delete the tag for the project. Please note, that the deleted tag will be removed from all Work Items as well as Pull Requests..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://dev.azure.com/{organization}/{project}/_apis/wit/tags/{tagIdOrName}.
 */
class AzureDevOpsWitTagsDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_tags_delete';
    protected const DESCRIPTION = 'Delete the tag for the project. Please note, that the deleted tag will be removed from all Work Items as well as Pull Requests.

Official Azure DevOps REST API 7.2 endpoint: DELETE https://dev.azure.com/{organization}/{project}/_apis/wit/tags/{tagIdOrName} (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'tag_id_or_name' => ['type' => 'string', 'required' => true, 'description' => 'Tag ID or tag name.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wit/tags/{tagIdOrName}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'tagIdOrName' => 'tag_id_or_name'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
