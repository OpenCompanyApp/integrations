<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Show details of a specific API or browser check.
 *
 * Maps to the official Checkly endpoint GET /v1/checks/{id}.
 */
class ChecklyGetV1ChecksId extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_checks_id';
    protected const DESCRIPTION = 'Show details of a specific API or browser check

Official Checkly endpoint: GET /v1/checks/{id}.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'string',
        'description' => 'id parameter.',
        'required' => true,
      ),
      'include_dependencies' => array (
        'type' => 'boolean',
        'description' => 'Include check dependencies in the response',
        'required' => false,
      ),
      'apply_group_settings' => array (
        'type' => 'boolean',
        'description' => 'Checks that belong to a group are returned with group settings applied.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/checks/{id}';
    protected const PATH_PARAMS = array (
      'id' => 'id',
    );
    protected const QUERY_PARAMS = array (
      'includeDependencies' => 'include_dependencies',
      'applyGroupSettings' => 'apply_group_settings',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
