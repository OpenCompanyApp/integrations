<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Create Stream Event Type using the official Svix API.
 */
class SvixCreateStreamEventType extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.streaming.event-type.create';
}
