<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Creates a new check group. You can add checks to the group by setting the "groupId" property of individual checks..
 *
 * Maps to the official Checkly endpoint POST /v2/check-groups.
 */
class ChecklyPostV2Checkgroups extends AbstractChecklyTool
{
    protected const NAME = 'checkly_post_v2_checkgroups';
    protected const DESCRIPTION = 'Creates a new check group. You can add checks to the group by setting the "groupId" property of individual checks.

Official Checkly endpoint: POST /v2/check-groups.';
    protected const PARAMETERS = array (
      'auto_assign_alerts' => array (
        'type' => 'boolean',
        'description' => 'Determines whether a new check will automatically be added as a subscriber to all existing alert channels when it gets created.',
        'required' => false,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the Checkly API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v2/check-groups';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
      'autoAssignAlerts' => 'auto_assign_alerts',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
