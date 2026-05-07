<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Search the Bitbucket Cloud repositories Requires the 'Create Projects' permission.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/alm_integrations/search_bitbucketcloud_repos.
 */
class SonarQubeAlmIntegrationsSearchBitbucketcloudRepos extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_alm_integrations_search_bitbucketcloud_repos';
    protected const DESCRIPTION = 'Search the Bitbucket Cloud repositories Requires the \'Create Projects\' permission

Official SonarQube Web API endpoint: GET /api/alm_integrations/search_bitbucketcloud_repos.';
    protected const PARAMETERS = array (
      'alm_setting' => array (
        'type' => 'string',
        'description' => 'DevOps Platform setting key',
        'required' => true,
      ),
      'p' => array (
        'type' => 'string',
        'description' => '1-based page number',
        'required' => false,
      ),
      'ps' => array (
        'type' => 'string',
        'description' => 'Page size. Must be greater than 0 and less or equal than 100',
        'required' => false,
      ),
      'repository_name' => array (
        'type' => 'string',
        'description' => 'Repository name filter',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/alm_integrations/search_bitbucketcloud_repos';
    protected const PARAM_MAP = array (
      'almSetting' => 'alm_setting',
      'p' => 'p',
      'ps' => 'ps',
      'repositoryName' => 'repository_name',
    );
}
