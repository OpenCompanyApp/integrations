<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Returns an application and its associated projects. Requires the 'Browse' permission on the application and on its child projects..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/applications/show.
 */
class SonarQubeApplicationsShow extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_applications_show';
    protected const DESCRIPTION = 'Returns an application and its associated projects. Requires the \'Browse\' permission on the application and on its child projects.

Official SonarQube Web API endpoint: GET /api/applications/show.';
    protected const PARAMETERS = array (
      'application' => array (
        'type' => 'string',
        'description' => 'Application key',
        'required' => true,
      ),
      'branch' => array (
        'type' => 'string',
        'description' => 'Branch name',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/applications/show';
    protected const PARAM_MAP = array (
      'application' => 'application',
      'branch' => 'branch',
    );
}
