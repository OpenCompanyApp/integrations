<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Get a list of quality gates.
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/qualitygates/list.
 */
class SonarCloudQualitygatesList extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_qualitygates_list';
    protected const DESCRIPTION = 'Get a list of quality gates

Official SonarCloud Web API endpoint: GET /api/qualitygates/list.

Deprecated since SonarCloud 16 September, 2025; kept for API parity while the official registry still exposes it.';
    protected const PARAMETERS = array (
      'organization' => array (
        'type' => 'string',
        'description' => 'Organization key.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/qualitygates/list';
    protected const PARAM_MAP = array (
      'organization' => 'organization',
    );
}
