<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Updates a single work item..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://dev.azure.com/{organization}/{project}/_apis/wit/workitems/{id}.
 */
class AzureDevOpsWitWorkItemsUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_work_items_update';
    protected const DESCRIPTION = 'Updates a single work item.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://dev.azure.com/{organization}/{project}/_apis/wit/workitems/{id} (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The JSON Patch document representing the update'], 'id' => ['type' => 'number', 'required' => true, 'description' => 'The id of the work item to update'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'validate_only' => ['type' => 'boolean', 'required' => false, 'description' => 'Indicate if you only want to validate the changes without saving the work item'], 'bypass_rules' => ['type' => 'boolean', 'required' => false, 'description' => 'Do not enforce the work item type rules on this update'], 'suppress_notifications' => ['type' => 'boolean', 'required' => false, 'description' => 'Do not fire any notifications for this change'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'The expand parameters for work item attributes. Possible options are { None, Relations, Fields, Links, All }.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wit/workitems/{id}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'id' => 'id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['validateOnly' => 'validate_only', 'bypassRules' => 'bypass_rules', 'suppressNotifications' => 'suppress_notifications', '$expand' => 'expand', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}
