<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a scheduled maintenance event.
 *
 * Maps to the official FireHydrant endpoint patch /v1/scheduled_maintenances/{scheduled_maintenance_id}.
 */
class FireHydrantUpdateScheduledMaintenance extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_scheduled_maintenance';
    protected const DESCRIPTION = 'Update a scheduled maintenance event

Official FireHydrant endpoint: PATCH /v1/scheduled_maintenances/{scheduled_maintenance_id}

Change the conditions of a scheduled maintenance event, including updating any status page announcements of changes.';
    protected const PARAMETERS = array (
  'scheduled_maintenance_id' =>
  array (
    'type' => 'string',
    'description' => 'scheduled_maintenance_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/scheduled_maintenances/{scheduled_maintenance_id}';
    protected const PATH_PARAMS = array (
  'scheduled_maintenance_id' => 'scheduled_maintenance_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
