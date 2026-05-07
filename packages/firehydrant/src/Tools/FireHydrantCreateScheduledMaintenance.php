<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a scheduled maintenance event.
 *
 * Maps to the official FireHydrant endpoint post /v1/scheduled_maintenances.
 */
class FireHydrantCreateScheduledMaintenance extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_scheduled_maintenance';
    protected const DESCRIPTION = 'Create a scheduled maintenance event

Official FireHydrant endpoint: POST /v1/scheduled_maintenances

Create a new scheduled maintenance event';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/scheduled_maintenances';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
