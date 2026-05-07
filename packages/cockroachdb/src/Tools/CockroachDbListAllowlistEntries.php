<?php

namespace OpenCompany\Integrations\CockroachDb\Tools;

/**
 * Get the IP allowlist and propagation status for a cluster.
 *
 * Generated from the official CockroachDB Cloud OpenAPI operation CockroachCloud_ListAllowlistEntries.
 */
class CockroachDbListAllowlistEntries extends AbstractCockroachDbOperationTool
{
    protected const TOOL_NAME = 'cockroachdb_list_allowlist_entries';
}