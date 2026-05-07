<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create multiple services linked to external services.
 *
 * Maps to the official FireHydrant endpoint post /v1/services/service_links.
 */
class FireHydrantCreateServiceLinks extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_service_links';
    protected const DESCRIPTION = 'Create multiple services linked to external services

Official FireHydrant endpoint: POST /v1/services/service_links

Creates a service with the appropriate integration for each external service ID passed';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/services/service_links';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
