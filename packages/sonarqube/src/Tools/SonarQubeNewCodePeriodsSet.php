<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Updates the new code definition on different levels: - Not providing a project key and a branch key will update the default value at global level. Existing projects or branches having a specific new code definition will not be impacted; - Project key must be provided to update the value for a project; - Both project and branch keys must be provided to update the value for a branch; Requires one of the following permissions: - 'Administer System' to change the global setting; - 'Administer' rights on the specified project to change the project setting;.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/new_code_periods/set.
 */
class SonarQubeNewCodePeriodsSet extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_new_code_periods_set';
    protected const DESCRIPTION = 'Updates the new code definition on different levels: - Not providing a project key and a branch key will update the default value at global level. Existing projects or branches having a specific new code definition will not be impacted; - Project key must be provided to update the value for a project; - Both project and branch keys must be provided to update the value for a branch; Requires one of the following permissions: - \'Administer System\' to change the global setting; - \'Administer\' rights on the specified project to change the project setting;

Official SonarQube Web API endpoint: POST /api/new_code_periods/set.';
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
      'type' => array (
        'type' => 'string',
        'description' => 'Type New code definitions of the following types are allowed:- SPECIFIC_ANALYSIS - can be set at branch level only; - PREVIOUS_VERSION - can be set at any level (global, project, branch); - NUMBER_OF_DAYS - can be set at any level (global, project, branch); - REFERENCE_BRANCH - can only be set for projects and branches;',
        'required' => true,
      ),
      'value' => array (
        'type' => 'string',
        'description' => 'Value For each type, a different value is expected:- the uuid of an analysis, when type is SPECIFIC_ANALYSIS; - no value, when type is PREVIOUS_VERSION; - a number between 1 and 90, when type is NUMBER_OF_DAYS; - a string, when type is REFERENCE_BRANCH;',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/new_code_periods/set';
    protected const PARAM_MAP = array (
      'branch' => 'branch',
      'project' => 'project',
      'type' => 'type',
      'value' => 'value',
    );
}
