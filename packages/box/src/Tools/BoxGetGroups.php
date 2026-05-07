<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List groups for enterprise.
 *
 * Executes the official Box API operation get_groups.
 */
class BoxGetGroups extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_groups';
}
