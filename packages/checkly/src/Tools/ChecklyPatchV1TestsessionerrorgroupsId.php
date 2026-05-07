<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Update a test session error group. Mainly used for archiving test session error groups..
 *
 * Maps to the official Checkly endpoint PATCH /v1/test-session-error-groups/{id}.
 */
class ChecklyPatchV1TestsessionerrorgroupsId extends AbstractChecklyTool
{
    protected const NAME = 'checkly_patch_v1_testsessionerrorgroups_id';
    protected const DESCRIPTION = 'Update a test session error group. Mainly used for archiving test session error groups.

Official Checkly endpoint: PATCH /v1/test-session-error-groups/{id}.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'string',
        'description' => 'id parameter.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the Checkly API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/test-session-error-groups/{id}';
    protected const PATH_PARAMS = array (
      'id' => 'id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
