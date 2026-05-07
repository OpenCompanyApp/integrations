<?php

namespace OpenCompany\Integrations\StatusCake\Tools;

/**
 * Returns a maintenance window with the given id..
 *
 * Maps to the official StatusCake endpoint GET /maintenance-windows/{window_id}.
 */
class StatusCakeGetMaintenanceWindow extends AbstractStatusCakeTool
{
    protected const NAME = 'statuscake_get_maintenance_window';
    protected const DESCRIPTION = 'Returns a maintenance window with the given id.

Official StatusCake endpoint: GET /maintenance-windows/{window_id}.';
    protected const PARAMETERS = array (
      'window_id' => array (
        'type' => 'string',
        'description' => 'Maintenance window ID',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/maintenance-windows/{window_id}';
    protected const PATH_PARAMS = array (
      'window_id' => 'window_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
