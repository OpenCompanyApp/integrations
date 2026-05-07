<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Removes a tag from a build. NOTE: This API will not work for tags with special characters. To remove tags with special characters, use the PATCH method instead (in 6.0+).
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://dev.azure.com/{organization}/{project}/_apis/build/builds/{buildId}/tags/{tag}.
 */
class AzureDevOpsBuildTagsDeleteBuildTag extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_tags_delete_build_tag';
    protected const DESCRIPTION = 'Removes a tag from a build. NOTE: This API will not work for tags with special characters. To remove tags with special characters, use the PATCH method instead (in 6.0+)

Official Azure DevOps REST API 7.2 endpoint: DELETE https://dev.azure.com/{organization}/{project}/_apis/build/builds/{buildId}/tags/{tag} (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'build_id' => ['type' => 'number', 'required' => true, 'description' => 'The ID of the build.'], 'tag' => ['type' => 'string', 'required' => true, 'description' => 'The tag to remove.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/build/builds/{buildId}/tags/{tag}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'buildId' => 'build_id', 'tag' => 'tag'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}
