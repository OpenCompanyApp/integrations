<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a list of test sessions.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/{team}/_apis/test/session.
 */
class AzureDevOpsTestSessionList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_session_list';
    protected const DESCRIPTION = 'Get a list of test sessions

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/{team}/_apis/test/session (spec: test/7.2/test.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'team' => ['type' => 'string', 'required' => true, 'description' => 'Team ID or team name'], 'period' => ['type' => 'number', 'required' => false, 'description' => 'Period in days from now, for which test sessions are fetched.'], 'all_sessions' => ['type' => 'boolean', 'required' => false, 'description' => 'If false, returns test sessions for current user. Otherwise, it returns test sessions for all users'], 'include_all_properties' => ['type' => 'boolean', 'required' => false, 'description' => 'If true, it returns all properties of the test sessions. Otherwise, it returns the skinny version.'], 'source' => ['type' => 'string', 'required' => false, 'description' => 'Source of the test session.'], 'include_only_completed_sessions' => ['type' => 'boolean', 'required' => false, 'description' => 'If true, it returns test sessions in completed state. Otherwise, it returns test sessions for all states'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/{team}/_apis/test/session';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'team' => 'team'];
    protected const QUERY_PARAMS = ['period' => 'period', 'allSessions' => 'all_sessions', 'includeAllProperties' => 'include_all_properties', 'source' => 'source', 'includeOnlyCompletedSessions' => 'include_only_completed_sessions', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
