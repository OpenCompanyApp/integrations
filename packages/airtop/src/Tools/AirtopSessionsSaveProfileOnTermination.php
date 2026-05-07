<?php

namespace OpenCompany\Integrations\Airtop\Tools;

/**
 * Save profile on termination.
 *
 * Executes the official Airtop API operation save-profile-on-termination.
 */
class AirtopSessionsSaveProfileOnTermination extends AbstractAirtopOperationTool
{
    protected const OPERATION = 'airtop_sessions_save_profile_on_termination';
}
