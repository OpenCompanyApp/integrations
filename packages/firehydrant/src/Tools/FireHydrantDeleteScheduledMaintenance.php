<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete a scheduled maintenance event.
 *
 * Maps to the official FireHydrant endpoint delete /v1/scheduled_maintenances/{scheduled_maintenance_id}.
 */
class FireHydrantDeleteScheduledMaintenance extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_scheduled_maintenance';
    protected const DESCRIPTION = 'Delete a scheduled maintenance event

Official FireHydrant endpoint: DELETE /v1/scheduled_maintenances/{scheduled_maintenance_id}

Delete a scheduled maintenance event, preventing it from taking place.';
    protected const PARAMETERS = array (
  'scheduled_maintenance_id' =>
  array (
    'type' => 'string',
    'description' => 'scheduled_maintenance_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
