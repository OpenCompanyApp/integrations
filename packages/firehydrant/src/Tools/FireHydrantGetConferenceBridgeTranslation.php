<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Retrieve the translations for a specific conference bridge.
 *
 * Maps to the official FireHydrant endpoint get /v1/incidents/{incident_id}/conference_bridges/{id}/translations/{language_code}.
 */
class FireHydrantGetConferenceBridgeTranslation extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_conference_bridge_translation';
    protected const DESCRIPTION = 'Retrieve the translations for a specific conference bridge

Official FireHydrant endpoint: GET /v1/incidents/{incident_id}/conference_bridges/{id}/translations/{language_code}

Retrieve the translations for a specific conference bridge';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'The ID of the conference bridge',
    'required' => true,
  ),
  'language_code' =>
  array (
    'type' => 'string',
    'description' => 'The language code of the translation',
    'required' => true,
  ),
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incidents/{incident_id}/conference_bridges/{id}/translations/{language_code}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
  'language_code' => 'language_code',
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
