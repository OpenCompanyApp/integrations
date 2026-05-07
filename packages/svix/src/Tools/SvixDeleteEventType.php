<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Delete Event Type using the official Svix API.
 */
class SvixDeleteEventType extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.event-type.delete';
}
