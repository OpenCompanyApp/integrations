<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Update a project analysis event. Only events of category 'VERSION' and 'OTHER' can be updated. Requires one of the following permissions: - 'Administer System'; - 'Administer' rights on the specified project;.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/project_analyses/update_event.
 */
class SonarQubeProjectAnalysesUpdateEvent extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_project_analyses_update_event';
    protected const DESCRIPTION = 'Update a project analysis event. Only events of category \'VERSION\' and \'OTHER\' can be updated. Requires one of the following permissions: - \'Administer System\'; - \'Administer\' rights on the specified project;

Official SonarQube Web API endpoint: POST /api/project_analyses/update_event.';
    protected const PARAMETERS = array (
      'event' => array (
        'type' => 'string',
        'description' => 'Event key',
        'required' => true,
      ),
      'name' => array (
        'type' => 'string',
        'description' => 'New name',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/project_analyses/update_event';
    protected const PARAM_MAP = array (
      'event' => 'event',
      'name' => 'name',
    );
}
