<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets a controller.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/build/controllers/{controllerId}.
 */
class AzureDevOpsBuildControllersGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_controllers_get';
    protected const DESCRIPTION = 'Gets a controller

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/build/controllers/{controllerId} (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'controller_id' => ['type' => 'number', 'required' => true, 'description' => 'path parameter `controllerId`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/build/controllers/{controllerId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'controllerId' => 'controller_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
