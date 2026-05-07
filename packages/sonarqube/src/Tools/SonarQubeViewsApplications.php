<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * List applications which the user has access to that can be added to a portfolio. Authentication is required for this API endpoint.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/views/applications.
 */
class SonarQubeViewsApplications extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_views_applications';
    protected const DESCRIPTION = 'List applications which the user has access to that can be added to a portfolio. Authentication is required for this API endpoint

Official SonarQube Web API endpoint: GET /api/views/applications.';
    protected const PARAMETERS = array (
      'portfolio' => array (
        'type' => 'string',
        'description' => 'Key of the would-be parent portfolio',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/views/applications';
    protected const PARAM_MAP = array (
      'portfolio' => 'portfolio',
    );
}
