<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * List Streams using the official Svix API.
 */
class SvixListStreams extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.streaming.stream.list';
}
