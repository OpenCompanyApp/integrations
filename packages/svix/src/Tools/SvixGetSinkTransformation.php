<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Get Sink Transformation using the official Svix API.
 */
class SvixGetSinkTransformation extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.streaming.sink-transformation-get';
}
