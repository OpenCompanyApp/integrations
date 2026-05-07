<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * [DEPRECATED] This endpoint will be removed soon. Please use the Checkly CLI to test and trigger checks. Deletes the check trigger.
 *
 * Maps to the official Checkly endpoint DELETE /v1/triggers/checks/{checkId}.
 */
class ChecklyDeleteV1TriggersChecksCheckid extends AbstractChecklyTool
{
    protected const NAME = 'checkly_delete_v1_triggers_checks_checkid';
    protected const DESCRIPTION = '[DEPRECATED] This endpoint will be removed soon. Please use the Checkly CLI to test and trigger checks. Deletes the check trigger

Official Checkly endpoint: DELETE /v1/triggers/checks/{checkId}.';
    protected const PARAMETERS = array (
      'check_id' => array (
        'type' => 'string',
        'description' => 'checkId parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/triggers/checks/{checkId}';
    protected const PATH_PARAMS = array (
      'checkId' => 'check_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
