<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Returns the next state on the given work item IDs..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/wit/workitemtransitions.
 */
class AzureDevOpsWitWorkItemTransitionsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_work_item_transitions_list';
    protected const DESCRIPTION = 'Returns the next state on the given work item IDs.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/wit/workitemtransitions (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'ids' => ['type' => 'string', 'required' => false, 'description' => 'list of work item ids'], 'action' => ['type' => 'string', 'required' => false, 'description' => 'possible actions. Currently only supports checkin'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/wit/workitemtransitions';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['ids' => 'ids', 'action' => 'action', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
