<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * List nexus endpoints.
 *
 * Maps to the official Temporal endpoint get /cluster/nexus/endpoints.
 */
class TemporalListNexusEndpoints2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_list_nexus_endpoints_2';
    protected const DESCRIPTION = 'List nexus endpoints

Official Temporal endpoint: GET /cluster/nexus/endpoints

List all Nexus endpoints for the cluster, sorted by ID in ascending order. Set page_token in the request to the
 next_page_token field of the previous response to get the next page of results. An empty next_page_token
 indicates that there are no more results. During pagination, a newly added service with an ID lexicographically
 earlier than the previous page\'s last endpoint\'s ID may be missed.';
    protected const PARAMETERS = array (
  'page_size' => array (
  'type' => 'integer',
  'description' => 'pageSize parameter.',
),
  'next_page_token' => array (
  'type' => 'string',
  'description' => 'To get the next page, pass in `ListNexusEndpointsResponse.next_page_token` from the previous page\'s
 response, the token will be empty if there\'s no other page.
 Note: the last page may be empty if the total number of endpoints registered is a multiple of the page size.',
),
  'name' => array (
  'type' => 'string',
  'description' => 'Name of the incoming endpoint to filter on - optional. Specifying this will result in zero or one results.
 (-- api-linter: core::203::field-behavior-required=disabled
     aip.dev/not-precedent: Not following linter rules. --)',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/cluster/nexus/endpoints';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'pageSize' => 'page_size',
  'nextPageToken' => 'next_page_token',
  'name' => 'name',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
