<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Queries status information for the service all-up, or scoped to a particular service and/or geography.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://status.dev.azure.com/_apis/status/health.
 */
class AzureDevOpsStatusHealthGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_status_health_get';
    protected const DESCRIPTION = 'Queries status information for the service all-up, or scoped to a particular service and/or geography

Official Azure DevOps REST API 7.2 endpoint: GET https://status.dev.azure.com/_apis/status/health (spec: status/7.2/status.json).';
    protected const PARAMETERS = ['services' => ['type' => 'string', 'required' => false, 'description' => 'A comma-separated list of services for which to get status information for. Supported values: Artifacts, Boards, Core services, Other services, Pipelines, Repos, Test Plans.'], 'geographies' => ['type' => 'string', 'required' => false, 'description' => 'A comma-separated list of geographies for which to get status information for. Supported values: APAC, AU, BR, CA, EU, IN, UK, US.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'status.dev.azure.com';
    protected const PATH = '/_apis/status/health';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = ['services' => 'services', 'geographies' => 'geographies', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
