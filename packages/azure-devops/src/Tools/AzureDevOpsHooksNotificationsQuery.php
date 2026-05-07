<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Query for notifications. A notification includes details about the event, the request to and the response from the consumer service..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/_apis/hooks/notificationsquery.
 */
class AzureDevOpsHooksNotificationsQuery extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_hooks_notifications_query';
    protected const DESCRIPTION = 'Query for notifications. A notification includes details about the event, the request to and the response from the consumer service.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/_apis/hooks/notificationsquery (spec: hooks/7.2/serviceHooks.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Azure DevOps Swagger schema.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/hooks/notificationsquery';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
