<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Get the quality gate of a project. Requires one of the following permissions:- 'Administer System'; - 'Administer' rights on the specified project; - 'Browse' on the specified project;.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/qualitygates/get_by_project.
 */
class SonarQubeQualitygatesGetByProject extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_qualitygates_get_by_project';
    protected const DESCRIPTION = 'Get the quality gate of a project. Requires one of the following permissions:- \'Administer System\'; - \'Administer\' rights on the specified project; - \'Browse\' on the specified project;

Official SonarQube Web API endpoint: GET /api/qualitygates/get_by_project.';
    protected const PARAMETERS = array (
      'project' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/qualitygates/get_by_project';
    protected const PARAM_MAP = array (
      'project' => 'project',
    );
}
