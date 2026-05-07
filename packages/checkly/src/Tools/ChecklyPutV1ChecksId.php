<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * [DEPRECATED] This endpoint will be removed soon. Instead use PUT /checks/api/{id} or PUT /checks/browser/{id}. Updates a new API or browser check..
 *
 * Maps to the official Checkly endpoint PUT /v1/checks/{id}.
 */
class ChecklyPutV1ChecksId extends AbstractChecklyTool
{
    protected const NAME = 'checkly_put_v1_checks_id';
    protected const DESCRIPTION = '[DEPRECATED] This endpoint will be removed soon. Instead use PUT /checks/api/{id} or PUT /checks/browser/{id}. Updates a new API or browser check.

Official Checkly endpoint: PUT /v1/checks/{id}.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'string',
        'description' => 'id parameter.',
        'required' => true,
      ),
      'auto_assign_alerts' => array (
        'type' => 'boolean',
        'description' => 'Determines whether a new check will automatically be added as a subscriber to all existing alert channels when it gets created.',
        'required' => false,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the Checkly API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/checks/{id}';
    protected const PATH_PARAMS = array (
      'id' => 'id',
    );
    protected const QUERY_PARAMS = array (
      'autoAssignAlerts' => 'auto_assign_alerts',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
