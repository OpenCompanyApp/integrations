<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * reindex With Id.
 *
 * Maps to POST /api/system/reindex in the official FusionAuth OpenAPI document.
 */
class FusionAuthReindexWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_reindex_with_id',
  'class' => 'FusionAuthReindexWithId',
  'method' => 'POST',
  'path' => '/api/system/reindex',
  'operation_id' => 'reindexWithId',
  'summary' => 'reindex With Id',
  'description' => 'Requests Elasticsearch to delete and rebuild the index for FusionAuth users or entities. Be very careful when running this request as it will increase the CPU and I/O load on your database until the operation completes. Generally speaking you do not ever need to run this operation unless instructed by FusionAuth support, or if you are migrating a database another system and you are not brining along the Elasticsearch index. You have been warned.',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official FusionAuth OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
