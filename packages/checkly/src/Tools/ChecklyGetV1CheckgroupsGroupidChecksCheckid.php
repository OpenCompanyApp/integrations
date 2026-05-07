<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Show details of one check in a specific check group with the group settings applied..
 *
 * Maps to the official Checkly endpoint GET /v1/check-groups/{groupId}/checks/{checkId}.
 */
class ChecklyGetV1CheckgroupsGroupidChecksCheckid extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_checkgroups_groupid_checks_checkid';
    protected const DESCRIPTION = 'Show details of one check in a specific check group with the group settings applied.

Official Checkly endpoint: GET /v1/check-groups/{groupId}/checks/{checkId}.';
    protected const PARAMETERS = array (
      'group_id' => array (
        'type' => 'integer',
        'description' => 'groupId parameter.',
        'required' => true,
      ),
      'check_id' => array (
        'type' => 'string',
        'description' => 'checkId parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/check-groups/{groupId}/checks/{checkId}';
    protected const PATH_PARAMS = array (
      'groupId' => 'group_id',
      'checkId' => 'check_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
