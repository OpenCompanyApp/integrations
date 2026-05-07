<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Set tags on a application. Requires the following permission: 'Administer' rights on the specified application.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/applications/set_tags.
 */
class SonarQubeApplicationsSetTags extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_applications_set_tags';
    protected const DESCRIPTION = 'Set tags on a application. Requires the following permission: \'Administer\' rights on the specified application

Official SonarQube Web API endpoint: POST /api/applications/set_tags.';
    protected const PARAMETERS = array (
      'application' => array (
        'type' => 'string',
        'description' => 'Application key',
        'required' => true,
      ),
      'tags' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of tags',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/applications/set_tags';
    protected const PARAM_MAP = array (
      'application' => 'application',
      'tags' => 'tags',
    );
}
