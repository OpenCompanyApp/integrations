<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Removes a control from the work item form..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://dev.azure.com/{organization}/_apis/work/processes/{processId}/workItemTypes/{witRefName}/layout/groups/{groupId}/controls/{controlId}.
 */
class AzureDevOpsProcessesControlsRemoveControlFromGroup extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_processes_controls_remove_control_from_group';
    protected const DESCRIPTION = 'Removes a control from the work item form.

Official Azure DevOps REST API 7.2 endpoint: DELETE https://dev.azure.com/{organization}/_apis/work/processes/{processId}/workItemTypes/{witRefName}/layout/groups/{groupId}/controls/{controlId} (spec: processes/7.2/workItemTrackingProcess.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'process_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the process.'], 'wit_ref_name' => ['type' => 'string', 'required' => true, 'description' => 'The reference name of the work item type.'], 'group_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the group.'], 'control_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the control to remove.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/work/processes/{processId}/workItemTypes/{witRefName}/layout/groups/{groupId}/controls/{controlId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'processId' => 'process_id', 'witRefName' => 'wit_ref_name', 'groupId' => 'group_id', 'controlId' => 'control_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
