<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Updates visibility of a project, application or a portfolio. Requires 'Project administer' permission on the specified entity.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/projects/update_visibility.
 */
class SonarQubeProjectsUpdateVisibility extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_projects_update_visibility';
    protected const DESCRIPTION = 'Updates visibility of a project, application or a portfolio. Requires \'Project administer\' permission on the specified entity

Official SonarQube Web API endpoint: POST /api/projects/update_visibility.';
    protected const PARAMETERS = array (
      'project' => array (
        'type' => 'string',
        'description' => 'Project, application or portfolio key',
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
