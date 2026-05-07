<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Retrieve a token to use for project or application badge access for private projects or applications. This token can be used to authenticate with api/project_badges/quality_gate and api/project_badges/measure endpoints. Requires 'Browse' permission on the specified project or application. If the 'sonar.forceAuthentication' setting is enabled, then a token is required for public projects as well..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/project_badges/token.
 */
class SonarQubeProjectBadgesToken extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_project_badges_token';
    protected const DESCRIPTION = 'Retrieve a token to use for project or application badge access for private projects or applications. This token can be used to authenticate with api/project_badges/quality_gate and api/project_badges/measure endpoints. Requires \'Browse\' permission on the specified project or application. If the \'sonar.forceAuthentication\' setting is enabled, then a token is required for public projects as well.

Official SonarQube Web API endpoint: GET /api/project_badges/token.';
    protected const PARAMETERS = array (
      'project' => array (
        'type' => 'string',
        'description' => 'Project or application key',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/project_badges/token';
    protected const PARAM_MAP = array (
      'project' => 'project',
    );
}
