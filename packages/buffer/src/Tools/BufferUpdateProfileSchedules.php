<?php

namespace OpenCompany\Integrations\Buffer\Tools;

/**
 * Replace posting schedules for a Buffer social profile.
 */
class BufferUpdateProfileSchedules extends AbstractBufferTool
{
    protected const NAME = 'buffer_update_profile_schedules';
    protected const DESCRIPTION = 'Replace posting schedules for a Buffer social profile.';
    protected const METHOD = 'updateProfileSchedules';
    protected const ARGUMENTS = ['profileId'];
    protected const REQUIRED = ['profileId', 'payload'];
    protected const USE_PAYLOAD = true;
}
