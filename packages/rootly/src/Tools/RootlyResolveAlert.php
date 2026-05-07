<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Resolves an alert.
 *
 * Maps to the official Rootly endpoint post /v1/alerts/{id}/resolve.
 */
class RootlyResolveAlert extends AbstractRootlyTool
{
    protected const NAME = 'rootly_resolve_alert';
    protected const DESCRIPTION = 'Resolves an alert

Official Rootly endpoint: POST /v1/alerts/{id}/resolve

Resolves a specific alert by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/alerts/{id}/resolve';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
