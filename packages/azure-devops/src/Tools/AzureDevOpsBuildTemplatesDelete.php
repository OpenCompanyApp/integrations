<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Deletes a build definition template..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://dev.azure.com/{organization}/{project}/_apis/build/definitions/templates/{templateId}.
 */
class AzureDevOpsBuildTemplatesDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_templates_delete';
    protected const DESCRIPTION = 'Deletes a build definition template.

Official Azure DevOps REST API 7.2 endpoint: DELETE https://dev.azure.com/{organization}/{project}/_apis/build/definitions/templates/{templateId} (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'template_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the template.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/build/definitions/templates/{templateId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'templateId' => 'template_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}
