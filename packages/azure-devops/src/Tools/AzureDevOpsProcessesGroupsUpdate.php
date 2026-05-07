<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Updates a group in the work item form..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://dev.azure.com/{organization}/_apis/work/processes/{processId}/workItemTypes/{witRefName}/layout/pages/{pageId}/sections/{sectionId}/groups/{groupId}.
 */
class AzureDevOpsProcessesGroupsUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_processes_groups_update';
    protected const DESCRIPTION = 'Updates a group in the work item form.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://dev.azure.com/{organization}/_apis/work/processes/{processId}/workItemTypes/{witRefName}/layout/pages/{pageId}/sections/{sectionId}/groups/{groupId} (spec: processes/7.2/workItemTrackingProcess.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The updated group.'], 'process_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the process.'], 'wit_ref_name' => ['type' => 'string', 'required' => true, 'description' => 'The reference name of the work item type.'], 'page_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the page the group is in.'], 'section_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the section the group is in.'], 'group_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the group.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/work/processes/{processId}/workItemTypes/{witRefName}/layout/pages/{pageId}/sections/{sectionId}/groups/{groupId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'processId' => 'process_id', 'witRefName' => 'wit_ref_name', 'pageId' => 'page_id', 'sectionId' => 'section_id', 'groupId' => 'group_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
