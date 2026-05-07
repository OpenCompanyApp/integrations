<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Search for projects associated (or not) to a quality gate. Only authorized projects for the current user will be returned..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/qualitygates/search.
 */
class SonarQubeQualitygatesSearch extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_qualitygates_search';
    protected const DESCRIPTION = 'Search for projects associated (or not) to a quality gate. Only authorized projects for the current user will be returned.

Official SonarQube Web API endpoint: GET /api/qualitygates/search.';
    protected const PARAMETERS = array (
      'gate_name' => array (
        'type' => 'string',
        'description' => 'Quality Gate name',
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
      'gateName' => 'gate_name',
      'page' => 'page',
      'pageSize' => 'page_size',
      'query' => 'query',
      'selected' => 'selected',
    );
}
