<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Patch Event Type using the official Svix API.
 */
class SvixPatchEventType extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.event-type.patch';
}
