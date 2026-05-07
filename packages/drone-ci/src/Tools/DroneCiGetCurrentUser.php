<?php

namespace OpenCompany\Integrations\DroneCi\Tools;

/** Get the authenticated Drone user. */
class DroneCiGetCurrentUser extends AbstractDroneCiTool { protected const NAME = 'drone_ci_get_current_user'; protected const DESCRIPTION = 'Get the authenticated Drone user.'; protected const METHOD = 'getCurrentUser'; }
