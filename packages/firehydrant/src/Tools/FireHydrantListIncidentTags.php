<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List incident tags.
 *
 * Maps to the official FireHydrant endpoint get /v1/incident_tags.
 */
class FireHydrantListIncidentTags extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_incident_tags';
    protected const DESCRIPTION = 'List incident tags

Official FireHydrant endpoint: GET /v1/incident_tags

List all of the incident tags in the organization';
    protected const PARAMETERS = array (
  'prefix' =>
  array (
    'type' => 'string',
    'description' => 'prefix parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incident_tags';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'prefix' => 'prefix',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
