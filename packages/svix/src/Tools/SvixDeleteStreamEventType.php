<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Delete Stream Event Type using the official Svix API.
 */
class SvixDeleteStreamEventType extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.streaming.event-type.delete';
}
