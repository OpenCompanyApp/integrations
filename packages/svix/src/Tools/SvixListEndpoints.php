<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * List Endpoints using the official Svix API.
 */
class SvixListEndpoints extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.endpoint.list';
}
