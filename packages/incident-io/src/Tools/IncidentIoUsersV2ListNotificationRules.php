<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * ListNotificationRules Users V2.
 *
 * Maps to the official incident.io endpoint get /v2/users/{user_id}/notification_rules.
 */
class IncidentIoUsersV2ListNotificationRules extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_users_v2_list_notification_rules';
    protected const DESCRIPTION = 'ListNotificationRules Users V2

Official incident.io endpoint: GET /v2/users/{user_id}/notification_rules

List notification rules for a user. Rules define how and when a user is notified for on-call pages. Only includes high_urgency and low_urgency rules; shift_changes rules are not returned.';
    protected const PARAMETERS = array (
  'user_id' =>
  array (
    'type' => 'string',
    'description' => 'The ID of the user whose notification rules you want to list.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/users/{user_id}/notification_rules';
    protected const PATH_PARAMS = array (
  'user_id' => 'user_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
