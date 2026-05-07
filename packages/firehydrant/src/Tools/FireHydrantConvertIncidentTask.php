<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Convert a task to a follow-up.
 *
 * Maps to the official FireHydrant endpoint post /v1/incidents/{incident_id}/tasks/{task_id}/convert.
 */
class FireHydrantConvertIncidentTask extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_convert_incident_task';
    protected const DESCRIPTION = 'Convert a task to a follow-up

Official FireHydrant endpoint: POST /v1/incidents/{incident_id}/tasks/{task_id}/convert

Convert a task to a follow-up';
    protected const PARAMETERS = array (
  'task_id' =>
  array (
    'type' => 'string',
    'description' => 'task_id parameter.',
    'required' => true,
  ),
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/incidents/{incident_id}/tasks/{task_id}/convert';
    protected const PATH_PARAMS = array (
  'task_id' => 'task_id',
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
