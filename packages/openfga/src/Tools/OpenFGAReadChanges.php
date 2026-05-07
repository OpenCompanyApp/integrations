<?php

namespace OpenCompany\Integrations\OpenFGA\Tools;

/**
 * The ReadChanges API will return a paginated list of tuple changes (additions and deletions) that occurred in a given store, sorted by ascending time. The response will include a continuation token that is used to get the next set of changes. If there are no changes after the provided continuation token, the same token will be returned in order for it to be used when new changes are recorded. If the store never had any tuples added or removed, this token will be empty. You can use the `type` parameter to only get the list of tuple changes that affect objects of that type. When reading a write tuple change, if it was conditioned, the condition will be returned. When reading a delete tuple change, the condition will NOT be returned regardless of whether it was originally conditioned or not..
 *
 * Maps to the official OpenFGA endpoint GET /stores/{store_id}/changes.
 */
class OpenFGAReadChanges extends AbstractOpenFGATool
{
    protected const NAME = 'openfga_read_changes';
    protected const DESCRIPTION = 'The ReadChanges API will return a paginated list of tuple changes (additions and deletions) that occurred in a given store, sorted by ascending time. The response will include a continuation token that is used to get the next set of changes. If there are no changes after the provided continuation token, the same token will be returned in order for it to be used when new changes are recorded. If the store never had any tuples added or removed, this token will be empty. You can use the `type` parameter to only get the list of tuple changes that affect objects of that type. When reading a write tuple change, if it was conditioned, the condition will be returned. When reading a delete tuple change, the condition will NOT be returned regardless of whether it was originally conditioned or not.

Official OpenFGA endpoint: GET /stores/{store_id}/changes.';
    protected const PARAMETERS = array (
      'store_id' => array (
        'type' => 'string',
        'description' => 'store_id parameter.',
        'required' => true,
      ),
      'type' => array (
        'type' => 'string',
        'description' => 'type parameter.',
        'required' => false,
      ),
      'page_size' => array (
        'type' => 'integer',
        'description' => 'page_size parameter.',
        'required' => false,
      ),
      'continuation_token' => array (
        'type' => 'string',
        'description' => 'continuation_token parameter.',
        'required' => false,
      ),
      'start_time' => array (
        'type' => 'string',
        'description' => 'Start date and time of changes to read. Format: ISO 8601 timestamp (e.g., 2022-01-01T00:00:00Z) If a continuation_token is provided along side start_time, the continuation_token will take precedence over start_time.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/stores/{store_id}/changes';
    protected const PATH_PARAMS = array (
      'store_id' => 'store_id',
    );
    protected const QUERY_PARAMS = array (
      'type' => 'type',
      'page_size' => 'page_size',
      'continuation_token' => 'continuation_token',
      'start_time' => 'start_time',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
