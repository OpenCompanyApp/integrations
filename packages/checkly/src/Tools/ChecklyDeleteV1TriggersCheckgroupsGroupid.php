<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * [DEPRECATED] This endpoint will be removed soon. Please use the Checkly CLI to test and trigger checks. Deletes the check groups trigger.
 *
 * Maps to the official Checkly endpoint DELETE /v1/triggers/check-groups/{groupId}.
 */
class ChecklyDeleteV1TriggersCheckgroupsGroupid extends AbstractChecklyTool
{
    protected const NAME = 'checkly_delete_v1_triggers_checkgroups_groupid';
    protected const DESCRIPTION = '[DEPRECATED] This endpoint will be removed soon. Please use the Checkly CLI to test and trigger checks. Deletes the check groups trigger

Official Checkly endpoint: DELETE /v1/triggers/check-groups/{groupId}.';
    protected const PARAMETERS = array (
      'group_id' => array (
        'type' => 'integer',
        'description' => 'groupId parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/triggers/check-groups/{groupId}';
    protected const PATH_PARAMS = array (
      'groupId' => 'group_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
