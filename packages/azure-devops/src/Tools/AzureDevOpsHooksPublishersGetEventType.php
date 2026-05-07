<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a specific event type..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/hooks/publishers/{publisherId}/eventtypes/{eventTypeId}.
 */
class AzureDevOpsHooksPublishersGetEventType extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_hooks_publishers_get_event_type';
    protected const DESCRIPTION = 'Get a specific event type.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/hooks/publishers/{publisherId}/eventtypes/{eventTypeId} (spec: hooks/7.2/serviceHooks.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'publisher_id' => ['type' => 'string', 'required' => true, 'description' => 'ID for a publisher.'], 'event_type_id' => ['type' => 'string', 'required' => true, 'description' => 'path parameter `eventTypeId`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/hooks/publishers/{publisherId}/eventtypes/{eventTypeId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'publisherId' => 'publisher_id', 'eventTypeId' => 'event_type_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
