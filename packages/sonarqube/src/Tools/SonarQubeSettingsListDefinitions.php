<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * List settings definitions. Requires 'Browse' permission when a component is specified To access licensed settings, authentication is required To access secured settings, one of the following permissions is required: - 'Execute Analysis'; - 'Administer System'; - 'Administer' rights on the specified component;.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/settings/list_definitions.
 */
class SonarQubeSettingsListDefinitions extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_settings_list_definitions';
    protected const DESCRIPTION = 'List settings definitions. Requires \'Browse\' permission when a component is specified To access licensed settings, authentication is required To access secured settings, one of the following permissions is required: - \'Execute Analysis\'; - \'Administer System\'; - \'Administer\' rights on the specified component;

Official SonarQube Web API endpoint: GET /api/settings/list_definitions.';
    protected const PARAMETERS = array (
      'component' => array (
        'type' => 'string',
        'description' => 'Component key',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/settings/list_definitions';
    protected const PARAM_MAP = array (
      'component' => 'component',
    );
}
