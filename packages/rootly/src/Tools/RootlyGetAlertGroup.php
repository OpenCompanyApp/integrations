<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves an alert group.
 *
 * Maps to the official Rootly endpoint get /v1/alert_groups/{id}.
 */
class RootlyGetAlertGroup extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_alert_group';
    protected const DESCRIPTION = 'Retrieves an alert group

Official Rootly endpoint: GET /v1/alert_groups/{id}

Retrieves a specific alert group by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/alert_groups/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
