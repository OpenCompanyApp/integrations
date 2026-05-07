<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * List Stream Event Types using the official Svix API.
 */
class SvixListStreamEventTypes extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.streaming.event-type.list';
}
