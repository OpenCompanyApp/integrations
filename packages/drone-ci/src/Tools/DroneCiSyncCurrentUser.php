<?php

namespace OpenCompany\Integrations\DroneCi\Tools;

/** Sync repositories for the authenticated Drone user. */
class DroneCiSyncCurrentUser extends AbstractDroneCiTool { protected const NAME = 'drone_ci_sync_current_user'; protected const DESCRIPTION = 'Sync repositories for the authenticated Drone user.'; protected const METHOD = 'syncCurrentUser'; }
