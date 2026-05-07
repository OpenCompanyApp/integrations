<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Remove an entry from a Radar list.
 *
 * Maps to the official WorkOS endpoint delete /radar/lists/{type}/{action}.
 */
class WorkOSRadarStandaloneDeleteRadarListEntry extends AbstractWorkOSTool
{
    protected const NAME = 'workos_radar_standalone_delete_radar_list_entry';
    protected const DESCRIPTION = 'Remove an entry from a Radar list

Official WorkOS endpoint: DELETE /radar/lists/{type}/{action}

Remove an entry from a Radar list.';
    protected const PARAMETERS = array (
  'type' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `type` from the official WorkOS API operation.',
    'enum' =>
    array (
      0 => 'ip_address',
      1 => 'domain',
      2 => 'email',
      3 => 'device',
      4 => 'user_agent',
      5 => 'device_fingerprint',
      6 => 'country',
    ),
  ),
  'action' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `action` from the official WorkOS API operation.',
    'enum' =>
    array (
      0 => 'block',
      1 => 'allow',
    ),
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/radar/lists/{type}/{action}';
    protected const PATH_PARAMS = array (
  'type' => 'type',
  'action' => 'action',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
