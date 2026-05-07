<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Returns a component (file, directory, project) and its ancestors. The ancestors are ordered from the parent to the root project. Requires the following permission: 'Browse' on the project of the specified component..
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/components/show.
 */
class SonarCloudComponentsShow extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_components_show';
    protected const DESCRIPTION = 'Returns a component (file, directory, project) and its ancestors. The ancestors are ordered from the parent to the root project. Requires the following permission: \'Browse\' on the project of the specified component.

Official SonarCloud Web API endpoint: GET /api/components/show.';
    protected const PARAMETERS = array (
      'branch' => array (
        'type' => 'string',
        'description' => 'Branch key',
        'required' => false,
      ),
      'component' => array (
        'type' => 'string',
        'description' => 'Component key',
        'required' => true,
      ),
      'pull_request' => array (
        'type' => 'string',
        'description' => 'Pull request id',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/components/show';
    protected const PARAM_MAP = array (
      'branch' => 'branch',
      'component' => 'component',
      'pullRequest' => 'pull_request',
    );
}
