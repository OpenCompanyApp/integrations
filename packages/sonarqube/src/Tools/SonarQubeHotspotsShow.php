<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Provides the details of a Security Hotspot..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/hotspots/show.
 */
class SonarQubeHotspotsShow extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_hotspots_show';
    protected const DESCRIPTION = 'Provides the details of a Security Hotspot.

Official SonarQube Web API endpoint: GET /api/hotspots/show.';
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
