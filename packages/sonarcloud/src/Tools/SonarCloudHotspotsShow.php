<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Provides the details of a Security Hotspot..
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/hotspots/show.
 */
class SonarCloudHotspotsShow extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_hotspots_show';
    protected const DESCRIPTION = 'Provides the details of a Security Hotspot.

Official SonarCloud Web API endpoint: GET /api/hotspots/show.';
    protected const PARAMETERS = array (
      'hotspot' => array (
        'type' => 'string',
        'description' => 'Key of the Security Hotspot',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/hotspots/show';
    protected const PARAM_MAP = array (
      'hotspot' => 'hotspot',
    );
}
