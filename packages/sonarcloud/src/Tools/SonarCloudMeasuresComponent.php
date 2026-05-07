<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Return component with specified measures. The componentId or the component parameter must be provided. Requires the following permission: 'Browse' on the project of specified component..
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/measures/component.
 */
class SonarCloudMeasuresComponent extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_measures_component';
    protected const DESCRIPTION = 'Return component with specified measures. The componentId or the component parameter must be provided. Requires the following permission: \'Browse\' on the project of specified component.

Official SonarCloud Web API endpoint: GET /api/measures/component.';
    protected const PARAMETERS = array (
      'additional_fields' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of additional fields that can be returned in the response.',
        'required' => false,
        'enum' => array (
          'metrics',
          'periods',
        ),
      ),
      'branch' => array (
        'type' => 'string',
        'description' => 'Branch key',
        'required' => false,
      ),
      'component' => array (
        'type' => 'string',
        'description' => 'Component key',
        'required' => false,
      ),
      'component_id' => array (
        'type' => 'string',
        'description' => 'Component id',
        'required' => false,
      ),
      'developer_id' => array (
        'type' => 'string',
        'description' => 'Deprecated parameter, used previously with the Developer Cockpit plugin. No measures are returned if parameter is set.',
        'required' => false,
      ),
      'developer_key' => array (
        'type' => 'string',
        'description' => 'Deprecated parameter, used previously with the Developer Cockpit plugin. No measures are returned if parameter is set.',
        'required' => false,
      ),
      'metric_keys' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of metric keys',
        'required' => true,
      ),
      'pull_request' => array (
        'type' => 'string',
        'description' => 'Pull request id',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/measures/component';
    protected const PARAM_MAP = array (
      'additionalFields' => 'additional_fields',
      'branch' => 'branch',
      'component' => 'component',
      'componentId' => 'component_id',
      'developerId' => 'developer_id',
      'developerKey' => 'developer_key',
      'metricKeys' => 'metric_keys',
      'pullRequest' => 'pull_request',
    );
}
