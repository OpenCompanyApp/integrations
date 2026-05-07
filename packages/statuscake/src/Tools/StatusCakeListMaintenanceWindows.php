<?php

namespace OpenCompany\Integrations\StatusCake\Tools;

/**
 * Returns a list of maintenance windows for an account..
 *
 * Maps to the official StatusCake endpoint GET /maintenance-windows.
 */
class StatusCakeListMaintenanceWindows extends AbstractStatusCakeTool
{
    protected const NAME = 'statuscake_list_maintenance_windows';
    protected const DESCRIPTION = 'Returns a list of maintenance windows for an account.

Official StatusCake endpoint: GET /maintenance-windows.';
    protected const PARAMETERS = array (
      'page' => array (
        'type' => 'integer',
        'description' => 'Page of results',
        'required' => false,
      ),
      'limit' => array (
        'type' => 'integer',
        'description' => 'The number of maintenance windows to return per page',
        'required' => false,
      ),
      'state' => array (
        'type' => 'string',
        'description' => 'Maintenance window state',
        'required' => false,
        'enum' => array (
          'active',
          'paused',
          'pending',
        ),
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/maintenance-windows';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
      'page' => 'page',
      'limit' => 'limit',
      'state' => 'state',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
