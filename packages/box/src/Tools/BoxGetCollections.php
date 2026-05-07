<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List all collections.
 *
 * Executes the official Box API operation get_collections.
 */
class BoxGetCollections extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_collections';
}
