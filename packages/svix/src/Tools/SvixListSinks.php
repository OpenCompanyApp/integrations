<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * List Sinks using the official Svix API.
 */
class SvixListSinks extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.streaming.sink.list';
}
