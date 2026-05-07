<?php

namespace OpenCompany\Integrations\GoogleClassroom\Tools;

/**
 * Registrations Create.
 *
 * Maps to the official Google Classroom endpoint POST /v1/registrations.
 */
class GoogleClassroomRegistrationsCreate extends AbstractGoogleClassroomTool
{
    protected const NAME = 'google_classroom_registrations_create';
    protected const DESCRIPTION = 'Registrations Create

Official Google Classroom endpoint: POST /v1/registrations
Creates a `Registration`, causing Classroom to start sending notifications from the provided `feed` to the destination provided in `cloudPubSubTopic`.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Classroom `Registration` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/registrations';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}