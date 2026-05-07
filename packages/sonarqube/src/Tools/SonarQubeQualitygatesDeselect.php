<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Remove the association of a project from a quality gate. Requires one of the following permissions:- 'Administer Quality Gates'; - 'Administer' rights on the project;.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/qualitygates/deselect.
 */
class SonarQubeQualitygatesDeselect extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_qualitygates_deselect';
    protected const DESCRIPTION = 'Remove the association of a project from a quality gate. Requires one of the following permissions:- \'Administer Quality Gates\'; - \'Administer\' rights on the project;

Official SonarQube Web API endpoint: POST /api/qualitygates/deselect.';
    protected const PARAMETERS = array (
      'project_key' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/qualitygates/deselect';
    protected const PARAM_MAP = array (
      'projectKey' => 'project_key',
    );
}
