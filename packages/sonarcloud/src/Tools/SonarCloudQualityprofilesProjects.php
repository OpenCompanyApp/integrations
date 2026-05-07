<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * List projects with their association status regarding a quality profile.
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/qualityprofiles/projects.
 */
class SonarCloudQualityprofilesProjects extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_qualityprofiles_projects';
    protected const DESCRIPTION = 'List projects with their association status regarding a quality profile

Official SonarCloud Web API endpoint: GET /api/qualityprofiles/projects.';
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
