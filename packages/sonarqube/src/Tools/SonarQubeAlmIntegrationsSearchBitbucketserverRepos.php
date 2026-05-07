<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Search the Bitbucket Server repositories with REPO_ADMIN access Requires the 'Create Projects' permission.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/alm_integrations/search_bitbucketserver_repos.
 */
class SonarQubeAlmIntegrationsSearchBitbucketserverRepos extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_alm_integrations_search_bitbucketserver_repos';
    protected const DESCRIPTION = 'Search the Bitbucket Server repositories with REPO_ADMIN access Requires the \'Create Projects\' permission

Official SonarQube Web API endpoint: GET /api/alm_integrations/search_bitbucketserver_repos.';
    protected const PARAMETERS = array (
      'alm_setting' => array (
        'type' => 'string',
        'description' => 'DevOps Platform setting key',
        'required' => true,
      ),
      'page_size' => array (
        'type' => 'string',
        'description' => 'Number of items to return.',
        'required' => false,
      ),
      'project_name' => array (
        'type' => 'string',
        'description' => 'Project name filter',
        'required' => false,
      ),
      'repository_name' => array (
        'type' => 'string',
        'description' => 'Repository name filter',
        'required' => false,
      ),
      'start' => array (
        'type' => 'string',
        'description' => 'Start number for the page (inclusive). If not passed, the first page is assumed.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/alm_integrations/search_bitbucketserver_repos';
    protected const PARAM_MAP = array (
      'almSetting' => 'alm_setting',
      'pageSize' => 'page_size',
      'projectName' => 'project_name',
      'repositoryName' => 'repository_name',
      'start' => 'start',
    );
}
