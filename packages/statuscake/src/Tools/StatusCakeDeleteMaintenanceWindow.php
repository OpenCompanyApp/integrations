<?php

namespace OpenCompany\Integrations\StatusCake\Tools;

/**
 * Deletes a maintenance window with the given id..
 *
 * Maps to the official StatusCake endpoint DELETE /maintenance-windows/{window_id}.
 */
class StatusCakeDeleteMaintenanceWindow extends AbstractStatusCakeTool
{
    protected const NAME = 'statuscake_delete_maintenance_window';
    protected const DESCRIPTION = 'Deletes a maintenance window with the given id.

Official StatusCake endpoint: DELETE /maintenance-windows/{window_id}.';
    protected const PARAMETERS = array (
      'window_id' => array (
        'type' => 'string',
        'description' => 'Maintenance window ID',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
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
