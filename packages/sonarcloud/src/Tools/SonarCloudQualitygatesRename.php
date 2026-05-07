<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Rename a Quality Gate. Requires the 'Administer Quality Gates' permission..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/qualitygates/rename.
 */
class SonarCloudQualitygatesRename extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_qualitygates_rename';
    protected const DESCRIPTION = 'Rename a Quality Gate. Requires the \'Administer Quality Gates\' permission.

Official SonarCloud Web API endpoint: POST /api/qualitygates/rename.

Deprecated since SonarCloud 16 September, 2025; kept for API parity while the official registry still exposes it.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'string',
        'description' => 'ID of the quality gate to rename',
        'required' => true,
      ),
      'name' => array (
        'type' => 'string',
        'description' => 'New name of the quality gate',
        'required' => true,
      ),
      'organization' => array (
        'type' => 'string',
        'description' => 'Organization key.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/qualitygates/rename';
    protected const PARAM_MAP = array (
      'id' => 'id',
      'name' => 'name',
      'organization' => 'organization',
    );
}
