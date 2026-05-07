<?php

namespace OpenCompany\Integrations\CockroachDb\Tools;

/**
 * Get a blackout window by its ID for a cluster.
 *
 * Generated from the official CockroachDB Cloud OpenAPI operation CockroachCloud_GetBlackoutWindow.
 */
class CockroachDbGetBlackoutWindow extends AbstractCockroachDbOperationTool
{
    protected const TOOL_NAME = 'cockroachdb_get_blackout_window';
}