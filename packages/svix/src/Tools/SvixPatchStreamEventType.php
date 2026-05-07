<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Patch Stream Event Type using the official Svix API.
 */
class SvixPatchStreamEventType extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.streaming.event-type.patch';
}
