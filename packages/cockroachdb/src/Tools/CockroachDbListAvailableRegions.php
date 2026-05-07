<?php

namespace OpenCompany\Integrations\CockroachDb\Tools;

/**
 * List the regions available for new clusters and nodes.
 *
 * Generated from the official CockroachDB Cloud OpenAPI operation CockroachCloud_ListAvailableRegions.
 */
class CockroachDbListAvailableRegions extends AbstractCockroachDbOperationTool
{
    protected const TOOL_NAME = 'cockroachdb_list_available_regions';
}