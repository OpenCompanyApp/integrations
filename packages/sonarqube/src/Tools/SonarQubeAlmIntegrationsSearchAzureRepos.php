<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Search the Azure repositories Requires the 'Create Projects' permission.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/alm_integrations/search_azure_repos.
 */
class SonarQubeAlmIntegrationsSearchAzureRepos extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_alm_integrations_search_azure_repos';
    protected const DESCRIPTION = 'Search the Azure repositories Requires the \'Create Projects\' permission

Official SonarQube Web API endpoint: GET /api/alm_integrations/search_azure_repos.';
    protected const PARAMETERS = array (
      'alm_setting' => array (
        'type' => 'string',
        'description' => 'DevOps Platform setting key',
        'required' => true,
      ),
      'project_name' => array (
        'type' => 'string',
        'description' => 'Project name filter',
        'required' => false,
      ),
      'search_query' => array (
        'type' => 'string',
        'description' => 'Search query filter',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/alm_integrations/search_azure_repos';
    protected const PARAM_MAP = array (
      'almSetting' => 'alm_setting',
      'projectName' => 'project_name',
      'searchQuery' => 'search_query',
    );
}
