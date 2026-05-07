<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Delete a project analysis event. Only event of category 'VERSION' and 'OTHER' can be deleted. Requires one of the following permissions: - 'Administer System'; - 'Administer' rights on the specified project;.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/project_analyses/delete_event.
 */
class SonarQubeProjectAnalysesDeleteEvent extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_project_analyses_delete_event';
    protected const DESCRIPTION = 'Delete a project analysis event. Only event of category \'VERSION\' and \'OTHER\' can be deleted. Requires one of the following permissions: - \'Administer System\'; - \'Administer\' rights on the specified project;

Official SonarQube Web API endpoint: POST /api/project_analyses/delete_event.';
    protected const PARAMETERS = array (
      'event' => array (
        'type' => 'string',
        'description' => 'Event key',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/project_analyses/delete_event';
    protected const PARAM_MAP = array (
      'event' => 'event',
    );
}
