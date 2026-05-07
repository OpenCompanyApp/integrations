<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Shows the new code definition. If the component requested doesn't exist or if no new code definition is set for it, a value is inherited from the project or from the global setting.Requires one of the following permissions if a component is specified: - 'Administer' rights on the specified component; - 'Execute analysis' rights on the specified component;.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/new_code_periods/show.
 */
class SonarQubeNewCodePeriodsShow extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_new_code_periods_show';
    protected const DESCRIPTION = 'Shows the new code definition. If the component requested doesn\'t exist or if no new code definition is set for it, a value is inherited from the project or from the global setting.Requires one of the following permissions if a component is specified: - \'Administer\' rights on the specified component; - \'Execute analysis\' rights on the specified component;

Official SonarQube Web API endpoint: GET /api/new_code_periods/show.';
    protected const PARAMETERS = array (
      'branch' => array (
        'type' => 'string',
        'description' => 'Branch key',
        'required' => false,
      ),
      'project' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/new_code_periods/show';
    protected const PARAM_MAP = array (
      'branch' => 'branch',
      'project' => 'project',
    );
}
