<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Create a Quality Gate. Requires the 'Administer Quality Gates' permission..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/qualitygates/create.
 */
class SonarCloudQualitygatesCreate extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_qualitygates_create';
    protected const DESCRIPTION = 'Create a Quality Gate. Requires the \'Administer Quality Gates\' permission.

Official SonarCloud Web API endpoint: POST /api/qualitygates/create.

Deprecated since SonarCloud 16 September, 2025; kept for API parity while the official registry still exposes it.';
    protected const PARAMETERS = array (
      'name' => array (
        'type' => 'string',
        'description' => 'The name of the quality gate to create',
        'required' => true,
      ),
      'organization' => array (
        'type' => 'string',
        'description' => 'Organization key.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/qualitygates/create';
    protected const PARAM_MAP = array (
      'name' => 'name',
      'organization' => 'organization',
    );
}
