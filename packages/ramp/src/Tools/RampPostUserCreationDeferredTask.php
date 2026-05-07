<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Create a user invite.
 *
 * Maps to the official Ramp endpoint post /developer/v1/users/deferred.
 */
class RampPostUserCreationDeferredTask extends AbstractRampTool
{
    protected const NAME = 'ramp_post_user_creation_deferred_task';
    protected const DESCRIPTION = 'Create a user invite

Official Ramp endpoint: POST /developer/v1/users/deferred

Call this endpoint to trigger an async task to send out a user invite via email. Users will need to accept the invite in order to be onboarded. Assign a user to a specific entity by specifying a `location_id` on creation. Locations are mapped to entities with a many-to-one relationship.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/users/deferred';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
