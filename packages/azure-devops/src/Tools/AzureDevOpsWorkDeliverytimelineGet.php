<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get Delivery View Data.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/work/plans/{id}/deliverytimeline.
 */
class AzureDevOpsWorkDeliverytimelineGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_work_deliverytimeline_get';
    protected const DESCRIPTION = 'Get Delivery View Data

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/work/plans/{id}/deliverytimeline (spec: work/7.2/work.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'id' => ['type' => 'string', 'required' => true, 'description' => 'Identifier for delivery view'], 'revision' => ['type' => 'number', 'required' => false, 'description' => 'Revision of the plan for which you want data. If the current plan is a different revision you will get an ViewRevisionMismatchException exception. If you do not supply a revision you will get data for the latest revision.'], 'start_date' => ['type' => 'string', 'required' => false, 'description' => 'The start date of timeline'], 'end_date' => ['type' => 'string', 'required' => false, 'description' => 'The end date of timeline'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/work/plans/{id}/deliverytimeline';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'id' => 'id'];
    protected const QUERY_PARAMS = ['revision' => 'revision', 'startDate' => 'start_date', 'endDate' => 'end_date', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
