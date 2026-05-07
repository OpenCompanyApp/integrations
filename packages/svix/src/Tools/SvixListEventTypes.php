<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * List Event Types using the official Svix API.
 */
class SvixListEventTypes extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.event-type.list';
}
