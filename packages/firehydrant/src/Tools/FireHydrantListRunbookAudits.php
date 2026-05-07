<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List runbook audits.
 *
 * Maps to the official FireHydrant endpoint get /v1/runbook_audits.
 */
class FireHydrantListRunbookAudits extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_runbook_audits';
    protected const DESCRIPTION = 'List runbook audits

Official FireHydrant endpoint: GET /v1/runbook_audits

This endpoint is deprecated.';
    protected const PARAMETERS = array (
  'page' =>
  array (
    'type' => 'integer',
    'description' => 'page parameter.',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'description' => 'per_page parameter.',
  ),
  'auditable_type' =>
  array (
    'type' => 'string',
    'description' => 'A query to filter audits by type',
    'enum' =>
    array (
      0 => 'Runbooks::Step',
      1 => 'Runbooks::Runbook',
    ),
  ),
  'sort' =>
  array (
    'type' => 'string',
    'description' => 'A query to sort audits by their created_at timestamp. Options are \'asc\' or \'desc\'',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/runbook_audits';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
  'auditable_type' => 'auditable_type',
  'sort' => 'sort',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
