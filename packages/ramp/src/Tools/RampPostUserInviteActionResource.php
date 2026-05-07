<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Manage a user's invite lifecycle.
 *
 * Maps to the official Ramp endpoint post /developer/v1/users/{user_id}/invite.
 */
class RampPostUserInviteActionResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_user_invite_action_resource';
    protected const DESCRIPTION = 'Manage a user\'s invite lifecycle

Official Ramp endpoint: POST /developer/v1/users/{user_id}/invite

Performs one of three actions against a draft user, delegating to the Identity-owned invite / scheduled-invitation services: - `SCHEDULE`: Create or update a scheduled invitation at `invitation_time`. - `DESCHEDULE`: Cancel any pending scheduled invitation. - `SEND_NOW`: Immediately publish the draft invite and send the invite email. The user must be in DRAFT status for `SCHEDULE` and `SEND_NOW`. `DESCHEDULE` is a no-op if no pending scheduled invitation exists.';
    protected const PARAMETERS = array (
  'user_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `user_id` from the official Ramp API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/users/{user_id}/invite';
    protected const PATH_PARAMS = array (
  'user_id' => 'user_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
