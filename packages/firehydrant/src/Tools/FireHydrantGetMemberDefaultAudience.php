<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get default audience.
 *
 * Maps to the official FireHydrant endpoint get /v1/audiences/member/{member_id}/default.
 */
class FireHydrantGetMemberDefaultAudience extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_member_default_audience';
    protected const DESCRIPTION = 'Get default audience

Official FireHydrant endpoint: GET /v1/audiences/member/{member_id}/default

Get member\'s default audience';
    protected const PARAMETERS = array (
  'member_id' =>
  array (
    'type' => 'integer',
    'description' => 'member_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/audiences/member/{member_id}/default';
    protected const PATH_PARAMS = array (
  'member_id' => 'member_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
