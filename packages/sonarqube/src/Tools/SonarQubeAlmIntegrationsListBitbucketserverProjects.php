<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * List the Bitbucket Server projects Requires the 'Create Projects' permission.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/alm_integrations/list_bitbucketserver_projects.
 */
class SonarQubeAlmIntegrationsListBitbucketserverProjects extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_alm_integrations_list_bitbucketserver_projects';
    protected const DESCRIPTION = 'List the Bitbucket Server projects Requires the \'Create Projects\' permission

Official SonarQube Web API endpoint: GET /api/alm_integrations/list_bitbucketserver_projects.';
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
      'start' => array (
        'type' => 'string',
        'description' => 'Start number for the page (inclusive). If not passed, the first page is assumed.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/alm_integrations/list_bitbucketserver_projects';
    protected const PARAM_MAP = array (
      'almSetting' => 'alm_setting',
      'pageSize' => 'page_size',
      'start' => 'start',
    );
}
