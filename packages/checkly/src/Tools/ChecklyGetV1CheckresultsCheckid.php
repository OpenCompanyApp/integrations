<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * [DEPRECATED] This endpoint will be removed soon. Please use the GET /v2/check-results/{checkId} endpoint instead. Lists the full, raw check results for a specific check. We keep raw results for 30 days. After 30 days they are erased. However, we keep the rolled up results for an indefinite period. You can filter by check type and result type to narrow down the list. Use the `to` and `from` parameters to specify a date range (UNIX timestamp in seconds). Depending on the check type, some fields might be null. This endpoint will return data within a 6-hour timeframe. If the `from` and `to` params are set, they must be at most six hours apart. If none are set, we will consider the `to` param to be now and the `from` param to be six hours earlier. If only the `to` param is set we will set `from` to be six hours earlier. On the contrary, if only the `from` param is set we will consider the `to` param to be six hours later. Rate-limiting is applied to this endpoint, you can send 5 requests / 10 seconds at most..
 *
 * Maps to the official Checkly endpoint GET /v1/check-results/{checkId}.
 */
class ChecklyGetV1CheckresultsCheckid extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_checkresults_checkid';
    protected const DESCRIPTION = '[DEPRECATED] This endpoint will be removed soon. Please use the GET /v2/check-results/{checkId} endpoint instead. Lists the full, raw check results for a specific check. We keep raw results for 30 days. After 30 days they are erased. However, we keep the rolled up results for an indefinite period. You can filter by check type and result type to narrow down the list. Use the `to` and `from` parameters to specify a date range (UNIX timestamp in seconds). Depending on the check type, some fields might be null. This endpoint will return data within a 6-hour timeframe. If the `from` and `to` params are set, they must be at most six hours apart. If none are set, we will consider the `to` param to be now and the `from` param to be six hours earlier. If only the `to` param is set we will set `from` to be six hours earlier. On the contrary, if only the `from` param is set we will consider the `to` param to be six hours later. Rate-limiting is applied to this endpoint, you can send 5 requests / 10 seconds at most.

Official Checkly endpoint: GET /v1/check-results/{checkId}.';
    protected const PARAMETERS = array (
      'check_id' => array (
        'type' => 'string',
        'description' => 'checkId parameter.',
        'required' => true,
      ),
      'limit' => array (
        'type' => 'integer',
        'description' => 'Limit the number of results',
        'required' => false,
      ),
      'page' => array (
        'type' => 'number',
        'description' => 'Page number',
        'required' => false,
      ),
      'from' => array (
        'type' => 'string',
        'description' => 'Select records up from this UNIX timestamp (>= date). Defaults to now - 6 hours.',
        'required' => false,
      ),
      'to' => array (
        'type' => 'string',
        'description' => 'Optional. Select records up to this UNIX timestamp (< date). Defaults to 6 hours after "from".',
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
    protected const PATH = '/v1/check-results/{checkId}';
    protected const PATH_PARAMS = array (
      'checkId' => 'check_id',
    );
    protected const QUERY_PARAMS = array (
      'limit' => 'limit',
      'page' => 'page',
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
