<?php

namespace OpenCompany\Integrations\StatusCake\Tools;

/**
 * Updates a maintenance window with the given parameters..
 *
 * Maps to the official StatusCake endpoint PUT /maintenance-windows/{window_id}.
 */
class StatusCakeUpdateMaintenanceWindow extends AbstractStatusCakeTool
{
    protected const NAME = 'statuscake_update_maintenance_window';
    protected const DESCRIPTION = 'Updates a maintenance window with the given parameters.

Official StatusCake endpoint: PUT /maintenance-windows/{window_id}.';
    protected const PARAMETERS = array (
      'window_id' => array (
        'type' => 'string',
        'description' => 'Maintenance window ID',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'Form fields matching the StatusCake API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'PUT';
    protected const PATH = '/maintenance-windows/{window_id}';
    protected const PATH_PARAMS = array (
      'window_id' => 'window_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
