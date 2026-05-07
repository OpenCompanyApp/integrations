<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Returns a list of behaviors for the process..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/work/processadmin/{processId}/behaviors.
 */
class AzureDevOpsProcessadminBehaviorsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_processadmin_behaviors_list';
    protected const DESCRIPTION = 'Returns a list of behaviors for the process.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/work/processadmin/{processId}/behaviors (spec: processadmin/7.2/workItemTrackingProcessTemplate.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'process_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the process'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/work/processadmin/{processId}/behaviors';
    protected const PATH_PARAMS = ['organization' => 'organization', 'processId' => 'process_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
