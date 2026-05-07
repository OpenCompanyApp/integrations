<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Display the details of a quality gate.
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/qualitygates/show.
 */
class SonarCloudQualitygatesShow extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_qualitygates_show';
    protected const DESCRIPTION = 'Display the details of a quality gate

Official SonarCloud Web API endpoint: GET /api/qualitygates/show.

Deprecated since SonarCloud 16 September, 2025; kept for API parity while the official registry still exposes it.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'string',
        'description' => 'ID of the quality gate. Either id or name must be set',
        'required' => false,
      ),
      'name' => array (
        'type' => 'string',
        'description' => 'Name of the quality gate. Either id or name must be set',
        'required' => false,
      ),
      'organization' => array (
        'type' => 'string',
        'description' => 'Organization key.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/qualitygates/show';
    protected const PARAM_MAP = array (
      'id' => 'id',
      'name' => 'name',
      'organization' => 'organization',
    );
}
