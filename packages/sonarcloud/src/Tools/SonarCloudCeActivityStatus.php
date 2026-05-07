<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Returns CE activity related metrics. Requires 'Administer' permission on the specified project..
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/ce/activity_status.
 */
class SonarCloudCeActivityStatus extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_ce_activity_status';
    protected const DESCRIPTION = 'Returns CE activity related metrics. Requires \'Administer\' permission on the specified project.

Official SonarCloud Web API endpoint: GET /api/ce/activity_status.';
    protected const PARAMETERS = array (
      'component_id' => array (
        'type' => 'string',
        'description' => 'Id of the component (project) to filter on',
        'required' => false,
      ),
      'component_key' => array (
        'type' => 'string',
        'description' => 'Key of the component (project) to filter on',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/ce/activity_status';
    protected const PARAM_MAP = array (
      'componentId' => 'component_id',
      'componentKey' => 'component_key',
    );
}
