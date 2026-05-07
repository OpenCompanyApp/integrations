<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Add changed status of shield information barrier with specified ID.
 *
 * Executes the official Box API operation post_shield_information_barriers_change_status.
 */
class BoxPostShieldInformationBarriersChangeStatus extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_shield_information_barriers_change_status';
}
