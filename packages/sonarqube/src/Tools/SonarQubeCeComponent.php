<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Get the pending tasks, in-progress tasks and the last executed task of a given component (usually a project). Requires the following permission: 'Browse' on the specified component..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/ce/component.
 */
class SonarQubeCeComponent extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_ce_component';
    protected const DESCRIPTION = 'Get the pending tasks, in-progress tasks and the last executed task of a given component (usually a project). Requires the following permission: \'Browse\' on the specified component.

Official SonarQube Web API endpoint: GET /api/ce/component.';
    protected const PARAMETERS = array (
      'component' => array (
        'type' => 'string',
        'description' => 'component parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/ce/component';
    protected const PARAM_MAP = array (
      'component' => 'component',
    );
}
