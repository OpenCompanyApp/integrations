<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Lists the new code definition for all branches in a project. Requires the permission to browse the project.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/new_code_periods/list.
 */
class SonarQubeNewCodePeriodsList extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_new_code_periods_list';
    protected const DESCRIPTION = 'Lists the new code definition for all branches in a project. Requires the permission to browse the project

Official SonarQube Web API endpoint: GET /api/new_code_periods/list.';
    protected const PARAMETERS = array (
      'project' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/new_code_periods/list';
    protected const PARAM_MAP = array (
      'project' => 'project',
    );
}
