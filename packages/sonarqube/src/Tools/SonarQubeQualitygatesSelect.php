<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Associate a project to a quality gate. Requires one of the following permissions: - 'Administer Quality Gates'; - 'Administer' right on the specified project;.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/qualitygates/select.
 */
class SonarQubeQualitygatesSelect extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_qualitygates_select';
    protected const DESCRIPTION = 'Associate a project to a quality gate. Requires one of the following permissions: - \'Administer Quality Gates\'; - \'Administer\' right on the specified project;

Official SonarQube Web API endpoint: POST /api/qualitygates/select.';
    protected const PARAMETERS = array (
      'gate_name' => array (
        'type' => 'string',
        'description' => 'Name of the quality gate',
        'required' => true,
      ),
      'project_key' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/qualitygates/select';
    protected const PARAM_MAP = array (
      'gateName' => 'gate_name',
      'projectKey' => 'project_key',
    );
}
