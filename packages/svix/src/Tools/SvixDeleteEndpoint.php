<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Delete Endpoint using the official Svix API.
 */
class SvixDeleteEndpoint extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.endpoint.delete';
}
