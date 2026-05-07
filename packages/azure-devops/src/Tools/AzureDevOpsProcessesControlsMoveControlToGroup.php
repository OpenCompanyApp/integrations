<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Moves a control to a specified group..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PUT https://dev.azure.com/{organization}/_apis/work/processes/{processId}/workItemTypes/{witRefName}/layout/groups/{groupId}/controls/{controlId}.
 */
class AzureDevOpsProcessesControlsMoveControlToGroup extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_processes_controls_move_control_to_group';
    protected const DESCRIPTION = 'Moves a control to a specified group.

Official Azure DevOps REST API 7.2 endpoint: PUT https://dev.azure.com/{organization}/_apis/work/processes/{processId}/workItemTypes/{witRefName}/layout/groups/{groupId}/controls/{controlId} (spec: processes/7.2/workItemTrackingProcess.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The control.'], 'process_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the process.'], 'wit_ref_name' => ['type' => 'string', 'required' => true, 'description' => 'The reference name of the work item type.'], 'group_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the group to move the control to.'], 'control_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the control.'], 'remove_from_group_id' => ['type' => 'string', 'required' => false, 'description' => 'The group ID to remove the control from.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PUT';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/work/processes/{processId}/workItemTypes/{witRefName}/layout/groups/{groupId}/controls/{controlId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'processId' => 'process_id', 'witRefName' => 'wit_ref_name', 'groupId' => 'group_id', 'controlId' => 'control_id'];
    protected const QUERY_PARAMS = ['removeFromGroupId' => 'remove_from_group_id', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
