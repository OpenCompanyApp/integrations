<?php

namespace OpenCompany\Integrations\DroneCi\Tools;

/** List Drone users. */
class DroneCiListUsers extends AbstractDroneCiTool { protected const NAME = 'drone_ci_list_users'; protected const DESCRIPTION = 'List Drone users. Requires a token with sufficient server privileges.'; protected const METHOD = 'listUsers'; protected const REQUIRED = []; protected const PARAMETERS = []; }
