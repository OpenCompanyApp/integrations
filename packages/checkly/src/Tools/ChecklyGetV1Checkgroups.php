<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Lists all current check groups in your account. The "checks" property is an array of check UUID's for convenient referencing. It is read only and you cannot use it to add checks to a group..
 *
 * Maps to the official Checkly endpoint GET /v1/check-groups.
 */
class ChecklyGetV1Checkgroups extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_checkgroups';
    protected const DESCRIPTION = 'Lists all current check groups in your account. The "checks" property is an array of check UUID\'s for convenient referencing. It is read only and you cannot use it to add checks to a group.

Official Checkly endpoint: GET /v1/check-groups.';
    protected const PARAMETERS = array (
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
      'tag' => array (
        'type' => 'array',
        'description' => 'Filters check groups by tags. Returns check groups that have at least one of the specified tags.',
        'required' => false,
      ),
      'name' => array (
        'type' => 'array',
        'description' => 'Filters check groups by exact name match. Accepts one or more names and returns groups that match any of the specified names.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/check-groups';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
      'limit' => 'limit',
      'page' => 'page',
      'tag' => 'tag',
      'name' => 'name',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
