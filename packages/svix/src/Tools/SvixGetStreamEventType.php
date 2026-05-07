<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Get Stream Event Type using the official Svix API.
 */
class SvixGetStreamEventType extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.streaming.event-type.get';
}
