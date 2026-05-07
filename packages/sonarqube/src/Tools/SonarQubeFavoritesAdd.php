<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Add a component (project, portfolio, etc.) as favorite for the authenticated user. Only 100 components by qualifier can be added as favorite. Requires authentication and the following permission: 'Browse' on the component..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/favorites/add.
 */
class SonarQubeFavoritesAdd extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_favorites_add';
    protected const DESCRIPTION = 'Add a component (project, portfolio, etc.) as favorite for the authenticated user. Only 100 components by qualifier can be added as favorite. Requires authentication and the following permission: \'Browse\' on the component.

Official SonarQube Web API endpoint: POST /api/favorites/add.';
    protected const PARAMETERS = array (
      'component' => array (
        'type' => 'string',
        'description' => 'Component key. Only components with qualifiers TRK, VW, SVW, APP are supported',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/favorites/add';
    protected const PARAM_MAP = array (
      'component' => 'component',
    );
}
