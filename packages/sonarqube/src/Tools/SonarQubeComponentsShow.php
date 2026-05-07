<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Returns a component (file, directory, project, portfolio…) and its ancestors. The ancestors are ordered from the parent to the root project. Requires the following permission: 'Browse' on the project of the specified component..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/components/show.
 */
class SonarQubeComponentsShow extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_components_show';
    protected const DESCRIPTION = 'Returns a component (file, directory, project, portfolio…) and its ancestors. The ancestors are ordered from the parent to the root project. Requires the following permission: \'Browse\' on the project of the specified component.

Official SonarQube Web API endpoint: GET /api/components/show.';
    protected const PARAMETERS = array (
      'branch' => array (
        'type' => 'string',
        'description' => 'Branch key. Not available in the community edition.',
        'required' => false,
      ),
      'component' => array (
        'type' => 'string',
        'description' => 'Component key',
        'required' => true,
      ),
      'pull_request' => array (
        'type' => 'string',
        'description' => 'Pull request id. Not available in the community edition.',
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
