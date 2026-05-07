<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete an alert source.
 *
 * Maps to the official Rootly endpoint delete /v1/alert_sources/{id}.
 */
class RootlyDeleteAlertsSource extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_alerts_source';
    protected const DESCRIPTION = 'Delete an alert source

Official Rootly endpoint: DELETE /v1/alert_sources/{id}

Delete a specific alert source by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/alert_sources/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
