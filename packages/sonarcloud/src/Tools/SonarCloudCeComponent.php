<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Get the pending tasks, in-progress tasks and the last executed task of a given component (usually a project). Requires the following permission: 'Browse' on the specified component. Either 'componentId' or 'component' must be provided..
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/ce/component.
 */
class SonarCloudCeComponent extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_ce_component';
    protected const DESCRIPTION = 'Get the pending tasks, in-progress tasks and the last executed task of a given component (usually a project). Requires the following permission: \'Browse\' on the specified component. Either \'componentId\' or \'component\' must be provided.

Official SonarCloud Web API endpoint: GET /api/ce/component.';
    protected const PARAMETERS = array (
      'component' => array (
        'type' => 'string',
        'description' => 'component parameter.',
        'required' => false,
      ),
      'component_id' => array (
        'type' => 'string',
        'description' => 'componentId parameter.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/ce/component';
    protected const PARAM_MAP = array (
      'component' => 'component',
      'componentId' => 'component_id',
    );
}
