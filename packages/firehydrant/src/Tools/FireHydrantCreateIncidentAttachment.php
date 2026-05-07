<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Add an attachment to the incident timeline.
 *
 * Maps to the official FireHydrant endpoint post /v1/incidents/{incident_id}/attachments.
 */
class FireHydrantCreateIncidentAttachment extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_incident_attachment';
    protected const DESCRIPTION = 'Add an attachment to the incident timeline

Official FireHydrant endpoint: POST /v1/incidents/{incident_id}/attachments

Allows adding image attachments to an incident';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
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
    protected const PATH = '/v1/incidents/{incident_id}/attachments';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
