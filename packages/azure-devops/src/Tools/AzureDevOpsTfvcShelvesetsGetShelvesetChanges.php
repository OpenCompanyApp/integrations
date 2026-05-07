<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get changes included in a shelveset..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/tfvc/shelvesets/changes.
 */
class AzureDevOpsTfvcShelvesetsGetShelvesetChanges extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_tfvc_shelvesets_get_shelveset_changes';
    protected const DESCRIPTION = 'Get changes included in a shelveset.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/tfvc/shelvesets/changes (spec: tfvc/7.2/tfvc.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'shelveset_id' => ['type' => 'string', 'required' => false, 'description' => 'Shelveset\'s unique ID'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'Max number of changes to return'], 'skip' => ['type' => 'number', 'required' => false, 'description' => 'Number of changes to skip'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/tfvc/shelvesets/changes';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['shelvesetId' => 'shelveset_id', '$top' => 'top', '$skip' => 'skip', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
