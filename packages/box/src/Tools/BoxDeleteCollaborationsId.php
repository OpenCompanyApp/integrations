<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Remove collaboration.
 *
 * Executes the official Box API operation delete_collaborations_id.
 */
class BoxDeleteCollaborationsId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_delete_collaborations_id';
}
