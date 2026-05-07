<?php

namespace OpenCompany\Integrations\Bitwarden\Tools;

/**
 * List all events.
 *
 * Maps to the official Bitwarden Public API endpoint get /public/events.
 */
class BitwardenEventsList extends AbstractBitwardenTool
{
    protected const NAME = 'bitwarden_events_list';
    protected const DESCRIPTION = 'List all events.

Official Bitwarden Public API endpoint: GET /public/events

Returns a filtered list of your organization\'s event logs, paged by a continuation token. If no filters are provided, it will return the last 30 days of event for the organization.';
    protected const PARAMETERS = array (
  'start' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The start date. Must be less than the end date.',
  ),
  'end' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The end date. Must be greater than the start date.',
  ),
  'acting_user_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The unique identifier of the user that performed the event.',
  ),
  'item_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The unique identifier of the related item that the event describes.',
  ),
  'secret_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The unique identifier of the related secret that the event describes.',
  ),
  'project_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The unique identifier of the related project that the event describes.',
  ),
  'continuation_token' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'A cursor for use in pagination.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/public/events';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'start' => 'start',
  'end' => 'end',
  'actingUserId' => 'acting_user_id',
  'itemId' => 'item_id',
  'secretId' => 'secret_id',
  'projectId' => 'project_id',
  'continuationToken' => 'continuation_token',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
