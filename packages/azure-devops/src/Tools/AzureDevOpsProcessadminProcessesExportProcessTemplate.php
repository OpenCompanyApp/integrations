<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Returns requested process template..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/work/processadmin/processes/export/{id}.
 */
class AzureDevOpsProcessadminProcessesExportProcessTemplate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_processadmin_processes_export_process_template';
    protected const DESCRIPTION = 'Returns requested process template.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/work/processadmin/processes/export/{id} (spec: processadmin/7.2/workItemTrackingProcessTemplate.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the process'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/work/processadmin/processes/export/{id}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'id' => 'id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
