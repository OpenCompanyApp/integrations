<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Set default audience.
 *
 * Maps to the official FireHydrant endpoint put /v1/audiences/member/{member_id}/default.
 */
class FireHydrantSetMemberDefaultAudience extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_set_member_default_audience';
    protected const DESCRIPTION = 'Set default audience

Official FireHydrant endpoint: PUT /v1/audiences/member/{member_id}/default

Set member\'s default audience';
    protected const PARAMETERS = array (
  'member_id' =>
  array (
    'type' => 'integer',
    'description' => 'member_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/audiences/member/{member_id}/default';
    protected const PATH_PARAMS = array (
  'member_id' => 'member_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
