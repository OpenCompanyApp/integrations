<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Updates a behavior for the work item type of the process..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://dev.azure.com/{organization}/_apis/work/processes/{processId}/workitemtypesbehaviors/{witRefNameForBehaviors}/behaviors.
 */
class AzureDevOpsProcessesWorkItemTypesBehaviorsUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_processes_work_item_types_behaviors_update';
    protected const DESCRIPTION = 'Updates a behavior for the work item type of the process.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://dev.azure.com/{organization}/_apis/work/processes/{processId}/workitemtypesbehaviors/{witRefNameForBehaviors}/behaviors (spec: processes/7.2/workItemTrackingProcess.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Azure DevOps Swagger schema.'], 'process_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the process'], 'wit_ref_name_for_behaviors' => ['type' => 'string', 'required' => true, 'description' => 'Work item type reference name for the behavior'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/work/processes/{processId}/workitemtypesbehaviors/{witRefNameForBehaviors}/behaviors';
    protected const PATH_PARAMS = ['organization' => 'organization', 'processId' => 'process_id', 'witRefNameForBehaviors' => 'wit_ref_name_for_behaviors'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
