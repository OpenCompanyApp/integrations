<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Update timeline records if they already exist, otherwise create new ones for the same timeline..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://dev.azure.com/{organization}/{scopeIdentifier}/_apis/distributedtask/hubs/{hubName}/plans/{planId}/timelines/{timelineId}/records.
 */
class AzureDevOpsDistributedTaskRecordsUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_distributed_task_records_update';
    protected const DESCRIPTION = 'Update timeline records if they already exist, otherwise create new ones for the same timeline.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://dev.azure.com/{organization}/{scopeIdentifier}/_apis/distributedtask/hubs/{hubName}/plans/{planId}/timelines/{timelineId}/records (spec: distributedTask/7.2/task.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The array of timeline records to be updated.'], 'scope_identifier' => ['type' => 'string', 'required' => true, 'description' => 'The project GUID to scope the request'], 'hub_name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the server hub. Common examples: "build", "rm", "checks"'], 'plan_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the plan.'], 'timeline_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the timeline.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{scopeIdentifier}/_apis/distributedtask/hubs/{hubName}/plans/{planId}/timelines/{timelineId}/records';
    protected const PATH_PARAMS = ['organization' => 'organization', 'scopeIdentifier' => 'scope_identifier', 'hubName' => 'hub_name', 'planId' => 'plan_id', 'timelineId' => 'timeline_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
