<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Tells whether promote has completed for the specified promote job ID..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/work/processadmin/processes/status/{id}.
 */
class AzureDevOpsProcessadminProcessesImportProcessTemplateStatus extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_processadmin_processes_import_process_template_status';
    protected const DESCRIPTION = 'Tells whether promote has completed for the specified promote job ID.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/work/processadmin/processes/status/{id} (spec: processadmin/7.2/workItemTrackingProcessTemplate.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the promote job operation'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/work/processadmin/processes/status/{id}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'id' => 'id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
