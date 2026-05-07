<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a list of available service hook consumer services. Optionally filter by consumers that support at least one event type from the specific publisher..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/hooks/consumers.
 */
class AzureDevOpsHooksConsumersList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_hooks_consumers_list';
    protected const DESCRIPTION = 'Get a list of available service hook consumer services. Optionally filter by consumers that support at least one event type from the specific publisher.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/hooks/consumers (spec: hooks/7.2/serviceHooks.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'publisher_id' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `publisherId`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/hooks/consumers';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['publisherId' => 'publisher_id', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
