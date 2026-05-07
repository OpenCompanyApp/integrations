<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Delete a condition from a quality gate. Requires the 'Administer Quality Gates' permission..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/qualitygates/delete_condition.
 */
class SonarCloudQualitygatesDeleteCondition extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_qualitygates_delete_condition';
    protected const DESCRIPTION = 'Delete a condition from a quality gate. Requires the \'Administer Quality Gates\' permission.

Official SonarCloud Web API endpoint: POST /api/qualitygates/delete_condition.

Deprecated since SonarCloud 16 September, 2025; kept for API parity while the official registry still exposes it.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'string',
        'description' => 'Condition ID',
        'required' => true,
      ),
      'organization' => array (
        'type' => 'string',
        'description' => 'Organization key.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/qualitygates/delete_condition';
    protected const PARAM_MAP = array (
      'id' => 'id',
      'organization' => 'organization',
    );
}
