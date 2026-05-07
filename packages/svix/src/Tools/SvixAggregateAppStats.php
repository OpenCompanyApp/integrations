<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Aggregate App Stats using the official Svix API.
 */
class SvixAggregateAppStats extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.statistics.aggregate-app-stats';
}
