<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a single deep shelveset..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/tfvc/shelvesets.
 */
class AzureDevOpsTfvcShelvesetsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_tfvc_shelvesets_get';
    protected const DESCRIPTION = 'Get a single deep shelveset.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/tfvc/shelvesets (spec: tfvc/7.2/tfvc.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'shelveset_id' => ['type' => 'string', 'required' => false, 'description' => 'Shelveset\'s unique ID'], 'request_data_include_details' => ['type' => 'boolean', 'required' => false, 'description' => 'Whether to include policyOverride and notes Only applies when requesting a single deep shelveset'], 'request_data_include_links' => ['type' => 'boolean', 'required' => false, 'description' => 'Whether to include the _links field on the shallow references. Does not apply when requesting a single deep shelveset object. Links will always be included in the deep shelveset.'], 'request_data_include_work_items' => ['type' => 'boolean', 'required' => false, 'description' => 'Whether to include workItems'], 'request_data_max_change_count' => ['type' => 'number', 'required' => false, 'description' => 'Max number of changes to include'], 'request_data_max_comment_length' => ['type' => 'number', 'required' => false, 'description' => 'Max length of comment'], 'request_data_name' => ['type' => 'string', 'required' => false, 'description' => 'Shelveset name'], 'request_data_owner' => ['type' => 'string', 'required' => false, 'description' => 'Owner\'s ID. Could be a name or a guid.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/tfvc/shelvesets';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['shelvesetId' => 'shelveset_id', 'requestData.includeDetails' => 'request_data_include_details', 'requestData.includeLinks' => 'request_data_include_links', 'requestData.includeWorkItems' => 'request_data_include_work_items', 'requestData.maxChangeCount' => 'request_data_max_change_count', 'requestData.maxCommentLength' => 'request_data_max_comment_length', 'requestData.name' => 'request_data_name', 'requestData.owner' => 'request_data_owner', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
