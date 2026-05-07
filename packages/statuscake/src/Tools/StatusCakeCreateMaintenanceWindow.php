<?php

namespace OpenCompany\Integrations\StatusCake\Tools;

/**
 * Creates a maintenance window with the given parameters..
 *
 * Maps to the official StatusCake endpoint POST /maintenance-windows.
 */
class StatusCakeCreateMaintenanceWindow extends AbstractStatusCakeTool
{
    protected const NAME = 'statuscake_create_maintenance_window';
    protected const DESCRIPTION = 'Creates a maintenance window with the given parameters.

Official StatusCake endpoint: POST /maintenance-windows.';
    protected const PARAMETERS = array (
      'body' => array (
        'type' => 'object',
        'description' => 'Form fields matching the StatusCake API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/maintenance-windows';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
