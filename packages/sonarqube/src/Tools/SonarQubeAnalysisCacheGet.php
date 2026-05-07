<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Get the scanner's cached data for a branch. Requires scan permission on the project. Data is returned gzipped if the corresponding 'Accept-Encoding' header is set in the request..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/analysis_cache/get.
 */
class SonarQubeAnalysisCacheGet extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_analysis_cache_get';
    protected const DESCRIPTION = 'Get the scanner\'s cached data for a branch. Requires scan permission on the project. Data is returned gzipped if the corresponding \'Accept-Encoding\' header is set in the request.

Official SonarQube Web API endpoint: GET /api/analysis_cache/get.';
    protected const PARAMETERS = array (
      'branch' => array (
        'type' => 'string',
        'description' => 'Branch key. If not provided, main branch will be used.',
        'required' => false,
      ),
      'project' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/analysis_cache/get';
    protected const PARAM_MAP = array (
      'branch' => 'branch',
      'project' => 'project',
    );
}
