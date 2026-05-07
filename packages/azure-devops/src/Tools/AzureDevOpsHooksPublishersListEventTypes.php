<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get the event types for a specific publisher..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/hooks/publishers/{publisherId}/eventtypes.
 */
class AzureDevOpsHooksPublishersListEventTypes extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_hooks_publishers_list_event_types';
    protected const DESCRIPTION = 'Get the event types for a specific publisher.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/hooks/publishers/{publisherId}/eventtypes (spec: hooks/7.2/serviceHooks.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'publisher_id' => ['type' => 'string', 'required' => true, 'description' => 'ID for a publisher.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/hooks/publishers/{publisherId}/eventtypes';
    protected const PATH_PARAMS = ['organization' => 'organization', 'publisherId' => 'publisher_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
