<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get work items associated with a shelveset..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/tfvc/shelvesets/workitems.
 */
class AzureDevOpsTfvcShelvesetsGetShelvesetWorkItems extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_tfvc_shelvesets_get_shelveset_work_items';
    protected const DESCRIPTION = 'Get work items associated with a shelveset.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/tfvc/shelvesets/workitems (spec: tfvc/7.2/tfvc.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'shelveset_id' => ['type' => 'string', 'required' => false, 'description' => 'Shelveset\'s unique ID'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/tfvc/shelvesets/workitems';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['shelvesetId' => 'shelveset_id', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
