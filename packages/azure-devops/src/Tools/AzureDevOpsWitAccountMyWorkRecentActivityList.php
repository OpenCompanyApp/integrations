<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets recent work item activities.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/work/accountmyworkrecentactivity.
 */
class AzureDevOpsWitAccountMyWorkRecentActivityList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_account_my_work_recent_activity_list';
    protected const DESCRIPTION = 'Gets recent work item activities

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/work/accountmyworkrecentactivity (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/work/accountmyworkrecentactivity';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
