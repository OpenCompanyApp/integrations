<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Aggregate Event Types using the official Svix API.
 */
class SvixAggregateEventTypes extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.statistics.aggregate-event-types';
}
