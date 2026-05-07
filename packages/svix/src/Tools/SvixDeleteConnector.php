<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Delete Connector using the official Svix API.
 */
class SvixDeleteConnector extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.connector.delete';
}
