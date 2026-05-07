<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Retrieve one error group..
 *
 * Maps to the official Checkly endpoint GET /v1/error-groups/{id}.
 */
class ChecklyGetV1ErrorgroupsId extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_errorgroups_id';
    protected const DESCRIPTION = 'Retrieve one error group.

Official Checkly endpoint: GET /v1/error-groups/{id}.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'string',
        'description' => 'id parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/error-groups/{id}';
    protected const PATH_PARAMS = array (
      'id' => 'id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
