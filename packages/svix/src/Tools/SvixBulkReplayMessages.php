<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Bulk Replay Messages using the official Svix API.
 */
class SvixBulkReplayMessages extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.endpoint.bulk-replay';
}
