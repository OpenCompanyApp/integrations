<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Validate incident tags.
 *
 * Maps to the official FireHydrant endpoint post /v1/incident_tags/validate.
 */
class FireHydrantValidateIncidentTags extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_validate_incident_tags';
    protected const DESCRIPTION = 'Validate incident tags

Official FireHydrant endpoint: POST /v1/incident_tags/validate

Validate the format of a list of tags';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'A list of tags to validate',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/incident_tags/validate';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
