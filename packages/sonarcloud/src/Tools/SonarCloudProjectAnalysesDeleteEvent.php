<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Delete a project analysis event. Only event of category 'VERSION' and 'OTHER' can be deleted. Requires the permission 'Administer' on the specified project..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/project_analyses/delete_event.
 */
class SonarCloudProjectAnalysesDeleteEvent extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_project_analyses_delete_event';
    protected const DESCRIPTION = 'Delete a project analysis event. Only event of category \'VERSION\' and \'OTHER\' can be deleted. Requires the permission \'Administer\' on the specified project.

Official SonarCloud Web API endpoint: POST /api/project_analyses/delete_event.';
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
