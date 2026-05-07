<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * ListNotificationMethods Users V2.
 *
 * Maps to the official incident.io endpoint get /v2/users/{user_id}/notification_methods.
 */
class IncidentIoUsersV2ListNotificationMethods extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_users_v2_list_notification_methods';
    protected const DESCRIPTION = 'ListNotificationMethods Users V2

Official incident.io endpoint: GET /v2/users/{user_id}/notification_methods

List notification methods for a user. Phone numbers are always partially redacted.';
    protected const PARAMETERS = array (
  'user_id' =>
  array (
    'type' => 'string',
    'description' => 'The ID of the user whose notification methods you want to list.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/users/{user_id}/notification_methods';
    protected const PATH_PARAMS = array (
  'user_id' => 'user_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
