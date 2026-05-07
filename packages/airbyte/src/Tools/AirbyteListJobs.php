<?php

namespace OpenCompany\Integrations\Airbyte\Tools;

/**
 * List Jobs by sync type.
 *
 * Maps to the official Airbyte endpoint get /jobs.
 */
class AirbyteListJobs extends AbstractAirbyteTool
{
    protected const NAME = 'airbyte_list_jobs';
    protected const DESCRIPTION = 'List Jobs by sync type

Official Airbyte endpoint: GET /jobs';
    protected const PARAMETERS = array (
  'connection_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `connectionId` from the official Airbyte API operation. Filter the Jobs by connectionId.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Airbyte API operation. Set the limit on the number of Jobs returned. The default is 20 Jobs.',
  ),
  'offset' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `offset` from the official Airbyte API operation. Set the offset to start at when returning Jobs. The default is 0.',
  ),
  'job_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `jobType` from the official Airbyte API operation. Filter the Jobs by jobType.',
  ),
  'workspace_ids' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `workspaceIds` from the official Airbyte API operation. The UUIDs of the workspaces you wish to list jobs for. Empty list will retrieve all allowed workspaces.',
  ),
  'status' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `status` from the official Airbyte API operation. The Job status you want to filter by',
  ),
  'created_at_start' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `createdAtStart` from the official Airbyte API operation. The start date to filter by',
  ),
  'created_at_end' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `createdAtEnd` from the official Airbyte API operation. The end date to filter by',
  ),
  'updated_at_start' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `updatedAtStart` from the official Airbyte API operation. The start date to filter by',
  ),
  'updated_at_end' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `updatedAtEnd` from the official Airbyte API operation. The end date to filter by',
  ),
  'order_by' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `orderBy` from the official Airbyte API operation. The field and method to use for ordering',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/jobs';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'connectionId' => 'connection_id',
  'limit' => 'limit',
  'offset' => 'offset',
  'jobType' => 'job_type',
  'workspaceIds' => 'workspace_ids',
  'status' => 'status',
  'createdAtStart' => 'created_at_start',
  'createdAtEnd' => 'created_at_end',
  'updatedAtStart' => 'updated_at_start',
  'updatedAtEnd' => 'updated_at_end',
  'orderBy' => 'order_by',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
