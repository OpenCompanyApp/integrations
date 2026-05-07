<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Edit Incidents V2.
 *
 * Maps to the official incident.io endpoint post /v2/incidents/{id}/actions/edit.
 */
class IncidentIoIncidentsV2Edit extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_incidents_v2_edit';
    protected const DESCRIPTION = 'Edit Incidents V2

Official incident.io endpoint: POST /v2/incidents/{id}/actions/edit

Edit an existing incident.

This endpoint allows you to edit the properties of an existing incident: e.g. set the severity or update custom fields.

When using this endpoint, only fields that are provided will be edited (omitted fields
will be ignored).';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'The unique identifier of the incident that you want to edit',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v2/incidents/{id}/actions/edit';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
