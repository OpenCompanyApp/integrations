<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * List the groups that are allowed to edit a Quality Gate. Requires one of the following permissions: - 'Administer Quality Gates'; - Edit right on the specified quality gate;.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/qualitygates/search_groups.
 */
class SonarQubeQualitygatesSearchGroups extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_qualitygates_search_groups';
    protected const DESCRIPTION = 'List the groups that are allowed to edit a Quality Gate. Requires one of the following permissions: - \'Administer Quality Gates\'; - Edit right on the specified quality gate;

Official SonarQube Web API endpoint: GET /api/qualitygates/search_groups.';
    protected const PARAMETERS = array (
      'gate_name' => array (
        'type' => 'string',
        'description' => 'Quality Gate name',
        'required' => true,
      ),
      'p' => array (
        'type' => 'string',
        'description' => '1-based page number',
        'required' => false,
      ),
      'ps' => array (
        'type' => 'string',
        'description' => 'Page size. Must be greater than 0.',
        'required' => false,
      ),
      'q' => array (
        'type' => 'string',
        'description' => 'Limit search to group names that contain the supplied string.',
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
    protected const PATH = '/api/qualitygates/search_groups';
    protected const PARAM_MAP = array (
      'gateName' => 'gate_name',
      'p' => 'p',
      'ps' => 'ps',
      'q' => 'q',
      'selected' => 'selected',
    );
}
