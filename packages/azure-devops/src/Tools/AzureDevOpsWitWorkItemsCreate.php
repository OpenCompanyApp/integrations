<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Creates a single work item..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{project}/_apis/wit/workitems/${type}.
 */
class AzureDevOpsWitWorkItemsCreate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_work_items_create';
    protected const DESCRIPTION = 'Creates a single work item.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{project}/_apis/wit/workitems/${type} (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The JSON Patch document representing the work item'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'type' => ['type' => 'string', 'required' => true, 'description' => 'The work item type of the work item to create'], 'validate_only' => ['type' => 'boolean', 'required' => false, 'description' => 'Indicate if you only want to validate the changes without saving the work item'], 'bypass_rules' => ['type' => 'boolean', 'required' => false, 'description' => 'Do not enforce the work item type rules on this update'], 'suppress_notifications' => ['type' => 'boolean', 'required' => false, 'description' => 'Do not fire any notifications for this change'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'The expand parameters for work item attributes. Possible options are { None, Relations, Fields, Links, All }.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wit/workitems/${type}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'type' => 'type'];
    protected const QUERY_PARAMS = ['validateOnly' => 'validate_only', 'bypassRules' => 'bypass_rules', 'suppressNotifications' => 'suppress_notifications', '$expand' => 'expand', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}
