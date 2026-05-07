<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Update Stream Event Type using the official Svix API.
 */
class SvixUpdateStreamEventType extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.streaming.event-type.update';
}
