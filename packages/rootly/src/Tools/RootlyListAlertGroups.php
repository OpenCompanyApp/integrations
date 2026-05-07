<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List alert groups.
 *
 * Maps to the official Rootly endpoint get /v1/alert_groups.
 */
class RootlyListAlertGroups extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_alert_groups';
    protected const DESCRIPTION = 'List alert groups

Official Rootly endpoint: GET /v1/alert_groups

List alert groups';
    protected const PARAMETERS = array (
  'include' =>
  array (
    'type' => 'string',
    'description' => 'include parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/alert_groups';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
