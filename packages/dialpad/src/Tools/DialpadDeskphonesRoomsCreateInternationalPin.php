<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

/**
 * Room Phone -- Assign PIN.
 *
 * Executes the official Dialpad API operation deskphones.rooms.create_international_pin.
 */
class DialpadDeskphonesRoomsCreateInternationalPin extends AbstractDialpadOperationTool
{
    protected const OPERATION = 'dialpad_deskphones_rooms_create_international_pin';
}
