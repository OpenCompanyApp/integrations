<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * List settings values. If no value has been set for a setting, then the default value is returned. Both component and organization parameters cannot be used together. Requires 'Browse' or 'Execute Analysis' permission when a component is specified. Requires to be member of the organization if one is specified. To access secured settings, one of the following permissions is required: 'Execute Analysis' or 'Administer' rights on the specified component The returned attributes are:- 'key': The key of the setting; - 'value': The value of setting; - 'inherited': True if the value is being inherited from a parent setting; - 'parentValue: The value of the parent setting if the value is not inherited'; - 'parentOrigin: The origin of the parentValue (INSTANCE, ORGANIZATION, PROJECT)';.
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/settings/values.
 */
class SonarCloudSettingsValues extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_settings_values';
    protected const DESCRIPTION = 'List settings values. If no value has been set for a setting, then the default value is returned. Both component and organization parameters cannot be used together. Requires \'Browse\' or \'Execute Analysis\' permission when a component is specified. Requires to be member of the organization if one is specified. To access secured settings, one of the following permissions is required: \'Execute Analysis\' or \'Administer\' rights on the specified component The returned attributes are:- \'key\': The key of the setting; - \'value\': The value of setting; - \'inherited\': True if the value is being inherited from a parent setting; - \'parentValue: The value of the parent setting if the value is not inherited\'; - \'parentOrigin: The origin of the parentValue (INSTANCE, ORGANIZATION, PROJECT)\';

Official SonarCloud Web API endpoint: GET /api/settings/values.';
    protected const PARAMETERS = array (
      'component' => array (
        'type' => 'string',
        'description' => 'Component key',
        'required' => false,
      ),
      'keys' => array (
        'type' => 'string',
        'description' => 'List of setting keys',
        'required' => false,
      ),
      'organization' => array (
        'type' => 'string',
        'description' => 'Organization key',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/settings/values';
    protected const PARAM_MAP = array (
      'component' => 'component',
      'keys' => 'keys',
      'organization' => 'organization',
    );
}
