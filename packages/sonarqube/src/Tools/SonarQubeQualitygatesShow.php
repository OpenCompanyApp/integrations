<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Display the details of a quality gate.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/qualitygates/show.
 */
class SonarQubeQualitygatesShow extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_qualitygates_show';
    protected const DESCRIPTION = 'Display the details of a quality gate

Official SonarQube Web API endpoint: GET /api/qualitygates/show.';
    protected const PARAMETERS = array (
      'name' => array (
        'type' => 'string',
        'description' => 'Name of the quality gate. Either id or name must be set',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/qualitygates/show';
    protected const PARAM_MAP = array (
      'name' => 'name',
    );
}
