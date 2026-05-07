<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Copy a Quality Gate. Requires the 'Administer Quality Gates' permission..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/qualitygates/copy.
 */
class SonarCloudQualitygatesCopy extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_qualitygates_copy';
    protected const DESCRIPTION = 'Copy a Quality Gate. Requires the \'Administer Quality Gates\' permission.

Official SonarCloud Web API endpoint: POST /api/qualitygates/copy.

Deprecated since SonarCloud 16 September, 2025; kept for API parity while the official registry still exposes it.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'string',
        'description' => 'The ID of the source quality gate',
        'required' => true,
      ),
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
    protected const PATH = '/api/qualitygates/copy';
    protected const PARAM_MAP = array (
      'id' => 'id',
      'name' => 'name',
      'organization' => 'organization',
    );
}
