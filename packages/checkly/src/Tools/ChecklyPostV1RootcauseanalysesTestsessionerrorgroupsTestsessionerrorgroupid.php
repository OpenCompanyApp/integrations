<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Asynchronously generates a root cause analysis for a specific test session error group. Returns an `id` which you can use to poll the `/root-cause-analyses/{id}` endpoint..
 *
 * Maps to the official Checkly endpoint POST /v1/root-cause-analyses/test-session-error-groups/{testSessionErrorGroupId}.
 */
class ChecklyPostV1RootcauseanalysesTestsessionerrorgroupsTestsessionerrorgroupid extends AbstractChecklyTool
{
    protected const NAME = 'checkly_post_v1_rootcauseanalyses_testsessionerrorgroups_testsessionerrorgroupid';
    protected const DESCRIPTION = 'Asynchronously generates a root cause analysis for a specific test session error group. Returns an `id` which you can use to poll the `/root-cause-analyses/{id}` endpoint.

Official Checkly endpoint: POST /v1/root-cause-analyses/test-session-error-groups/{testSessionErrorGroupId}.';
    protected const PARAMETERS = array (
      'test_session_error_group_id' => array (
        'type' => 'string',
        'description' => 'testSessionErrorGroupId parameter.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the Checkly API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v1/root-cause-analyses/test-session-error-groups/{testSessionErrorGroupId}';
    protected const PATH_PARAMS = array (
      'testSessionErrorGroupId' => 'test_session_error_group_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
