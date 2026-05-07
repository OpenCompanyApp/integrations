<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List audience summaries.
 *
 * Maps to the official FireHydrant endpoint get /v1/audiences/summaries/{incident_id}.
 */
class FireHydrantListAudienceSummaries extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_audience_summaries';
    protected const DESCRIPTION = 'List audience summaries

Official FireHydrant endpoint: GET /v1/audiences/summaries/{incident_id}

List all audience summaries for an incident';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier of the incident to summarize',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/audiences/summaries/{incident_id}';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
