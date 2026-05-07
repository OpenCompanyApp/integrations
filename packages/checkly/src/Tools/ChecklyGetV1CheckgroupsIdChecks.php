<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Lists all checks in a specific check group with the group settings applied..
 *
 * Maps to the official Checkly endpoint GET /v1/check-groups/{id}/checks.
 */
class ChecklyGetV1CheckgroupsIdChecks extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_checkgroups_id_checks';
    protected const DESCRIPTION = 'Lists all checks in a specific check group with the group settings applied.

Official Checkly endpoint: GET /v1/check-groups/{id}/checks.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'integer',
        'description' => 'id parameter.',
        'required' => true,
      ),
      'limit' => array (
        'type' => 'integer',
        'description' => 'Limit the number of results',
        'required' => false,
      ),
      'page' => array (
        'type' => 'number',
        'description' => 'Page number',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/check-groups/{id}/checks';
    protected const PATH_PARAMS = array (
      'id' => 'id',
    );
    protected const QUERY_PARAMS = array (
      'limit' => 'limit',
      'page' => 'page',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
