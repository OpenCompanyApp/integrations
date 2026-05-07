<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Creates new token replacing any existing token for project or application badge access for private projects and applications. This token can be used to authenticate with api/project_badges/quality_gate and api/project_badges/measure endpoints. Requires 'Administer' permission on the specified project or application. If the 'sonar.forceAuthentication' setting is enabled, then a token is required for public projects as well..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/project_badges/renew_token.
 */
class SonarQubeProjectBadgesRenewToken extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_project_badges_renew_token';
    protected const DESCRIPTION = 'Creates new token replacing any existing token for project or application badge access for private projects and applications. This token can be used to authenticate with api/project_badges/quality_gate and api/project_badges/measure endpoints. Requires \'Administer\' permission on the specified project or application. If the \'sonar.forceAuthentication\' setting is enabled, then a token is required for public projects as well.

Official SonarQube Web API endpoint: POST /api/project_badges/renew_token.';
    protected const PARAMETERS = array (
      'project' => array (
        'type' => 'string',
        'description' => 'Project or application key',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/project_badges/renew_token';
    protected const PARAM_MAP = array (
      'project' => 'project',
    );
}
