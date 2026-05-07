<?php

namespace OpenCompany\Integrations\CockroachDb\Tools;

/**
 * Add a new CIDR address to the IP allowlist.
 *
 * Generated from the official CockroachDB Cloud OpenAPI operation CockroachCloud_AddAllowlistEntry.
 */
class CockroachDbAddAllowlistEntry extends AbstractCockroachDbOperationTool
{
    protected const TOOL_NAME = 'cockroachdb_add_allowlist_entry';
}