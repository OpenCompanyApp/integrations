<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Adds a tag to a build..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PUT https://dev.azure.com/{organization}/{project}/_apis/build/builds/{buildId}/tags/{tag}.
 */
class AzureDevOpsBuildTagsAddBuildTag extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_tags_add_build_tag';
    protected const DESCRIPTION = 'Adds a tag to a build.

Official Azure DevOps REST API 7.2 endpoint: PUT https://dev.azure.com/{organization}/{project}/_apis/build/builds/{buildId}/tags/{tag} (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'build_id' => ['type' => 'number', 'required' => true, 'description' => 'The ID of the build.'], 'tag' => ['type' => 'string', 'required' => true, 'description' => 'The tag to add.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.'], 'body' => ['type' => 'object', 'required' => false, 'description' => 'Request body matching the official Azure DevOps Swagger schema.']];
    protected const METHOD = 'PUT';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/build/builds/{buildId}/tags/{tag}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'buildId' => 'build_id', 'tag' => 'tag'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}
