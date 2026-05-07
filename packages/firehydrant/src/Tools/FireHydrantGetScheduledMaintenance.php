<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a scheduled maintenance event.
 *
 * Maps to the official FireHydrant endpoint get /v1/scheduled_maintenances/{scheduled_maintenance_id}.
 */
class FireHydrantGetScheduledMaintenance extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_scheduled_maintenance';
    protected const DESCRIPTION = 'Get a scheduled maintenance event

Official FireHydrant endpoint: GET /v1/scheduled_maintenances/{scheduled_maintenance_id}

Fetch the details of a scheduled maintenance event.';
    protected const PARAMETERS = array (
  'scheduled_maintenance_id' =>
  array (
    'type' => 'string',
    'description' => 'scheduled_maintenance_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/scheduled_maintenances/{scheduled_maintenance_id}';
    protected const PATH_PARAMS = array (
  'scheduled_maintenance_id' => 'scheduled_maintenance_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
