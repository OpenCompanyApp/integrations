<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Set Sink Transformation using the official Svix API.
 */
class SvixSetSinkTransformation extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.streaming.sink.transformation-partial-update';
}
