<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List pending collaborations.
 *
 * Executes the official Box API operation get_collaborations.
 */
class BoxGetCollaborations extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_collaborations';
}
