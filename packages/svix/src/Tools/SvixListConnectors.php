<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * List Connectors using the official Svix API.
 */
class SvixListConnectors extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.connector.list';
}
