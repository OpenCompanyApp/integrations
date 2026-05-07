<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List entitlements.
 *
 * Maps to the official FireHydrant endpoint get /v1/entitlements.
 */
class FireHydrantListEntitlements extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_entitlements';
    protected const DESCRIPTION = 'List entitlements

Official FireHydrant endpoint: GET /v1/entitlements

List the organization\'s entitlements';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'Name of Entitlement',
  ),
  'type' =>
  array (
    'type' => 'string',
    'description' => 'Type of Entitlement',
    'enum' =>
    array (
      0 => 'quota',
      1 => 'access',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/entitlements';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'name' => 'name',
  'type' => 'type',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
