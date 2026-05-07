<?php

namespace OpenCompany\Integrations\Buffer\Tools;

/**
 * List posting schedules for a Buffer social profile.
 */
class BufferListProfileSchedules extends AbstractBufferTool
{
    protected const NAME = 'buffer_list_profile_schedules';
    protected const DESCRIPTION = 'List posting schedules for a Buffer social profile.';
    protected const METHOD = 'listProfileSchedules';
    protected const ARGUMENTS = ['profileId'];
    protected const REQUIRED = ['profileId'];
}
