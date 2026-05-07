<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Registrations Delete.
 *
 * Maps to the official Google Classroom endpoint DELETE /v1/registrations/{registrationId}.
 */
class GoogleClassroomRegistrationsDelete extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_registrations_delete';
    protected const DESCRIPTION = 'Registrations Delete

Official Google Classroom endpoint: DELETE /v1/registrations/{registrationId}
Deletes a `Registration`, causing Classroom to stop sending notifications for that `Registration`.';
    protected const PARAMETERS = array (
  'registrationId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `registrationId`. Accepts the Google Classroom identifier used by the official API, such as a course ID, alias, user ID, email address, invitation ID, or submission ID.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/registrations/{registrationId}';
    protected const PATH_PARAMS = array (
  0 => 'registrationId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}