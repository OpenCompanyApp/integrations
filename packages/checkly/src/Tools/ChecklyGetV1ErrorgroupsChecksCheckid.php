<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * List all error groups for a specific check..
 *
 * Maps to the official Checkly endpoint GET /v1/error-groups/checks/{checkId}.
 */
class ChecklyGetV1ErrorgroupsChecksCheckid extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_errorgroups_checks_checkid';
    protected const DESCRIPTION = 'List all error groups for a specific check.

Official Checkly endpoint: GET /v1/error-groups/checks/{checkId}.';
    protected const PARAMETERS = array (
      'check_id' => array (
        'type' => 'string',
        'description' => 'checkId parameter.',
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
    protected const PATH = '/v1/error-groups/checks/{checkId}';
    protected const PATH_PARAMS = array (
      'checkId' => 'check_id',
    );
    protected const QUERY_PARAMS = array (
      'limit' => 'limit',
      'page' => 'page',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
