<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get manual intervention for a given release and manual intervention id..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vsrm.dev.azure.com/{organization}/{project}/_apis/Release/releases/{releaseId}/manualinterventions/{manualInterventionId}.
 */
class AzureDevOpsReleaseManualInterventionsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_release_manual_interventions_get';
    protected const DESCRIPTION = 'Get manual intervention for a given release and manual intervention id.

Official Azure DevOps REST API 7.2 endpoint: GET https://vsrm.dev.azure.com/{organization}/{project}/_apis/Release/releases/{releaseId}/manualinterventions/{manualInterventionId} (spec: release/7.2/release.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'release_id' => ['type' => 'number', 'required' => true, 'description' => 'Id of the release.'], 'manual_intervention_id' => ['type' => 'number', 'required' => true, 'description' => 'Id of the manual intervention.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vsrm.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/Release/releases/{releaseId}/manualinterventions/{manualInterventionId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'releaseId' => 'release_id', 'manualInterventionId' => 'manual_intervention_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
