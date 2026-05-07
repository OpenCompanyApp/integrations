<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * List DevOps Platform setting available for a given project, sorted by DevOps Platform key Requires the 'Administer project' permission if the 'project' parameter is provided, requires the 'Create Projects' permission otherwise..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/alm_settings/list.
 */
class SonarQubeAlmSettingsList extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_alm_settings_list';
    protected const DESCRIPTION = 'List DevOps Platform setting available for a given project, sorted by DevOps Platform key Requires the \'Administer project\' permission if the \'project\' parameter is provided, requires the \'Create Projects\' permission otherwise.

Official SonarQube Web API endpoint: GET /api/alm_settings/list.';
    protected const PARAMETERS = array (
      'project' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/alm_settings/list';
    protected const PARAM_MAP = array (
      'project' => 'project',
    );
}
