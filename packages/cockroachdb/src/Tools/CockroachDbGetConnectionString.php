<?php

namespace OpenCompany\Integrations\CockroachDb\Tools;

/**
 * Get a formatted generic connection string for a cluster.
 *
 * Generated from the official CockroachDB Cloud OpenAPI operation CockroachCloud_GetConnectionString.
 */
class CockroachDbGetConnectionString extends AbstractCockroachDbOperationTool
{
    protected const TOOL_NAME = 'cockroachdb_get_connection_string';
}