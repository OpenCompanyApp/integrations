<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Lists the full, raw check results for a specific check. We keep raw results for 30 days. After 30 days they are erased. However, we keep the rolled up results for an indefinite period. You can filter by check type and result type to narrow down the list. Use the `to` and `from` parameters to specify a date range (UNIX timestamp in seconds). Depending on the check type, some fields might be null. Rate-limiting is applied to this endpoint, you can send 5 requests / 10 seconds at most..
 *
 * Maps to the official Checkly endpoint GET /v2/check-results/{checkId}.
 */
class ChecklyGetV2CheckresultsCheckid extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v2_checkresults_checkid';
    protected const DESCRIPTION = 'Lists the full, raw check results for a specific check. We keep raw results for 30 days. After 30 days they are erased. However, we keep the rolled up results for an indefinite period. You can filter by check type and result type to narrow down the list. Use the `to` and `from` parameters to specify a date range (UNIX timestamp in seconds). Depending on the check type, some fields might be null. Rate-limiting is applied to this endpoint, you can send 5 requests / 10 seconds at most.

Official Checkly endpoint: GET /v2/check-results/{checkId}.';
    protected const PARAMETERS = array (
      'check_id' => array (
        'type' => 'string',
        'description' => 'checkId parameter.',
        'required' => true,
      ),
      'limit' => array (
        'type' => 'integer',
        'description' => 'Limit the number of results to fetch (default 10)',
        'required' => false,
      ),
      'next_id' => array (
        'type' => 'string',
        'description' => 'Cursor parameter to fetch the next page of results. The "nextId" parameter is returned in the response of the previous request. If a response includes a "nextId" parameter set to "null", there are no more results to fetch.',
        'required' => false,
      ),
      'from' => array (
        'type' => 'string',
        'description' => 'Select records up from this UNIX timestamp (>= date).',
        'required' => false,
      ),
      'to' => array (
        'type' => 'string',
        'description' => 'Optional. Select records up to this UNIX timestamp (< date).',
        'required' => false,
      ),
      'location' => array (
        'type' => 'string',
        'description' => 'Provide a data center location, e.g. "eu-west-1" to filter by location',
        'required' => false,
        'enum' => array (
          'us-east-1',
          'us-east-2',
          'us-west-1',
          'us-west-2',
          'ca-central-1',
          'sa-east-1',
          'eu-west-1',
          'eu-central-1',
          'eu-west-2',
          'eu-west-3',
          'eu-north-1',
          'eu-south-1',
          'me-south-1',
          'ap-southeast-1',
          'ap-northeast-1',
          'ap-east-1',
          'ap-southeast-2',
          'ap-southeast-3',
          'ap-northeast-2',
          'ap-northeast-3',
          'ap-south-1',
          'af-south-1',
        ),
      ),
      'check_type' => array (
        'type' => 'string',
        'description' => 'The type of the check',
        'required' => false,
        'enum' => array (
          'AGENTIC',
          'API',
          'BROWSER',
          'HEARTBEAT',
          'ICMP',
          'MULTI_STEP',
          'TCP',
          'PLAYWRIGHT',
          'URL',
          'DNS',
        ),
      ),
      'has_failures' => array (
        'type' => 'boolean',
        'description' => 'Check result has one or more failures',
        'required' => false,
      ),
      'result_type' => array (
        'type' => 'string',
        'description' => 'The check result type (FINAL,ATTEMPT,ALL)',
        'required' => false,
        'enum' => array (
          'FINAL',
          'ATTEMPT',
          'ALL',
        ),
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v2/check-results/{checkId}';
    protected const PATH_PARAMS = array (
      'checkId' => 'check_id',
    );
    protected const QUERY_PARAMS = array (
      'limit' => 'limit',
      'nextId' => 'next_id',
      'from' => 'from',
      'to' => 'to',
      'location' => 'location',
      'checkType' => 'check_type',
      'hasFailures' => 'has_failures',
      'resultType' => 'result_type',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
