<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * List settings definitions. Requires 'Browse' permission when a component is specified To access licensed settings, authentication is required To access secured settings, one of the following permissions is required: - 'Execute Analysis'; - 'Administer' rights on the specified component;.
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/settings/list_definitions.
 */
class SonarCloudSettingsListDefinitions extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_settings_list_definitions';
    protected const DESCRIPTION = 'List settings definitions. Requires \'Browse\' permission when a component is specified To access licensed settings, authentication is required To access secured settings, one of the following permissions is required: - \'Execute Analysis\'; - \'Administer\' rights on the specified component;

Official SonarCloud Web API endpoint: GET /api/settings/list_definitions.';
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
