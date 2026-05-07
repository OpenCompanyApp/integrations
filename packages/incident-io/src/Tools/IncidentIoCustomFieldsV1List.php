<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * List Custom Fields V1.
 *
 * Maps to the official incident.io endpoint get /v1/custom_fields.
 */
class IncidentIoCustomFieldsV1List extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_custom_fields_v1_list';
    protected const DESCRIPTION = 'List Custom Fields V1

Official incident.io endpoint: GET /v1/custom_fields

List all custom fields for an organisation.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/custom_fields';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
