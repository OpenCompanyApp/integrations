<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Catalog Delete External Lineage Relationship.
 *
 * Maps to the official Databricks SDK endpoint delete /api/2.0/lineage-tracking/external-lineage.
 */
class DatabricksCatalogDeleteExternalLineageRelationship extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_catalog_delete_external_lineage_relationship';
    protected const DESCRIPTION = 'Catalog Delete External Lineage Relationship

Official Databricks SDK endpoint: DELETE /api/2.0/lineage-tracking/external-lineage

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'description' => 'Optional query string parameters matching the Databricks REST API request fields.',
  ),
  'headers' =>
  array (
    'type' => 'object',
    'description' => 'Optional additional request headers for advanced Databricks endpoints.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'Optional JSON request body matching the Databricks REST API request fields.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/2.0/lineage-tracking/external-lineage';
    protected const PATH_PARAMS = array (
);
}
