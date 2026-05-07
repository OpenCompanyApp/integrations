<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Imports a process from zip file..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/_apis/work/processadmin/processes/import.
 */
class AzureDevOpsProcessadminProcessesImportProcessTemplate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_processadmin_processes_import_process_template';
    protected const DESCRIPTION = 'Imports a process from zip file.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/_apis/work/processadmin/processes/import (spec: processadmin/7.2/workItemTrackingProcessTemplate.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Raw payload: provide `content` as a string and optional `content_type`.'], 'ignore_warnings' => ['type' => 'boolean', 'required' => false, 'description' => 'Ignores validation warnings. Default value is false.'], 'replace_existing_template' => ['type' => 'boolean', 'required' => false, 'description' => 'Replaces the existing template. Default value is true.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/work/processadmin/processes/import';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['ignoreWarnings' => 'ignore_warnings', 'replaceExistingTemplate' => 'replace_existing_template', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'octet';
    protected const API_VERSION = '7.2-preview.1';
}
