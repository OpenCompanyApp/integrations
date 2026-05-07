<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Delete a project analysis. Requires one of the following permissions: - 'Administer System'; - 'Administer' rights on the project of the specified analysis;.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/project_analyses/delete.
 */
class SonarQubeProjectAnalysesDelete extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_project_analyses_delete';
    protected const DESCRIPTION = 'Delete a project analysis. Requires one of the following permissions: - \'Administer System\'; - \'Administer\' rights on the project of the specified analysis;

Official SonarQube Web API endpoint: POST /api/project_analyses/delete.';
    protected const PARAMETERS = array (
      'analysis' => array (
        'type' => 'string',
        'description' => 'Analysis key',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/project_analyses/delete';
    protected const PARAM_MAP = array (
      'analysis' => 'analysis',
    );
}
