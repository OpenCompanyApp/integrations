<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * List projects with their association status regarding a quality profile. Only projects explicitly bound to the profile are returned, those associated with the profile because it is the default one are not. See api/qualityprofiles/search in order to get the Quality Profile Key..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/qualityprofiles/projects.
 */
class SonarQubeQualityprofilesProjects extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_qualityprofiles_projects';
    protected const DESCRIPTION = 'List projects with their association status regarding a quality profile. Only projects explicitly bound to the profile are returned, those associated with the profile because it is the default one are not. See api/qualityprofiles/search in order to get the Quality Profile Key.

Official SonarQube Web API endpoint: GET /api/qualityprofiles/projects.';
    protected const PARAMETERS = array (
      'key' => array (
        'type' => 'string',
        'description' => 'Quality profile key',
        'required' => true,
      ),
      'p' => array (
        'type' => 'string',
        'description' => '1-based page number',
        'required' => false,
      ),
      'ps' => array (
        'type' => 'string',
        'description' => 'Page size. Must be greater than 0 and less or equal than 500',
        'required' => false,
      ),
      'q' => array (
        'type' => 'string',
        'description' => 'Limit search to projects that contain the supplied string.',
        'required' => false,
      ),
      'selected' => array (
        'type' => 'string',
        'description' => 'Depending on the value, show only selected items (selected=selected), deselected items (selected=deselected), or all items with their selection status (selected=all).',
        'required' => false,
        'enum' => array (
          'all',
          'deselected',
          'selected',
        ),
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/qualityprofiles/projects';
    protected const PARAM_MAP = array (
      'key' => 'key',
      'p' => 'p',
      'ps' => 'ps',
      'q' => 'q',
      'selected' => 'selected',
    );
}
