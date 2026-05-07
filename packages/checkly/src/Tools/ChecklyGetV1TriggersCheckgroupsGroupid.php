<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * [DEPRECATED] This endpoint will be removed soon. Please use the Checkly CLI to test and trigger checks. Finds the check group trigger.
 *
 * Maps to the official Checkly endpoint GET /v1/triggers/check-groups/{groupId}.
 */
class ChecklyGetV1TriggersCheckgroupsGroupid extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_triggers_checkgroups_groupid';
    protected const DESCRIPTION = '[DEPRECATED] This endpoint will be removed soon. Please use the Checkly CLI to test and trigger checks. Finds the check group trigger

Official Checkly endpoint: GET /v1/triggers/check-groups/{groupId}.';
    protected const PARAMETERS = array (
      'group_id' => array (
        'type' => 'integer',
        'description' => 'groupId parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
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
