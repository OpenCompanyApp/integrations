<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Send User Account Session Event.
 *
 * Maps to the official Plaid endpoint post /user_account/session/event/send.
 */
class PlaidUserAccountSessionEventSend extends AbstractPlaidTool
{
    protected const NAME = 'plaid_user_account_session_event_send';
    protected const DESCRIPTION = 'Send User Account Session Event

Official Plaid endpoint: POST /user_account/session/event/send

This endpoint allows sending client-specific events related to Layer sessions for analytics and tracking purposes.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/user_account/session/event/send';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}