<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Add a project as favorite for the authenticated user. Only 100 components can be added as favorite. Requires authentication and the following permission: 'Browse' on the project..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/favorites/add.
 */
class SonarCloudFavoritesAdd extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_favorites_add';
    protected const DESCRIPTION = 'Add a project as favorite for the authenticated user. Only 100 components can be added as favorite. Requires authentication and the following permission: \'Browse\' on the project.

Official SonarCloud Web API endpoint: POST /api/favorites/add.';
    protected const PARAMETERS = array (
      'component' => array (
        'type' => 'string',
        'description' => 'Component key. Only components with qualifier TRK are supported',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/favorites/add';
    protected const PARAM_MAP = array (
      'component' => 'component',
    );
}
