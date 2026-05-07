<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Delete a Quality Gate. Requires the 'Administer Quality Gates' permission..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/qualitygates/destroy.
 */
class SonarCloudQualitygatesDestroy extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_qualitygates_destroy';
    protected const DESCRIPTION = 'Delete a Quality Gate. Requires the \'Administer Quality Gates\' permission.

Official SonarCloud Web API endpoint: POST /api/qualitygates/destroy.

Deprecated since SonarCloud 16 September, 2025; kept for API parity while the official registry still exposes it.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'string',
        'description' => 'ID of the quality gate to delete',
        'required' => true,
      ),
      'organization' => array (
        'type' => 'string',
        'description' => 'Organization key.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/qualitygates/destroy';
    protected const PARAM_MAP = array (
      'id' => 'id',
      'organization' => 'organization',
    );
}
