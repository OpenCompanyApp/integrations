<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Search for projects associated (or not) to a quality gate. Only authorized projects for current user will be returned..
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/qualitygates/search.
 */
class SonarCloudQualitygatesSearch extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_qualitygates_search';
    protected const DESCRIPTION = 'Search for projects associated (or not) to a quality gate. Only authorized projects for current user will be returned.

Official SonarCloud Web API endpoint: GET /api/qualitygates/search.

Deprecated since SonarCloud 16 September, 2025; kept for API parity while the official registry still exposes it.';
    protected const PARAMETERS = array (
      'gate_id' => array (
        'type' => 'string',
        'description' => 'Quality Gate ID',
        'required' => true,
      ),
      'organization' => array (
        'type' => 'string',
        'description' => 'Organization key.',
        'required' => true,
      ),
      'page' => array (
        'type' => 'string',
        'description' => 'Page number',
        'required' => false,
      ),
      'page_size' => array (
        'type' => 'string',
        'description' => 'Page size',
        'required' => false,
      ),
      'query' => array (
        'type' => 'string',
        'description' => 'To search for projects containing this string. If this parameter is set, "selected" is set to "all".',
        'required' => false,
      ),
      'selected' => array (
        'type' => 'string',
        'description' => 'Depending on the value, show only selected items (selected=selected), deselected items (selected=deselected), or all items with their selection status (selected=all).',
        'required' => false,
        'enum' => array (
          'all',
          'deselected',
          'selected',
        ),
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/qualitygates/search';
    protected const PARAM_MAP = array (
      'gateId' => 'gate_id',
      'organization' => 'organization',
      'page' => 'page',
      'pageSize' => 'page_size',
      'query' => 'query',
      'selected' => 'selected',
    );
}
