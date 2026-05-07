<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Unsets the new code definition for a branch, project or global. It requires the inherited New Code Definition to be compatible with the Clean as You Code methodology, and one of the following permissions: - 'Administer System' to change the global setting; - 'Administer' rights for a specified component;.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/new_code_periods/unset.
 */
class SonarQubeNewCodePeriodsUnset extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_new_code_periods_unset';
    protected const DESCRIPTION = 'Unsets the new code definition for a branch, project or global. It requires the inherited New Code Definition to be compatible with the Clean as You Code methodology, and one of the following permissions: - \'Administer System\' to change the global setting; - \'Administer\' rights for a specified component;

Official SonarQube Web API endpoint: POST /api/new_code_periods/unset.';
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
    protected const METHOD = 'POST';
    protected const PATH = '/api/new_code_periods/unset';
    protected const PARAM_MAP = array (
      'branch' => 'branch',
      'project' => 'project',
    );
}
