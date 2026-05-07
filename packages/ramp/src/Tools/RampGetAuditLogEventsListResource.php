<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Get audit log events.
 *
 * Maps to the official Ramp endpoint get /developer/v1/audit-logs/events.
 */
class RampGetAuditLogEventsListResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_audit_log_events_list_resource';
    protected const DESCRIPTION = 'Get audit log events

Official Ramp endpoint: GET /developer/v1/audit-logs/events';
    protected const PARAMETERS = array (
  'user_ids' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `user_ids` from the official Ramp API operation.',
  ),
  'from_date' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `from_date` from the official Ramp API operation.',
  ),
  'to_date' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `to_date` from the official Ramp API operation.',
  ),
  'event_actor_types' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `event_actor_types` from the official Ramp API operation.',
  ),
  'event_types' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `event_types` from the official Ramp API operation.',
  ),
  'object_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `object_id` from the official Ramp API operation.',
  ),
  'resource_name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `resource_name` from the official Ramp API operation.',
    'enum' =>
    array (
      0 => 'Approvals',
      1 => 'Bill payment',
      2 => 'Bill template',
      3 => 'Card',
      4 => 'Cash Manager recommendation',
      5 => 'Forecast custom input',
      6 => 'Fund request',
      7 => 'Investment account',
      8 => 'Managed portfolio transfer',
      9 => 'Payment run',
      10 => 'Reimbursement',
      11 => 'SFTP Configurations',
      12 => 'Separation of duties',
      13 => 'Spend allocation',
      14 => 'Spend event',
      15 => 'Transaction',
      16 => 'Travel (Booking request)',
      17 => 'Travel (Trip)',
      18 => 'Treasury account',
      19 => 'User',
      20 => 'Vendor / Merchant',
      21 => 'WBX Policy',
      22 => 'WBX Request',
      23 => 'Wallet automation policy',
      24 => 'Wallet transfer',
      25 => 'Workflow (Base)',
      26 => 'Workflow',
    ),
  ),
  'start' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `start` from the official Ramp API operation.',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `page_size` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/audit-logs/events';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'user_ids' => 'user_ids',
  'from_date' => 'from_date',
  'to_date' => 'to_date',
  'event_actor_types' => 'event_actor_types',
  'event_types' => 'event_types',
  'object_id' => 'object_id',
  'resource_name' => 'resource_name',
  'start' => 'start',
  'page_size' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
