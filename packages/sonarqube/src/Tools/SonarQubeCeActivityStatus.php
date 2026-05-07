<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Returns CE activity related metrics. Requires 'Administer System' permission or 'Administer' rights on the specified project..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/ce/activity_status.
 */
class SonarQubeCeActivityStatus extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_ce_activity_status';
    protected const DESCRIPTION = 'Returns CE activity related metrics. Requires \'Administer System\' permission or \'Administer\' rights on the specified project.

Official SonarQube Web API endpoint: GET /api/ce/activity_status.';
    protected const PARAMETERS = array (
      'component' => array (
        'type' => 'string',
        'description' => 'Key of the component (project) to filter on',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/ce/activity_status';
    protected const PARAM_MAP = array (
      'component' => 'component',
    );
}
