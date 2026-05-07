<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Updates visibility of a project. Requires 'Project administer' permission on the specified project.
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/projects/update_visibility.
 */
class SonarCloudProjectsUpdateVisibility extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_projects_update_visibility';
    protected const DESCRIPTION = 'Updates visibility of a project. Requires \'Project administer\' permission on the specified project

Official SonarCloud Web API endpoint: POST /api/projects/update_visibility.';
    protected const PARAMETERS = array (
      'project' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => true,
      ),
      'visibility' => array (
        'type' => 'string',
        'description' => 'New visibility',
        'required' => true,
        'enum' => array (
          'private',
          'public',
        ),
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/projects/update_visibility';
    protected const PARAM_MAP = array (
      'project' => 'project',
      'visibility' => 'visibility',
    );
}
