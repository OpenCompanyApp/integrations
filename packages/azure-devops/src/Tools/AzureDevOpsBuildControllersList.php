<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets controller, optionally filtered by name.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/build/controllers.
 */
class AzureDevOpsBuildControllersList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_controllers_list';
    protected const DESCRIPTION = 'Gets controller, optionally filtered by name

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/build/controllers (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'name' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `name`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/build/controllers';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['name' => 'name', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
