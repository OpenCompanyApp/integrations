<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * This web service is deprecated, please use api/settings/values instead..
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/properties/index.
 */
class SonarCloudPropertiesIndex extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_properties_index';
    protected const DESCRIPTION = 'This web service is deprecated, please use api/settings/values instead.

Official SonarCloud Web API endpoint: GET /api/properties/index.

Deprecated since SonarCloud 6.3; kept for API parity while the official registry still exposes it.';
    protected const PARAMETERS = array (
      'format' => array (
        'type' => 'string',
        'description' => 'Only json response format is available',
        'required' => false,
        'enum' => array (
          'json',
        ),
      ),
      'id' => array (
        'type' => 'string',
        'description' => 'Setting key',
        'required' => false,
      ),
      'resource' => array (
        'type' => 'string',
        'description' => 'Component key or database id',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/properties/index';
    protected const PARAM_MAP = array (
      'format' => 'format',
      'id' => 'id',
      'resource' => 'resource',
    );
}
