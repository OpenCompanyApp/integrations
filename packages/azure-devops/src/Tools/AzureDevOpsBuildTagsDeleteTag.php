<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Removes a tag from builds, definitions, and from the tag store.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://dev.azure.com/{organization}/{project}/_apis/build/tags/{tag}.
 */
class AzureDevOpsBuildTagsDeleteTag extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_tags_delete_tag';
    protected const DESCRIPTION = 'Removes a tag from builds, definitions, and from the tag store

Official Azure DevOps REST API 7.2 endpoint: DELETE https://dev.azure.com/{organization}/{project}/_apis/build/tags/{tag} (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'tag' => ['type' => 'string', 'required' => true, 'description' => 'The tag to remove.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/build/tags/{tag}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'tag' => 'tag'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}
