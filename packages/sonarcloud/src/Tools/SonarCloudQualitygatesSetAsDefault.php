<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Set a quality gate as the default quality gate. Requires the 'Administer Quality Gates' permission..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/qualitygates/set_as_default.
 */
class SonarCloudQualitygatesSetAsDefault extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_qualitygates_set_as_default';
    protected const DESCRIPTION = 'Set a quality gate as the default quality gate. Requires the \'Administer Quality Gates\' permission.

Official SonarCloud Web API endpoint: POST /api/qualitygates/set_as_default.

Deprecated since SonarCloud 16 September, 2025; kept for API parity while the official registry still exposes it.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'string',
        'description' => 'ID of the quality gate to set as default',
        'required' => true,
      ),
      'organization' => array (
        'type' => 'string',
        'description' => 'Organization key.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/qualitygates/set_as_default';
    protected const PARAM_MAP = array (
      'id' => 'id',
      'organization' => 'organization',
    );
}
