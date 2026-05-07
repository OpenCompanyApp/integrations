<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Associate a project to a quality gate. The 'projectId' or 'projectKey' must be provided. Project id as a numeric value is deprecated since 6.1. Please use the id similar to 'AU-TpxcA-iU5OvuD2FLz'. Requires the 'Administer Quality Gates' permission..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/qualitygates/select.
 */
class SonarCloudQualitygatesSelect extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_qualitygates_select';
    protected const DESCRIPTION = 'Associate a project to a quality gate. The \'projectId\' or \'projectKey\' must be provided. Project id as a numeric value is deprecated since 6.1. Please use the id similar to \'AU-TpxcA-iU5OvuD2FLz\'. Requires the \'Administer Quality Gates\' permission.

Official SonarCloud Web API endpoint: POST /api/qualitygates/select.

Deprecated since SonarCloud 16 September, 2025; kept for API parity while the official registry still exposes it.';
    protected const PARAMETERS = array (
      'gate_id' => array (
        'type' => 'string',
        'description' => 'Quality gate id',
        'required' => true,
      ),
      'organization' => array (
        'type' => 'string',
        'description' => 'Organization key.',
        'required' => true,
      ),
      'project_id' => array (
        'type' => 'string',
        'description' => 'Project id. Project id as an numeric value is deprecated since 6.1',
        'required' => false,
      ),
      'project_key' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/qualitygates/select';
    protected const PARAM_MAP = array (
      'gateId' => 'gate_id',
      'organization' => 'organization',
      'projectId' => 'project_id',
      'projectKey' => 'project_key',
    );
}
