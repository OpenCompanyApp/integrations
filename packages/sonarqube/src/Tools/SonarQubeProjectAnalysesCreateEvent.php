<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Create a project analysis event. Only event of category 'VERSION' and 'OTHER' can be created. Requires one of the following permissions: - 'Administer System'; - 'Administer' rights on the specified project;.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/project_analyses/create_event.
 */
class SonarQubeProjectAnalysesCreateEvent extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_project_analyses_create_event';
    protected const DESCRIPTION = 'Create a project analysis event. Only event of category \'VERSION\' and \'OTHER\' can be created. Requires one of the following permissions: - \'Administer System\'; - \'Administer\' rights on the specified project;

Official SonarQube Web API endpoint: POST /api/project_analyses/create_event.';
    protected const PARAMETERS = array (
      'analysis' => array (
        'type' => 'string',
        'description' => 'Analysis key',
        'required' => true,
      ),
      'category' => array (
        'type' => 'string',
        'description' => 'Category',
        'required' => false,
        'enum' => array (
          'VERSION',
          'OTHER',
        ),
      ),
      'name' => array (
        'type' => 'string',
        'description' => 'Name',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/project_analyses/create_event';
    protected const PARAM_MAP = array (
      'analysis' => 'analysis',
      'category' => 'category',
      'name' => 'name',
    );
}
