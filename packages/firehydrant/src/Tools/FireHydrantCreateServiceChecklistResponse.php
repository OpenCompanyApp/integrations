<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Record a response for a checklist item.
 *
 * Maps to the official FireHydrant endpoint post /v1/services/{service_id}/checklist_response/{checklist_id}.
 */
class FireHydrantCreateServiceChecklistResponse extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_service_checklist_response';
    protected const DESCRIPTION = 'Record a response for a checklist item

Official FireHydrant endpoint: POST /v1/services/{service_id}/checklist_response/{checklist_id}

Creates a response for a checklist item';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'description' => 'service_id parameter.',
    'required' => true,
  ),
  'checklist_id' =>
  array (
    'type' => 'string',
    'description' => 'checklist_id parameter.',
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
    protected const PATH = '/v1/services/{service_id}/checklist_response/{checklist_id}';
    protected const PATH_PARAMS = array (
  'service_id' => 'service_id',
  'checklist_id' => 'checklist_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
